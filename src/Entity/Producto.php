<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA.
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace App\Entity;

use App\Repository\ProductoRepository;
use CarlosChininin\AttachFile\Model\AttachFile;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 12, scale: 2)]
    private ?string $precio = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $descuento = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProductoCategoria $categoria = null;

    #[ORM\Column]
    private bool $activo = true;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?AttachFile $foto = null;
    
    public function __toString()
    {
        return $this->nombre;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function getDescuento(): ?int
    {
        return $this->descuento;
    }

    public function setDescuento(int $descuento): static
    {
        $this->descuento = $descuento;

        return $this;
    }

    public function getCategoria(): ?ProductoCategoria
    {
        return $this->categoria;
    }

    public function setCategoria(?ProductoCategoria $categoria): static
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function isActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): static
    {
        $this->activo = $activo;

        return $this;
    }

    public function getFoto(): ?AttachFile
    {
        return $this->foto;
    }

    public function setFoto(?AttachFile $foto): static
    {
        $this->foto = $foto;

        return $this;
    }
}
