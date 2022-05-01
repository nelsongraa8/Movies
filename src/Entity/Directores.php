<?php

namespace App\Entity;

use App\Repository\DirectoresRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DirectoresRepository::class)
 */
class Directores
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Nombre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @ORM\ManyToOne(targetEntity=Peliculas::class, inversedBy="Directores")
     */
    private $peliculas;

    public function __toString(): string
    {
        return $this->getNombre();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(?\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getPeliculas(): ?Peliculas
    {
        return $this->peliculas;
    }

    public function setPeliculas(?Peliculas $peliculas): self
    {
        $this->peliculas = $peliculas;

        return $this;
    }
}
