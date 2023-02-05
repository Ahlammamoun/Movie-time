<?php

namespace App\Controller;


use App\Entity\Movie;
use App\Entity\Review;
use App\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    /**
     * @Route("/movie/{id}/review", name="movie_review_add")
     */
    public function show(Movie $movie): Response
    {
      $review = new Review();
      $formulaire = $this->createForm(ReviewType::class, $review);

     return $this->renderform('review/index.html.twig',[
            'movie' => $movie,
            'formulaire' => $formulaire,

      ]);
    }

    









}
