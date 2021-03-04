<?php

namespace App\Controller;

use App\Entity\Components;
use App\Form\ComponentsType;
use App\Repository\ComponentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/components")
 */
class ComponentsController extends AbstractController
{
    /**
     * @Route("/", name="components_index", methods={"GET"})
     */
    public function index(ComponentsRepository $componentsRepository): Response
    {
        return $this->render('components/index.html.twig', [
            'components' => $componentsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="components_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $component = new Components();
        $form = $this->createForm(ComponentsType::class, $component);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($component);
            $entityManager->flush();

            return $this->redirectToRoute('components_index');
        }

        return $this->render('components/new.html.twig', [
            'component' => $component,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="components_show", methods={"GET"})
     */
    public function show(Components $component): Response
    {
        return $this->render('components/show.html.twig', [
            'component' => $component,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="components_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Components $component): Response
    {
        $form = $this->createForm(ComponentsType::class, $component);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('components_index');
        }

        return $this->render('components/edit.html.twig', [
            'component' => $component,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="components_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Components $component): Response
    {
        if ($this->isCsrfTokenValid('delete'.$component->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($component);
            $entityManager->flush();
        }

        return $this->redirectToRoute('components_index');
    }
}
