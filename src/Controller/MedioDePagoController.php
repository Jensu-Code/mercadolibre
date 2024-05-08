<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA.
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace App\Controller;

use App\Entity\MedioDePago;
use App\Form\MedioDePagoType;
use App\Repository\MedioDePagoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/medio-pago')]
class MedioDePagoController extends AbstractController
{
    #[Route('/', name: 'app_medio_de_pago_index', methods: ['GET'])]
    public function index(MedioDePagoRepository $medioDePagoRepository): Response
    {
        return $this->render('medio_de_pago/index.html.twig', [
            'medio_de_pagos' => $medioDePagoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_medio_de_pago_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $medioDePago = new MedioDePago();
        $form = $this->createForm(MedioDePagoType::class, $medioDePago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($medioDePago);
            $entityManager->flush();

            return $this->redirectToRoute('app_medio_de_pago_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('medio_de_pago/new.html.twig', [
            'medio_de_pago' => $medioDePago,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medio_de_pago_show', methods: ['GET'])]
    public function show(MedioDePago $medioDePago): Response
    {
        return $this->render('medio_de_pago/show.html.twig', [
            'medio_de_pago' => $medioDePago,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_medio_de_pago_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MedioDePago $medioDePago, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MedioDePagoType::class, $medioDePago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_medio_de_pago_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('medio_de_pago/edit.html.twig', [
            'medio_de_pago' => $medioDePago,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medio_de_pago_delete', methods: ['POST'])]
    public function delete(Request $request, MedioDePago $medioDePago, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medioDePago->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($medioDePago);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_medio_de_pago_index', [], Response::HTTP_SEE_OTHER);
    }
}
