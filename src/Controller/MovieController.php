<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Movie;
use App\Repository\MovieRepository;
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
    public function show(MovieRepository $movieRepos, int $id, CastingRepository $castingRepo ): Response
    {
        $movie = $movieRepos->find($id);
       
        //dump($movie);

        $CastingsFilterByMovieByORder = $castingRepo->findBy(['movie' => $movie], ['creditOrder' => 'ASC']);
        

        //dump($CastingsFilterByMovieByORder);

        return $this->render('movie/show.html.twig', [
          
            'movie' => $movie ,
            'CastingsFilterByMovieByORder' => $CastingsFilterByMovieByORder,
        
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


        /**
     * @Route("/movie/create/", name="app_movie_create")
     * @param EntityManagerInterface 
     */
        
    public function create(EntityManagerInterface $doctrine): Response
    {
        $newMovie = new Movie();

        $newMovie->setTitle("milles et une nuits");
        $newMovie->setDuration(90);
        $newMovie->setType("Film");
        $newMovie->setReleaseDate(new DateTime("now"));
        $newMovie->setSummary("en plein envoutement , dans la douceur d'une nuit d'orient");
        $newMovie->setSynopsis("shéhérazade et les ultan");
        $newMovie->setPoster("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSERQdylidSEcEnWXMy3pBw4odcOGwHyRv_EQ&usqp=CAU");

        //dump($newMovie);
        $doctrine->persist($newMovie);
      

        $doctrine->flush();
        //dump($newMovie);

        return $this->redirectToRoute("app_movies");

    }


     /**
     * @Route("/movie/update/{id}", name="app_movie_update")
     * @param EntityManagerInterface 
     */

    public function update(int $id, MovieRepository $MovieRepository, EntityManagerInterface $doctrine): Response
    {

        $movie = $MovieRepository->find($id);

        $movie->setTitle('peĉhe xxl ' . mt_rand(2, 99));


        //$doctrine->flush();

        return $this->redirectToRoute('app_movie', array("id" => $id));

    }


     /**
     * @Route("/movie/delete/{id}", name="app_movie_delete")
     * @param EntityManagerInterface 
     */

    public function delete(int $id, MovieRepository $MovieRepository, EntityManagerInterface $doctrine): Response
    {

        $movie = $MovieRepository->find($id);

        $doctrine->remove($movie);

        $doctrine->flush();

        return $this->redirectToRoute("app_movies");
    }





}











