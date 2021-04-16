<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function number(): Response
    {
        $data = [
            "title" => "Home",
            "component" => "components/home.twig"
        ];

        $data["navItems"] = [
            [
                "url" => "/",
                "label" => "Home"
            ],
            [
                "url" => "/twentyone",
                "label" => "Game 21"
            ],
            [
                "url" => "/yatzy",
                "label" => "Yatzy"
            ],
            [
                "url" => "/session",
                "label" => "Session"
            ]
        ];

        return $this->render('index.twig', [
            "title" => "Home",
            "navItems" => [],
            "component" => "components/home.twig"
        ]);
    }
}