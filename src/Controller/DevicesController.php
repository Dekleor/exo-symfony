<?php

namespace App\Controller;

use App\Entity\Devices;
use App\Form\DevicesType;
use App\Repository\DevicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/devices")
 */
class DevicesController extends AbstractController
{
    /**
     * @Route("/", name="devices_index", methods={"GET"})
     */
    public function index(DevicesRepository $devicesRepository): Response
    {
        return $this->render('devices/index.html.twig', [
            'devices' => $devicesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="devices_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $device = new Devices();
        $form = $this->createForm(DevicesType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $device->setCreatedAt(new DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($device);
            $entityManager->flush();

            return $this->redirectToRoute('devices_index');
        }

        return $this->render('devices/new.html.twig', [
            'device' => $device,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="devices_show", methods={"GET"})
     */
    public function show(Devices $device): Response
    {
        return $this->render('devices/show.html.twig', [
            'device' => $device,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="devices_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Devices $device): Response
    {
        $form = $this->createForm(DevicesType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $device->setUpdatedAt(new DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('devices_index');
        }

        return $this->render('devices/edit.html.twig', [
            'device' => $device,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="devices_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Devices $device): Response
    {
        if ($this->isCsrfTokenValid('delete'.$device->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($device);
            $entityManager->flush();
        }

        return $this->redirectToRoute('devices_index');
    }
}
