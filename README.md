# Procedimientos para instalar el repositorio con la billetera virtual


Consideraciones:

El proyecto se realizó symfony 4.4.*, XAMPP. 

Para la instalación deberá tener instalado

MySql, PHP 7 en adelante, composer, npm

Instalación

Paso 1: Clonar el repositorio

git clone https://github.com/dperea10/Billetera.git

Paso 2: Ubicar el repositorio en su host

En este proyecto se utilizo XAMPP y la ruta para ello es; xampp\htdocs\NOMBREDELPROYECTO en este caso /xampp/htdocs/WalletPt

Paso 3: Ingresar desde la terminal del equipo o desde su IDE

nos ubicamos dentro del proyecto con (cd /xampp/htdocs/WalletPt)

Paso 4: instalamos y actualiamos los recursos pertinentes 

composer install

al terminar aplicamos

composer update

Paso 5 configuraciones
creamos una copiar del archivo .env que esta alli de ejemplo para poder ingresar las configuraciones de la base de datos, email
Ubicamos en la linea de la base de datos donde le asignaremos el usuario y la contraseña de BD, para establecer la conexión
Ejemplo

DATABASE_URL=mysql://USUARIO:CONTRASEÑAS@127.0.0.1:3306/NOMBREDELABASEDEDATOS

Paso 6 Creación de la base de datos
Una vez creado los parametros de conexion desde la termina ingrese 

  php bin/console doctrine:database:create
 
Paso 8 Creación de las tablas
 Segun la configuracion interna del proyecto creara el conjunto de tablas relacionadas para poder trabajar con ellas solo ingrese 
 en el terminal:
 
  php bin/console doctrine:schema:update --force
  
Listo! El proyecto está en sus manos para probar su funcionamiento.


Esperen...

Aca también se les comparte la colección de pruebas desde POSTMAN la misma se encuentra documentada.

https://documenter.getpostman.com/view/11089885/Szf82TeH

Ahora si...

