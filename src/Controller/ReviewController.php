<?php

namespace App\Controller;


use App\Entity\Movie;
use App\Entity\Review;
use App\Form\ReviewType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class ReviewController extends AbstractController
{
    /**
     * @Route("/movie/{id}/review", name="movie_review_add")
     */
    public function show(Movie $movie, Request $request, EntityManagerInterface $doctrine): Response
    {

      //je créer un formulaire pour ajouter une review
      $review = new Review();
      $formulaire = $this->createForm(ReviewType::class, $review);


      // dit on formulaire  de prendre en compte la reqquête http et de relier les données au variables qu'on a donnée à la création
      $formulaire->handleRequest($request);

      //si le formulaire est envoyé et valide 
      if ($formulaire->isSubmitted() && $formulaire->isValid()){


          $review->SetMovie($movie);


          //dd($review);
          $doctrine->persist($review);
          $doctrine->flush();

          
         return $this->redirectToRoute('app_movie', ['id' => $movie->getId()]);
        
      }

     return $this->renderform('review/index.html.twig',[
            'movie' => $movie,
            'formulaire' => $formulaire,

      ]);
    }

    









}
