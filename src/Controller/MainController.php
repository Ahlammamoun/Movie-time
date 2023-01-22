<?php



namespace App\Controller;

use App\Models\Movies;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
/**
 * Page par défault
 * @Route("/",  name="main_home")
 * 
 * @return Response
 */
    public function home(): Response
    {


        $modelMovie = new Movies();
        //dump ($modelMovies);

        return $this->render('main/index.html.twig',[
            'movies' => $modelMovie->getAllMovies()
           
        ]);
        
        
    }
/**
 * Page par défault
 * @Route("/show/{id}",  name="main_show", requirements={"id": "\d+"})
 * 
 * @return Response
 */

    public function show(int $id): Response
    {

        $modelMovie = new Movies();
        $movie = $modelMovie->getMovie($id);
        //dump ($movie);
            return $this->render('main/show.html.twig', [
            'movie' => $movie

            ]);





    }


/**
 * Page par défault
 * @Route("/list",  name="main_list" )
 * 
 * @return Response
 */
    public function list(): Response 
    {
            $modelMovie = new Movies();
            dump($modelMovie);

            return $this->render('main/list.html.twig', [
                'movies' => $modelMovie->getAllMovies()
            ]
            );
    }


/**
 * Page par défault
 * @Route("/favorites",  name="main_favorites" )
 * 
 * @return Response
 */

    public function favorites()
    {

        return $this->render('main/favorites.html.twig');
    }


/**
 * Page par défault
 * @Route("/theme/toggle",  name="main_theme_switcher" )
 * 
 * @return Response
 */

    public function themeSwitcher(SessionInterface  $session)
    {

        
            $theme = $session->get('theme', 'fliflix');
            if($theme === 'fliflix'){
                $session->set('theme', 'ociné');
            } else {
                $session->set('theme', 'fliflix');
            }

                return $this->redirectToRoute('main_home');
    }







}