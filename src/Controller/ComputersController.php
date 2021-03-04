<?php

namespace App\Controller;

use App\Entity\Computers;
use App\Form\ComputersType;
use App\Repository\ComputersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/computers")
 */
class ComputersController extends AbstractController
{
    /**
     * @Route("/", name="computers_index", methods={"GET"})
     */
    public function index(ComputersRepository $computersRepository): Response
    {
        return $this->render('computers/index.html.twig', [
            'computers' => $computersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="computers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $computer = new Computers();
        $form = $this->createForm(ComputersType::class, $computer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($computer);
            $entityManager->flush();

            return $this->redirectToRoute('computers_index');
        }

        return $this->render('computers/new.html.twig', [
            'computer' => $computer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="computers_show", methods={"GET"})
     */
    public function show(Computers $computer): Response
    {
        return $this->render('computers/show.html.twig', [
            'computer' => $computer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="computers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Computers $computer): Response
    {
        $form = $this->createForm(ComputersType::class, $computer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('computers_index');
        }

        return $this->render('computers/edit.html.twig', [
            'computer' => $computer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="computers_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Computers $computer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$computer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($computer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('computers_index');
    }
}
