<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA.
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace App\Controller;

use App\Entity\ProductoCategoria;
use App\Form\ProductoCategoriaType;
use App\Repository\ProductoCategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/producto-categoria')]
class ProductoCategoriaController extends AbstractController
{
    #[Route('/', name: 'app_producto_categoria_index', methods: ['GET'])]
    public function index(ProductoCategoriaRepository $productoCategoriaRepository): Response
    {
        return $this->render('producto_categoria/index.html.twig', [
            'producto_categorias' => $productoCategoriaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_producto_categoria_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $productoCategorium = new ProductoCategoria();
        $form = $this->createForm(ProductoCategoriaType::class, $productoCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productoCategorium);
            $entityManager->flush();

            return $this->redirectToRoute('app_producto_categoria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('producto_categoria/new.html.twig', [
            'producto_categorium' => $productoCategorium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_producto_categoria_show', methods: ['GET'])]
    public function show(ProductoCategoria $productoCategorium): Response
    {
        return $this->render('producto_categoria/show.html.twig', [
            'producto_categorium' => $productoCategorium,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_producto_categoria_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductoCategoria $productoCategorium, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductoCategoriaType::class, $productoCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_producto_categoria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('producto_categoria/edit.html.twig', [
            'producto_categorium' => $productoCategorium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_producto_categoria_delete', methods: ['POST'])]
    public function delete(Request $request, ProductoCategoria $productoCategorium, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productoCategorium->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($productoCategorium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_producto_categoria_index', [], Response::HTTP_SEE_OTHER);
    }
}
