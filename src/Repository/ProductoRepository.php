<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA.
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace App\Repository;

use App\Entity\Producto;
use App\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Producto>
 *
 * @method Producto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Producto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Producto[]    findAll()
 * @method Producto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producto::class);
    }

    //    /**
    //     * @return Producto[] Returns an array of Producto objects
    //     */
    public function getAllProductos(?int $filterByCategoria = null): array
    {
        $queryBuider = $this->createQueryBuilder('producto')
            ->select('producto', 'categoria', 'vendedor', 'foto')
            ->join('producto.categoria', 'categoria')
            ->join('producto.vendedor', 'vendedor')
            ->leftJoin('producto.foto', 'foto')
            ->where('producto.activo = true')
            ->orderBy('producto.created_att', 'DESC')
            ->getQuery()
            ->getResult();

        if ($filterByCategoria !== null) {
            $dataCategoria = [];
            foreach ($queryBuider as $producto) {
                if (!isset($dataCategoria[$producto->getCategoria()->getId()])) {
                    $dataCategoria[$producto->getCategoria()->getId()] = [];
                }
                $datacategoria[$producto->getCategoria()->getId()][] = $producto;
            }
            return $datacategoria;
        }
        return $queryBuider;
    }
    public function getProductosForPage(?int $pagina = null): array
    {
        $pagina = $pagina ?? 1;
        $total =  8;
        $offset = ($pagina - 1) * $total;

        return $this->createQueryBuilder('producto')
            ->select('producto', 'categoria', 'vendedor', 'foto')
            ->join('producto.categoria', 'categoria')
            ->join('producto.vendedor', 'vendedor')
            ->leftJoin('producto.foto', 'foto')
            ->where('producto.activo = true')
            ->orderBy('producto.created_att', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($total)
            ->getQuery()
            ->getResult();
    }

    public function getProductosByCategory($category)
    {

        return $this->createQueryBuilder('producto')
            ->select('producto', 'categoria', 'vendedor', 'foto')
            ->join('producto.categoria', 'categoria')
            ->join('producto.vendedor', 'vendedor')
            ->leftJoin('producto.foto', 'foto')
            ->where('producto.activo = true')
            ->andWhere('categoria.nombre = :category')
            ->setParameter('category', $category)
            ->orderBy('producto.created_att', 'DESC')
            ->setMaxResults(8)
            ->getQuery()
            ->getResult();
    }

    public function findLatest(int $page = 1, ?int $pageSize = null, ?int $idCategoria = 0): Paginator
    {
        $qb = $this->createQueryBuilder('producto')
            ->select('producto', 'categoria', 'vendedor', 'foto')
            ->join('producto.categoria', 'categoria')
            ->join('producto.vendedor', 'vendedor')
            ->leftJoin('producto.foto', 'foto')
            ->orderBy('producto.created_att', 'DESC');
        if ($idCategoria !== 0) {
            $qb->where('categoria.id = :idCategoria')
                ->setParameter('idCategoria', $idCategoria);
        }

        return (new Paginator($qb))->paginate($page, $pageSize);
    }

    public function contarProductosPorCategoria(): array
    {
        return $this->createQueryBuilder('producto')
            ->select('categoria.nombre as nombre,categoria.id as categoriaId')
            ->addSelect('COUNT(producto.id) as total')
            ->join('producto.categoria', 'categoria')
            ->where('producto.activo = true')
            ->groupBy('categoria.id')
            ->getQuery()
            ->getResult();
    }

    public function totalProducts(): ?int
    {
        return $this->createQueryBuilder('producto')
            ->select('count(producto.id) as total')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function seachProduct(int $page , ?int $pageSize , ?int $idCategoria = 0,?string $name): Paginator
    {
        $qb = $this->createQueryBuilder('producto')
            ->select('producto', 'categoria', 'vendedor', 'foto')
            ->join('producto.categoria', 'categoria')
            ->join('producto.vendedor', 'vendedor')
            ->leftJoin('producto.foto', 'foto')
            ->orderBy('producto.created_att', 'DESC');

        if(!empty($name) && $name!==null){
            $qb->andWhere('producto.nombre LIKE :name')
               ->setParameter('name','%'.$name.'%');
        }
        if ($idCategoria !== 0) {
            $qb->where('categoria.id = :idCategoria')
                ->setParameter('idCategoria', $idCategoria);
        }
        return (new Paginator($qb))->paginate($page, $pageSize);
    }
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Producto
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
