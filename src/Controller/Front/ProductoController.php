<?php
namespace App\Controller\Front;

use App\Entity\Producto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

 #[Route('/producto')]
final class ProductoController extends AbstractController{
    #[Route('/{id}', name: 'front_producto_detalle')]
    public function detalle(Producto $producto): Response
    {
        return $this->render('front/producto/index.html.twig', [
            'producto' => $producto,
        ]);
    }
}
?>