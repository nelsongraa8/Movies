<?php

namespace App\Command;

use League\Csv\Reader;
use League\Csv\Statement;
use App\Command\Utils\InsertPeliculaInDb;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCsvCommand extends Command
{
    protected static $defaultName = 'app:import-csv';
    protected static $defaultDescription = 'Comando para insertar los datos (peliculas) de un CSV en la base de datos';

    /**
     * Variable que almacena la clase para insertar las peliculas y verificar si existen en la base de datos
     *
     * @var InsertPeliculaInDb
     */
    private InsertPeliculaInDb $insertPelicula;

    /**
     * Inyectando las dependencias de Utils\InsertPeliculaInDb
     * para esta clase
     *
     * @param InsertPeliculaInDb $insertPelicula
     */
    function __construct(InsertPeliculaInDb $insertPelicula)
    {
        parent::__construct();
        $this->insertPelicula = $insertPelicula;
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        //load the CSV document from a stream
        $stream = fopen('./var/IMDb movies.csv', 'r');
        $csv = Reader::createFromStream($stream);

        $csv->setDelimiter(',');
        $csv->setHeaderOffset(0);

        $stmt = Statement::create()
            ->offset(0)
            ->limit(20);

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
                // Imprime que hay un error en la linea por falta de datos en el csv
                $output->writeln('<error>Error: Faltan Datos - Linea ' . $key . '</error>');
                continue;  // Dejar de procesar la línea
            }

            // Llamando al metodo para insertar los datos en la base de datos
            if (
                $this->insertPelicula
                    ->methodInsertPelicula(
                        $titulo,
                        $fechaPublicacion,
                        $genero,
                        $duracion,
                        $productora,
                        $director,
                        $actores
                    )
            ) {
                // Imprime que se inserto la pelicula
                $output->writeln('<info>Se inserto correctamente ' . $titulo . '</info>');
                continue;  //Dejar de procesar la línea
            }

            // Imprime por la salida de consola que ya existe la pelicula
            $output->writeln('Warning: Ya existe ' . $titulo);
        }

        $io->success('Comando completado satisfactoriamente');

        return Command::SUCCESS;
    }
}
