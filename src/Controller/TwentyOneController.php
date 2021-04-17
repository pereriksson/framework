<?php

namespace App\Controller;

use App\TwentyOne\TwentyOne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Yatzy\Yatzy;
use App\Dice\DiceHand;
use Symfony\Component\HttpFoundation\Request;

class TwentyOneController extends AbstractController
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

    private function simulateComputer($twentyone)
    {
        $computer = $twentyone->getPlayers()[1];

        for ($i = 0; $i < 20; $i++) {
            $twentyone->throwDices(1);

            if ($computer->getStatus() !== $this::PLAYING) {
                break;
            }

            if (21 - $twentyone->getPlayerScore(1) <= 5) {
                $twentyone->setPlayedAsStopped(1);
                break;
            }
        }
    }

    /**
     * @Route("/twentyone", name="app_twentyone", methods={"GET"})
     */
    public function index(): Response
    {
        $vars = [];

        $vars["title"] = "TwentyOne";
        $vars["twentyone"] = null;
        $vars["winner"] = null;

        if ($this->session->get("twentyone")) {
            $twentyone = $this->session->get("twentyone");

            $vars = [
                "title" => "Tjugoett",
                "twentyone" => $this->session->get("twentyone"),
                "my_score" => $twentyone->getPlayerScore(0),
                "computer_score" => $twentyone->getPlayerScore(1),
                "status" => $twentyone->getStatus() === $this::PLAYING ? "playing" : "finished",
                "rounds" => $twentyone->getRounds(),
                "winner" => null
            ];

            if ($twentyone->getStatus() === $this::FINISHED) {
                $vars["winner"] = "Ingen";

                if ($twentyone->getCurrentRound()->getWinner()) {
                    $vars["winner"] = $twentyone->getCurrentRound()->getWinner()->getName();
                }
            }
        }

        $vars["component"] = "components/twentyone.twig";

        return $this->render('index.twig', $vars);
    }

    /**
     * @Route("/twentyone", name="app_twentyone_action", methods={"POST"})
     */
    public function action(Request $request)
    {
        if ($request->get("action") == "leave") {
            $this->session->remove("twentyone");
        }

        if ($request->get("action") == "start") {
            $this->session->set("twentyone", new TwentyOne($request->get("number_of_dices"), 6));
            $this->session->get("twentyone")->addPlayer("Jag");
            $this->session->get("twentyone")->addPlayer("Dator");
            $this->session->get("twentyone")->newRound();
        }


        if ($request->get("action") == "reset") {
            $this->session->get("twentyone")->resetScore();
        }

        if ($request->get("action") == "throw") {
            $twentyone = $this->session->get("twentyone");
            $human = $twentyone->getPlayers()[0];
            $twentyone->throwDices(0);

            if ($human->getStatus() !== $this::PLAYING) {
                $this->simulateComputer($twentyone);
            }
        }

        if ($request->get("action") == "new_round") {
            $twentyone = $this->session->get("twentyone");
            $twentyone->newRound();
        }

        if ($request->get("action") == "stop") {
            $twentyone = $this->session->get("twentyone");
            $twentyone->setPlayedAsStopped(0);

            $this->simulateComputer($twentyone);
        }


        return $this->redirectToRoute('app_twentyone');
    }
}
