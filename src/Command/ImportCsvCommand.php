<?php

namespace App\Command;

use DateTime;
use League\Csv\Reader;
use App\Entity\Actores;
use App\Entity\Peliculas;
use League\Csv\Statement;
use App\Entity\Directores;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCsvCommand extends Command
{
    protected static $defaultName = 'app:import-csv';
    protected static $defaultDescription = 'Add a short description for your command';

    /**
     * Variable que almacena el manejador de entidades
     *
     * @var ManagerRegistry
     */
    private ManagerRegistry $doctrine;

    function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct();
        $this->doctrine = $doctrine;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        //load the CSV document from a stream
        $stream = fopen('./var/IMDb movies.csv', 'r');
        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(',');
        $csv->setHeaderOffset(0);

        $stmt = Statement::create()
            ->offset(0)
            ->limit(15);

        $records = $stmt->process($csv);
        foreach ($records as $key => $record) {
            // Datos tomados del CSV
            $titulo = $record['title'];
            $fechaPublicacion = $record['date_published'];
            $genero = $record['genre'];
            $duracion = $record['duration'];
            $productora = $record['production_company'];
            $director = $record['director'];
            $actores = $record['actors'];

            // Verificar si los campos que se necesitan para la creación de la entidad no están vacíos
            if (
                $titulo == '' ||
                $fechaPublicacion == '' ||
                $genero == '' ||
                $duracion == '' ||
                $productora == '' ||
                $director == '' ||
                $actores == ''
            ) {
                echo "+ Error en la linea $key\n";
                continue;  // Dejar de procesar la línea
            }

            // Llamando al metodo para insertar los datos en la base de datos
            if ($this->insertPeliculaCsv(
                $titulo,
                $fechaPublicacion,
                $genero,
                $duracion,
                $productora,
                $director,
                $actores
            )) {
                echo "+ Se inserto la pelicula $titulo\n";
                continue;  //Dejar de procesar la línea
            }

            // Imprime por la salida de consola el titulo de la pelicula
            echo "Ya existe " . $titulo . "\n";
        }

        $io->success('Insertados los elementos importados en la base de datos');

        return Command::SUCCESS;
    }

    /**
     * Insertar cada elemento que se importa en las respectivas tablas
     *
     * @param [string] $titulo
     * @param [string] $fechaPublicacion
     * @param [string] $genero
     * @param [interger] $duracion
     * @param [string] $productora
     * @param [string] $director
     * @param [string] $actores
     *
     * @return void
     */
    public function insertPeliculaCsv(
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
