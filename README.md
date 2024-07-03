# ⚠️ Antes de comenzar ⚠️
Importante aclarar que no es una página web real, es un proyecto creado para el módulo de Desarrollo web en entorno servidor y con parte para la asignatura de Despliegue de aplicaciones web de segundo de ciclo de Desarrollo de aplicaciones web.

# ShareCar
Este proyecto va sobre una web para compatir coche. En el cuál, sus principales funciones serán crear, leer, actualizar y borrar datos (CRUD). 

# 📸 Página principal

![Pagina principal](./img/imgReadme/3.png)

# Instalación
1. El primer paso es clonar el repsitorio de la siguiente manera:
```
git clone https://github.com/SaraMarrero/ShareCar.git
```



2. El segundo paso es crear la base de datos, el archivo de la base de datos está en la siguiente ruta:
```
data/bbdd.sql
```
Puede instalarla por medio del xampp, solo tiene que activar mysql, entrar en shell con 'mysql -u root' y ahí copiar los datos del archivo que acabo de mencionar.

3. El tercer paso es crear el archivo '.env' en el cuál tendrá que crear las variables de entorno para poder conectarse con la base de datos ya creada, se debe mostrar así:
```
DB_HOST = localhost
DB_USER = root
DB_PASS = 
DB_NAME = sharecar

```

4. El cuarto paso es instalar las dependencias de composer de la siguiente manera:
```
composer install
composer update
```

Tras introducir esos comando se le debería de generar el archivo composer.lock

5. El quinto paso es tener activado apache y mysql en xampp, y ejecutar desde el directorio raíz el siguiente comando:
```
php -S localhost:8000
```

6. El sexto y último paso es ejecutar en el navegador la siguiente ruta:
```
http://localhost:8000
```

# Uso de la aplicación
## Usuario sin cuenta
El usuario que aún no tenga cuenta o no haya hecho login con sus datos solo podrá visualizar la página principal para ver un poco las características de lo que ofrece la web, si quiere acceder al resto de apartados, tendría que tener una cuenta activa. 

## 👤Usuario con cuenta
1. Para poder usar la web, si es nuevo usuario, primero tiene que registrarse, para acceder a la página de registro tendría que ir al menú, al botón desplegable para los usarios y ahí darle al botón de 'Registrarse', en caso de que ya tenga cuenta, deberá acceder al mismo botón desplegable y ahí entrar a 'Iniciar Sesión'.

2. Una vez dentro de la app, podrá publicar un viaje, ver los viajes disponibles, reservar un viaje o editar su propia información de usuario.

3. Para **publicar un viaje** tiene dos enlaces, uno en el menú y otro en medio de la página principal, una vez en acceda por uno de esos botones, deberá aparecer un formulario el cuál pida los datos del viaje (la fecha de salida, el origen, el destino y el número de pasajeros que pueden reservar), una vez introducidos los viajes solo faltaría darle al botón de 'Publicar viaje'.

4. Para **ver los viajes** disponibles tiene dos enlaces, uno en el menú y otro en medio de la página principal, una vez acceda por unos de esos botones, deberá aparecer una tablas con los viajes que aún esten disponibles para reservar.

5. Para **reservar un viaje** tiene que estar en la página de ver viajes, una vez ahí, si existen viajes disponibles se podrá apreciar que a la derecha de cada viaje se ve un botón que pone 'Reservar', si se le da click a ese botón la web va a llevarle a otra página donde habrá un formulario que pida cuantas plazas quiere reservar para dicho viaje, ahí introduce el número de plazas que quiere y al darle al botón de 'Reservar' la web le devolverá a la página de ver viajes.

6. Para **editar su propia información de usuario** tendría que ir al menú, al botón desplegable para los usarios y ahí darle al botón de 'Perfil', una vez dentro se verá una tabla con sus datos y a la derecha un botón que pone 'Editar', si le da a ese botón la web le mandará a una página con un formulario donde podrá editar sus datos, tras cambiar los datos que desee el usuario solo hay que darle al botón que poner que esta justo debajo que pone 'Editar' y la web lo volverá a llevar la página de perfil.

## 👤Administrador
1. El administrador podrá ver todos los viajes (los disponibles, los que ya no tengan plazas y los pasados de fecha), borrar viajes, ver todos los usuarios registrados en la web y borrar usuarios.

2. Para **ver todos los viajes** tiene dos enlaces, uno en el menú y otro en medio de la página principal, una vez acceda por unos de esos botones, deberá aparecer una tablas con todos los viajes los viajes especificiando en la columna de pasajeros si estan o no disponibles.

3. Para **eliminar viajes** tiene que estar en la página de ver viajes, una vez ahí, si existen viajes disponibles se podrá apreciar que a la derecha de cada viaje se ve un botón que pone 'Borrar', simplemente dandole click a ese botón ya se está eliminado el viaje.

4. Para **borar un usuario** tendría que ir al menú, al botón desplegable para los usarios y ahí darle al botón de 'Perfil', una vez dentro se verá una tabla los datos de todos los usuarios registrados (salvo la contraseña) y a la derecha un botón que pone 'Borrar', simplemente dandole click a ese botón ya se está eliminado el usuario.

# 🪛Tecnologías
Para llevar a cabo la realización de este proyecto, he utilizado:
* HTML
* CSS
* Bootstrap
* PHP
* Doxygen
* Github

# 👩🏻‍💻Autora
* Sara Marrero Miranda

# 📚Documentación
[Documentacion con Doxygen](https://sharecar.herokuapp.com/docs/html/index.html) 
