<?php

namespace App\Controller;


use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie/{id}", name="app_movie", requirements={"id": "\d+"})
     */

    //seconde façon
    //public function show(Movie $movie, int $id): Response
    //à partir de l'entité Movie et comme il y a un id dans la route , 
    //le framework en déduit que c'est une route dynamique et va chercher la méthode adéquat find()
    // est rempli le variable $movie directement sans passer par l'etape $movie = $movieRepos->find($id)
    public function show(MovieRepository $movieRepos, int $id): Response
    {

        $movie = $movieRepos->find($id);
        //dd($movie);


        return $this->render('movie/show.html.twig', [
            'controller_name' => 'MovieController',
            'movie' => $movie ,
        ]);
    }
}
