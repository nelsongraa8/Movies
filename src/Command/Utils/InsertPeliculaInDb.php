<?php

namespace App\Command\Utils;

use DateTime;
use App\Entity\Actores;
use App\Entity\Peliculas;
use App\Entity\Directores;
use Doctrine\Persistence\ManagerRegistry;

class InsertPeliculaInDb
{
    public ManagerRegistry $doctrine;

    /**
     * Inyectando la dependencia de Doctrine\Persistence\ManagerRegistry
     * para poder persistir los datos en la DB
     *
     * @param ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Insertar cada elemento que se importa en las
     * respectivas tablas
     *
     * @param [string] $titulo
     * @param [string] $fechaPublicacion
     * @param [string] $genero
     * @param [interger] $duracion
     * @param [string] $productora
     * @param [string] $director
     * @param [string] $actores
     *
     * @return Boolean
     */
    public function methodInsertPelicula(
        $titulo,
        $fechaPublicacion,
        $genero,
        $duracion,
        $productora,
        $director,
        $actor
    )
    {
        if ($this->verificationExistMovie($titulo)) {
            return false;
        }

        $entityManager = $this->doctrine->getManager();

        // Creando un objeto DateTime a partir de $fechaPublicacion
        $fechaPublicacionObj = new DateTime($fechaPublicacion);

        $actores = new Actores();
        $actores->setNombre($actor);
        $actores->setFechaNacimiento($fechaPublicacionObj);
        $actores->setFechaFallecimiento($fechaPublicacionObj);
        $actores->setLugarNacimiento('España');

        $directores = new Directores();
        $directores->setNombre($director);
        $directores->setFechaNacimiento($fechaPublicacionObj);

        $pelicula = new Peliculas();
        $pelicula->setTitulo($titulo);
        $pelicula->setFechaPublicacion($fechaPublicacionObj);
        $pelicula->setGenero($genero);
        $pelicula->setDuracion($duracion);
        $pelicula->setProductora($productora);

        $pelicula->addDirectore($directores);
        $pelicula->addActore($actores);

        $entityManager->persist($pelicula);
        $entityManager->persist($directores);
        $entityManager->persist($actores);

        $entityManager->flush();

        return true;
    }

    /**
     * Verifica si la pelicula ya existe en la base de datos
     *
     * @param [string] $titulo
     *
     * @return Boolean
     */
    public function verificationExistMovie($titulo)
    {
        $entityManager = $this->doctrine->getManager();

        $pelicula = $entityManager->getRepository(Peliculas::class)
            ->findOneBy(
                ['titulo' => $titulo]
            );

        if (!$pelicula) {
            return false;
        }

        return true;
    }
}
