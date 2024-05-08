<?php
namespace App\Controller\Front;

use App\Entity\Producto;
use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Requirement\Requirement;

 #[Route('/producto')]
final class ProductoController extends AbstractController{

    private const PAGE_SIZE = 6;
    #[Route('/{id}', name: 'front_producto_detalle', requirements:['id'=> Requirement::POSITIVE_INT])]
    public function detalle(Producto $producto): Response
    {
        return $this->render('front/producto/index.html.twig', [
            'producto' => $producto,
        ]);
    }

    #[Route('/all', name: 'front_producto_all')]
    public function todos(Request $request, ProductoRepository $productoRepository): Response
    {
        $page = $request->query->getInt('page', 1);
        $idCategoria= $request->query->getInt('categoriaId',0);
        $name = $request->query->get('buscar');
        // $paginator = $productoRepository->findLatest($page, self::PAGE_SIZE,$idCategoria);
        $paginator= $productoRepository->seachProduct($page,self::PAGE_SIZE, $idCategoria,$name);
        $categoriasData = $productoRepository->contarProductosPorCategoria();
        // $totalProductos = 0;
        // foreach ($categoriasData as $item) {
        //     $totalProductos += $item['total'];
        // }

        return $this->render('front/producto/all.html.twig', [
            'paginator' => $paginator,
            'categoriasData' => $categoriasData,
            // 'totalProductos' => $totalProductos,
        ]);
    }

    #[Route('/total-products',name:'from_total_products',methods:['POST'])]
    public function totalProducts(ProductoRepository $repository){
        $totalProductos = $repository->totalProducts();
        return $this->json($totalProductos);
    }
}
?>