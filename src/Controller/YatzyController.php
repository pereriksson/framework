<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Yatzy\Yatzy;
use App\Dice\DiceHand;
use Symfony\Component\HttpFoundation\Request;


class YatzyController extends AbstractController
{
    const PLAYING = 0;
    const FINISHED = 1;
    const WON = 1;
    const LOST = 2;

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    private function isPostAction(string $action): bool
    {

        if ($this->request->get("action") == $action) {
            return true;
        }

        return false;
    }

    private function leave()
    {
        $this->session->remove("yatzy");
    }

    private function start()
    {
        $this->session->set("yatzy", new Yatzy());
        $this->session->get("yatzy")->addPlayer("Jag");
        $this->session->get("yatzy")->addPlayer("Dator");
        $this->session->get("yatzy")->newRound();
        $this->session->set("row", "ones");
    }

    private function nextStep()
    {
        $yatzy = $this->session->get("yatzy");

        foreach ($yatzy->getDiceHand()->getDices() as $dice) {
            $dice->setKept(true);
        }

        $stepMapping = [
            "ones" => [
                "factor" => 1,
                "next" => "twos",
                "method" => "setOnes"
            ],
            "twos" => [
                "factor" => 2,
                "next" => "threes",
                "method" => "setTwos"
            ],
            "threes" => [
                "factor" => 3,
                "next" => "fours",
                "method" => "setThrees"
            ],
            "fours" => [
                "factor" => 4,
                "next" => "fives",
                "method" => "setFours"
            ],
            "fives" => [
                "factor" => 5,
                "next" => "sixes",
                "method" => "setFives"
            ],
            "sixes" => [
                "factor" => 6,
                "next" => "onePair",
                "method" => "setSixes"
            ],
            "onePair" => [
                "factor" => 6,
                "next" => "twoPair",
                "method" => "setOnePair"
            ]
        ];

        $step = $stepMapping[$this->session->get("row")];

        $qty = array_reduce($yatzy->getDiceHand()->getDices(), function ($acc, $dice) use ($step) {
            return $dice->getValue() === $step["factor"] ? $acc + 1 : $acc;
        }, 0);
        call_user_func([$yatzy->getScoreCards()[0], $step["method"]], $step["factor"] * $qty);

        $this->session->set("row", $step["next"]);
    }

    private function throw()
    {
        $yatzy = $this->session->get("yatzy");

        if ($yatzy->getThrowRound() === 3) {
            $yatzy->setThrowRound(0);
        }

        // Reset before first throw
        if ($yatzy->getThrowRound() === 0) {
            $yatzy->getDiceHand()->resetHand();

            foreach ($yatzy->getDiceHand()->getDices() as $dice) {
                $dice->setKept(false);
            }
        }

        // Lock dices
        foreach ($_POST as $key => $value) {
            if (substr($key, 0, 10) == "keep-dice-" && $value === "true") {
                $uniqid = substr($key, 10);
                $yatzy->getDiceHand()->keepDice($uniqid);
            }
        }

        $yatzy->throwDices(0);

        if ($yatzy->getThrowRound() === 3) {
            $this->nextStep();
        }
    }

    /**
     * @Route("/yatzy", name="app_yatzy", methods={"GET"})
     */
    public function number(): Response
    {
        $vars = [];

        $vars["title"] = "Yatzy";
        $vars["component"] = "components/yatzy.twig";

        if ($this->session->has("yatzy")) {
            $yatzy = $this->session->get("yatzy");
            $vars["yatzy"] = $yatzy;

            $dices = $yatzy->getDiceHand()->getDices();

            $vars["dices"] = [];

            foreach ($dices as $dice) {
                $vars["dices"][] = [
                    "id" => $dice->getId(),
                    "value" => $dice->getValue(),
                    "kept" => $dice->getKept()
                ];
            }

            $vars["scoreCards"] = $yatzy->getScoreCards();
            $vars["throwRound"] = $yatzy->getThrowRound();
        }

        return $this->render('index.twig', $vars);
    }

    /**
     * @Route("/yatzy", name="app_yatzy_action", methods={"POST"})
     */
    public function action(Request $request)
    {
        if ($request->get("action") === "leave") {
            $this->leave();
        }

        if ($request->get("action") === "start") {
            $this->start();
        }

        if ($request->get("action") === "reset") {
            $yatzy = $this->session->get("yatzy");
            $yatzy->resetScore();
            $this->session->set("row", "ones");
        }

        if ($request->get("action") === "throw") {
            $yatzy = $this->session->get("yatzy");
            $this->throw();
        }

        return $this->redirectToRoute('app_yatzy');
    }
}