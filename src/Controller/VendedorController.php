<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA.
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace App\Controller;

use App\Entity\Vendedor;
use App\Form\VendedorType;
use App\Repository\VendedorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/vendedor')]
class VendedorController extends AbstractController
{
    #[Route('/', name: 'app_vendedor_index', methods: ['GET'])]
    public function index(VendedorRepository $vendedorRepository): Response
    {
        return $this->render('vendedor/index.html.twig', [
            'vendedors' => $vendedorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_vendedor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vendedor = new Vendedor();
        $form = $this->createForm(VendedorType::class, $vendedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vendedor);
            $entityManager->flush();

            return $this->redirectToRoute('app_vendedor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vendedor/new.html.twig', [
            'vendedor' => $vendedor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vendedor_show', methods: ['GET'])]
    public function show(Vendedor $vendedor): Response
    {
        return $this->render('vendedor/show.html.twig', [
            'vendedor' => $vendedor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vendedor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vendedor $vendedor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VendedorType::class, $vendedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_vendedor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vendedor/edit.html.twig', [
            'vendedor' => $vendedor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vendedor_delete', methods: ['POST'])]
    public function delete(Request $request, Vendedor $vendedor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vendedor->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($vendedor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_vendedor_index', [], Response::HTTP_SEE_OTHER);
    }
}
