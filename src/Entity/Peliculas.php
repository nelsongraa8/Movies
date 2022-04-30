<?php

namespace App\Entity;

use App\Repository\PeliculasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeliculasRepository::class)
 */
class Peliculas
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
    private $titulo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaPublicacion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $genero;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duracion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $productora;

    /**
     * @ORM\OneToMany(targetEntity=Directores::class, mappedBy="peliculas")
     */
    private $Directores;

    /**
     * @ORM\OneToMany(targetEntity=Actores::class, mappedBy="peliculas")
     */
    private $Actores;

    public function __construct()
    {
        $this->Directores = new ArrayCollection();
        $this->Actores = new ArrayCollection();
    }

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

    public function getfechaPublicacion(): ?\DateTimeInterface
    {
        return $this->fechaPublicacion;
    }

    public function setfechaPublicacion(?\DateTimeInterface $fechaPublicacion): self
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(?string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getDuracion(): ?int
    {
        return $this->duracion;
    }

    public function setDuracion(?int $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getProductora(): ?string
    {
        return $this->productora;
    }

    public function setProductora(?string $productora): self
    {
        $this->productora = $productora;

        return $this;
    }

    /**
     * @return Collection<int, Directores>
     */
    public function getDirectores(): Collection
    {
        return $this->Directores;
    }

    public function addDirectore(Directores $directore): self
    {
        if (!$this->Directores->contains($directore)) {
            $this->Directores[] = $directore;
            $directore->setPeliculas($this);
        }

        return $this;
    }

    public function removeDirectore(Directores $directore): self
    {
        if ($this->Directores->removeElement($directore)) {
            // set the owning side to null (unless already changed)
            if ($directore->getPeliculas() === $this) {
                $directore->setPeliculas(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Actores>
     */
    public function getActores(): Collection
    {
        return $this->Actores;
    }

    public function addActore(Actores $actore): self
    {
        if (!$this->Actores->contains($actore)) {
            $this->Actores[] = $actore;
            $actore->setPeliculas($this);
        }

        return $this;
    }

    public function removeActore(Actores $actore): self
    {
        if ($this->Actores->removeElement($actore)) {
            // set the owning side to null (unless already changed)
            if ($actore->getPeliculas() === $this) {
                $actore->setPeliculas(null);
            }
        }

        return $this;
    }
}
