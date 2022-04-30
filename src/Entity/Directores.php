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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @ORM\ManyToOne(targetEntity=Peliculas::class, inversedBy="Directores")
     */
    private $peliculas;

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

    public function getFechaNacimiento(): ?string
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(?string $fechaNacimiento): self
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
