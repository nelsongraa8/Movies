<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220501080343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_D72947DB9EDD74B8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__actores AS SELECT id, peliculas_id, nombre, fecha_nacimiento, fecha_fallecimiento, lugar_nacimiento FROM actores');
        $this->addSql('DROP TABLE actores');
        $this->addSql('CREATE TABLE actores (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, peliculas_id INTEGER DEFAULT NULL, nombre CLOB NOT NULL, fecha_nacimiento DATE DEFAULT NULL, fecha_fallecimiento DATE DEFAULT NULL, lugar_nacimiento CLOB DEFAULT NULL, CONSTRAINT FK_D72947DB9EDD74B8 FOREIGN KEY (peliculas_id) REFERENCES peliculas (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO actores (id, peliculas_id, nombre, fecha_nacimiento, fecha_fallecimiento, lugar_nacimiento) SELECT id, peliculas_id, nombre, fecha_nacimiento, fecha_fallecimiento, lugar_nacimiento FROM __temp__actores');
        $this->addSql('DROP TABLE __temp__actores');
        $this->addSql('CREATE INDEX IDX_D72947DB9EDD74B8 ON actores (peliculas_id)');
        $this->addSql('DROP INDEX IDX_9B39D1D89EDD74B8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__directores AS SELECT id, peliculas_id, nombre, fecha_nacimiento FROM directores');
        $this->addSql('DROP TABLE directores');
        $this->addSql('CREATE TABLE directores (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, peliculas_id INTEGER DEFAULT NULL, nombre CLOB NOT NULL, fecha_nacimiento DATE DEFAULT NULL, CONSTRAINT FK_9B39D1D89EDD74B8 FOREIGN KEY (peliculas_id) REFERENCES peliculas (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO directores (id, peliculas_id, nombre, fecha_nacimiento) SELECT id, peliculas_id, nombre, fecha_nacimiento FROM __temp__directores');
        $this->addSql('DROP TABLE __temp__directores');
        $this->addSql('CREATE INDEX IDX_9B39D1D89EDD74B8 ON directores (peliculas_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_D72947DB9EDD74B8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__actores AS SELECT id, peliculas_id, nombre, fecha_nacimiento, fecha_fallecimiento, lugar_nacimiento FROM actores');
        $this->addSql('DROP TABLE actores');
        $this->addSql('CREATE TABLE actores (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, peliculas_id INTEGER DEFAULT NULL, nombre CLOB NOT NULL, fecha_nacimiento VARCHAR(255) DEFAULT NULL, fecha_fallecimiento VARCHAR(255) DEFAULT NULL, lugar_nacimiento CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO actores (id, peliculas_id, nombre, fecha_nacimiento, fecha_fallecimiento, lugar_nacimiento) SELECT id, peliculas_id, nombre, fecha_nacimiento, fecha_fallecimiento, lugar_nacimiento FROM __temp__actores');
        $this->addSql('DROP TABLE __temp__actores');
        $this->addSql('CREATE INDEX IDX_D72947DB9EDD74B8 ON actores (peliculas_id)');
        $this->addSql('DROP INDEX IDX_9B39D1D89EDD74B8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__directores AS SELECT id, peliculas_id, nombre, fecha_nacimiento FROM directores');
        $this->addSql('DROP TABLE directores');
        $this->addSql('CREATE TABLE directores (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, peliculas_id INTEGER DEFAULT NULL, nombre CLOB NOT NULL, fecha_nacimiento DATE DEFAULT NULL)');
        $this->addSql('INSERT INTO directores (id, peliculas_id, nombre, fecha_nacimiento) SELECT id, peliculas_id, nombre, fecha_nacimiento FROM __temp__directores');
        $this->addSql('DROP TABLE __temp__directores');
        $this->addSql('CREATE INDEX IDX_9B39D1D89EDD74B8 ON directores (peliculas_id)');
    }
}
