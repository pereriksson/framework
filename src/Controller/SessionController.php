<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/session", name="app_session", methods={"GET"})
     */
    public function number(): Response
    {
        return $this->render('index.twig', [
            "title" => "Session",
            "navItems" => [],
            "component" => "components/session.twig",
            "session" => $this->session
        ]);
    }

    /**
     * @Route("/session", name="app_session_invalidate", methods={"POST"})
     */
    public function invalidate(): Response
    {
        $this->session->invalidate();
        return $this->redirectToRoute('app_session');
    }
}