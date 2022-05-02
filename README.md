# Peliculas

Administrar peliculas usando la interface de EasyAdmin trabajada a medida para poder editar e insertar los elementos desde un archivo csv.


## Instalacion del proyecto
```
composer install
```

## Comando a ejecutar
En entorno dev
```
composer console app:import-csv
```

En entorno de prod
```
php bin/console app:import-csv
```

### Notas

Para leer los archivos CSV uso la libreria [League\Csv](https://csv.thephpleague.com)

el archivo ImportCsvCommand.php se encuentra en src/Command/ImportCsvCommand.php y almacena el codigo que importa y lee el CSV

Lo he desacoplado directamente de la insercion de los elementos a la DB repetando SOLID y desacoplando la forma en la que se insertan los datos.
De esta manera si hay que hacer cambios en la forma de insercion en el futuro no se deberia tocar nada del archivo principal y se va directamente a su Utils.

El parametro verificationExistMovie() en la clase App\Utils\InsertPeliculaInDb su funcionalidad es para verificar si se ha insertado el elemento ya en la DB comparando almenos con el titulo de la pelicula que se esta cargando desde el CSV.

Trabajo con .en.local, asi subo al repositorio el .env para que las variables de entorno dev de cada entorno sean distintas. Ademas de esta manera funciona correctamente la integracion continua en GitHub Action y no hay problemas con que las variables de entorno sean vivisbles porque tiene diferentes valores.

Usando la libreria de CaptainHook puedo ejecutar librerias en entorno de dev pre commit, asi no necesito esperar a que Github Actions me diga el estado del commit si se lanza es porque paso todas las pruebas con phpcs y demas libreria que se irian usando en el repositorio. Asi puedo ejecutar herramientas que Github Action es incapas de correr en su sistema como la automatizacion de test con PHPPanther el cual recluta al navegador web para ejecutar todas las pruebas en ligar de se la interface simple de WebTestCase.
EL commit no se ejecuta hasta que todas las pruebas no esten completamente funcionales.
