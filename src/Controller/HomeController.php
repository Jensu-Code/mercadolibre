<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA.
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace App\Controller;

use App\Entity\ProductoCategoria;
use App\Repository\ProductoCategoriaRepository;
use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductoRepository $productoRepository,ProductoCategoriaRepository $categoria): Response
    {
         $categorias = $categoria->findAll();
         $productos = $productoRepository->getAllProductos();
        return $this->render('home/home.html.twig',[
            'productos' => $productos,
            'categorias'=> $categorias,
            'dataCategorias'=>$productoRepository->getAllProductos(1)
        ]
        );
    }
    // #[Route('/page', name: 'app_producto_page', methods: ['GET'])]
    // public function page(Request $request,ProductoRepository $productoRepository,ProductoCategoriaRepository $categoria): Response
    // {
    //     $npage = $request->query->getInt('npage');
    //     $categorias = $categoria->findAll();
    //     return $this->render('home/home.html.twig', [
    //         'productos' => $productoRepository->getProductosForPage($npage),
    //         'categorias'=> $categorias
    //     ]);
    // }
    // #[Route('/categoria', name: 'app_producto_categoria', methods: ['GET'])]
    // public function categoria(Request $request,ProductoRepository $productoRepository,ProductoCategoriaRepository $categoria): Response
    // {
    //     $nombreCategoria = $request->query->get('categoria');
    //     $categorias = $categoria->findAll();
    //     return $this->render('home/home.html.twig', [
    //         'productos' => $productoRepository->getProductosByCategory(urldecode($nombreCategoria)),
    //         'categorias'=> $categorias
    //     ]);
    // }

    #[Route('/admin', name: 'app_admin')]
    public function admin(): Response
    {
        return $this->render('home/dashboard.html.twig');
    }
}
