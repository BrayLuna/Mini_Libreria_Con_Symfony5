<?php

namespace App\Entity;

use App\Repository\LibroRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LibroRepository::class)
 */
class Libro
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="integer")
     */
    private $ISBN;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $autor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $portada;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getISBN(): ?int
    {
        return $this->ISBN;
    }

    public function setISBN(int $ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getPortada(): ?string
    {
        return $this->portada;
    }

    public function setPortada(string $portada): self
    {
        $this->portada = $portada;

        return $this;
    }
}
