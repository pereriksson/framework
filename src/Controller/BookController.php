<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;

class BookController extends AbstractController
{
    /**
     * @Route("/books", name="app_books")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Book::class);
        $books = $repository->findAll();


        return $this->render('index.twig', [
            "title" => "Home",
            "books" => $books,
            "component" => "components/books.twig"
        ]);
    }
}
