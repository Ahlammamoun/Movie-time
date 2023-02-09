<?php

namespace App\Controller\Back;

use App\Entity\Actor;
use App\Form\ActorType;
use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/actor")
 */
class actorController extends AbstractController
{
    /**
     * @Route("/", name="app_back_actor_index", methods={"GET"})
     */
    public function index(ActorRepository $actorRepository): Response
    {
        return $this->render('back/actor/index.html.twig', [
            'actors' => $actorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_actor_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ActorRepository $actorRepository): Response
    {
        $actor = new Actor();
        $form = $this->createForm(ActorType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actorRepository->add($actor, true);

            return $this->redirectToRoute('app_back_actor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/actor/new.html.twig', [
            'actor' => $actor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_actor_show", methods={"GET"})
     */
    public function show(Actor $actor): Response
    {
        return $this->render('back/actor/show.html.twig', [
            'actor' => $actor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_actor_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Actor $actor, ActorRepository $actorRepository): Response
    {
        $form = $this->createForm(ActorType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actorRepository->add($actor, true);

            return $this->redirectToRoute('app_back_actor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/actor/edit.html.twig', [
            'actor' => $actor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_actor_delete", methods={"POST"})
     */
    public function delete(Request $request, Actor $actor, ActorRepository $actorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$actor->getId(), $request->request->get('_token'))) {
            $actorRepository->remove($actor, true);
        }

        return $this->redirectToRoute('app_back_actor_index', [], Response::HTTP_SEE_OTHER);
    }
}
