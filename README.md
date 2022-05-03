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

El archivo ImportCsvCommand.php se encuentra en src/Command/ImportCsvCommand.php y almacena el codigo que importa y lee el CSV

Lo he desacoplado directamente de la insercion de los elementos a la DB repetando SOLID y desacoplando la forma en la que se insertan los datos.
De esta manera si hay que hacer cambios en la forma de insercion en el futuro no se deberia tocar nada del archivo principal y se va directamente a su Utils.

El parametro verificationExistMovie() en la clase App\Utils\InsertPeliculaInDb su funcionalidad es para verificar si se ha insertado el elemento ya en la DB comparando almenos con el titulo de la pelicula que se esta cargando desde el CSV.

Trabajo con .env.local, asi subo al repositorio el .env para que las variables dev de cada entorno sean distintas. Ademas de esta manera funciona correctamente la integracion continua en GitHub Action y no hay problemas con que las variables de entorno sean vivisbles sus valores no se suben al repositorio.

Usando la libreria de CaptainHook puedo ejecutar comandos otras librerias en entorno de dev, pre commit, asi no necesito esperar a que Github Actions me diga el estado del commit si se lanza es porque paso todas las pruebas con phpcs y demas libreria que se irian usando en el repositorio. Asi puedo ejecutar herramientas que Github Action es incapas de correr en su sistema como la automatizacion de test con PHPPanther el cual recluta al navegador web para ejecutar todas las pruebas en ligar de se la interface simple de WebTestCase.
EL commit no se ejecuta hasta que todas las pruebas no esten completamente funcionales.

## Cosas para hacer en un proyecto real:
- Crear test funcionales a las rutas que se vayan creando en el panel de administracion de esta manera la refactorisacion de codigo en el futuro no corre peligro.
- Crear test Unitarios a los metodos principales mokeando los datos que necesitan los mismos.
- Crear test Unitarios a los metodos de la clase Utils para verificar que se han insertado correctamente los datos en la DB.
- Añadir Symfony Security al panel de administracion para poder crear usuarios y roles.
- Traeria los datos desde la API de IMDb o desde TMDB, que tienen una potente API con los datos actualizados, en lugar de cargarlos desde un CSV.