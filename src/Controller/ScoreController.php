<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Score;

class ScoreController extends AbstractController
{
    /**
     * @Route("/score", name="app_score")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Score::class);
        $score = $repository->findAll();

        return $this->render('index.twig', [
            "title" => "Home",
            "score" => $score,
            "component" => "components/score.twig"
        ]);
    }
}