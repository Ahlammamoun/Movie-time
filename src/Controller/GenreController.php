<?php

namespace App\Controller;


use App\Entity\Genre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    /**
     * @Route("/genre/{id}", name="app_genre", requirements={"id": "\d+"})
     */
    public function show(Genre $genre): Response
    {


        return $this->render('movie/genre.html.twig', [
           'genre' => $genre,
        ]);      
    }

  /**
     * @Route("/genre/{name}", name="app_genre_deux")
     */
    public function showbyName(Genre $genre): Response
    {
        return $this->render('movie/genre.html.twig', [
           'genre' => $genre,
        ]);
      
    }









}
