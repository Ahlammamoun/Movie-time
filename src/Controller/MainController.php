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

                return $this->redirectToRoute('app_home');
    }







}