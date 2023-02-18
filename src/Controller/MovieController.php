<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Repository\ReviewRepository;
use App\Repository\CastingRepository;
use App\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;


class MovieController extends AbstractController
{

   /**
     * @Route("/", name="app_home")
     */
    public function home(MovieRepository $Repos): Response 
    {
        $movies = $Repos->findAll();

        //dd($movies);
        return $this->render('movie/index.html.twig', [
           
            'movies' => $movies ,
        ]);
    }

    /**
     * @Route("/movie/{id}", name="app_movie", requirements={"id": "\d+"})
     */

    //seconde façon
    //public function show(Movie $movie, int $id): Response
    //à partir de l'entité Movie et comme il y a un id dans la route , 
    //le framework en déduit que c'est une route dynamique et va chercher la méthode adéquat find()
    // est rempli le variable $movie directement sans passer par l'etape $movie = $movieRepos->find($id)
    public function show(MovieRepository $movieRepos, int $id, CastingRepository $castingRepo, ReviewRepository $reviewRepository ): Response
    {
        $movie = $movieRepos->find($id);
        

        $CastingsFilterByMovieByORder = $castingRepo->findBy(['movie' => $movie], ['creditOrder' => 'ASC']);
     


        $Movie = $movieRepos->find($id);
        $lastReview = $reviewRepository->findBy(['Movie' => $Movie], ['id' => 'DESC'], 1);
        //dd($lastReview);

        return $this->render('movie/show.html.twig', [
          
            'movie' => $movie ,
            'CastingsFilterByMovieByORder' => $CastingsFilterByMovieByORder,
            'lastReview' => $lastReview[0],
            
        ]);
            
    }

    /**
     * @Route("/movies/", name="app_movies")
     */
    public function showAll(MovieRepository $Repos): Response 
    {
        $movies = $Repos->getAllByOrderByTitle();
        //dump($movies);
        return $this->render('movie/list.html.twig', [
        
            'movies' => $movies ,
        ]);
    }




}











