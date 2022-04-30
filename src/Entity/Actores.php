<?php

namespace App\Entity;

use App\Repository\ActoresRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActoresRepository::class)
 */
class Actores
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fechaFallecimiento;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $lugarNacimiento;

    /**
     * @ORM\ManyToOne(targetEntity=Peliculas::class, inversedBy="Actores")
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

    public function getFechaFallecimiento(): ?string
    {
        return $this->fechaFallecimiento;
    }

    public function setFechaFallecimiento(?string $fechaFallecimiento): self
    {
        $this->fechaFallecimiento = $fechaFallecimiento;

        return $this;
    }

    public function getLugarNacimiento(): ?string
    {
        return $this->lugarNacimiento;
    }

    public function setLugarNacimiento(?string $lugarNacimiento): self
    {
        $this->lugarNacimiento = $lugarNacimiento;

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
