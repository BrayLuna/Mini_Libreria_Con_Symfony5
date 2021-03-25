<?php

namespace App\Entity;

use App\Repository\BibliotecaRepository;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\FuncCall;

/**
 * @ORM\Entity(repositoryClass=BibliotecaRepository::class)
 */
class Biblioteca
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", length=10000)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $autor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $portada;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */

    private $descripcionCorta;

    /**
     * @ORM\Column(type="integer", length=13, nullable=true)
     */

    private $ISBN;

      /**
     * @ORM\Column(type="string", length=70 , nullable=true)
     */
    private $editorial;

      /**
     * @ORM\Column(type="integer", length=50 , nullable=true)
     */
    private $paginas;

      /**
     * @ORM\Column(type="integer", length=50 , nullable=true)
     */
    private $edicion;

      /**
     * @ORM\Column(type="string", length=50 , nullable=true)
     */
    private $pais;


      /**
     * @ORM\Column(type="integer", length=70 , nullable=true)
     */
    private $lanzamiento;





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
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

    public function getISBN(): ?int
    {
        return $this->ISBN;
    }

    public function setISBN(int $ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getEditorial(): ?string
    {
        return $this->editorial;
    }

    public function setEditorial(string $editorial): self
    {
        $this->editorial = $editorial;

        return $this;
    }
    
    public function getPaginas(): ?int
    {
        return $this->paginas;
    }

    public function setPaginas(int $paginas): self
    {
        $this->paginas = $paginas;

        return $this;
    }
    
    public function getEdicion(): ?int
    {
        return $this->edicion;
    }

    public function setEdicion(int $edicion): self
    {
        $this->edicion = $edicion;

        return $this;
    }
    
    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(string $pais): self
    {
        $this->pais = $pais;

        return $this ;
    }
    
    public function getLanzamiento(): ?int
    {
        return $this->lanzamiento;
    }

    public function setLanzamiento(int $lanzamiento): self
    {
        $this->lanzamiento = $lanzamiento;

        return $this;
    }
    
    public function getDescripcionCorta(): ?string
    {
        return $this->descripcionCorta;
    }

    public function setDescripcionCorta(string $descripcionCorta): self
    {
        $this->descripcionCorta = $descripcionCorta;

        return $this;
    }
    
    
}
