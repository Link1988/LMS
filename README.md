LMS (Learning Managment System)
=======================

Introducción
------------
Este proyecto busca crear una plataforma de aprendizaje Opensource que permita
a las instituciones educativas impartir sus cursos tanto de manera presencial
como de manera remota, ya sea utilizando solo un modelo o los dos al mismo tiempo
de esta manera si una institución desea impartir clases a distancia lo puede hacer
pero también puede ofrecer los cursos en línea a los alumnos presenciales
automatizando temas como calificaciones, tareas, proyectos, etc.


Instalación
------------

Utilizando Composer (requerido)
----------------------------
Clona el repositorio a tu computadora local y ejecuta composer:

    cd mi/proyecto/dir
    git clone https://github.com/gaboAcosta/LMS.git
    cd LMS
    php composer.phar self-update
    php composer.phar install

Crea la base de datos Utilizando el archivo /data/database/lms.sql

Virtual Host
------------
Es necesario crear un host virtual en apache que apunte a la carpeta public
Y debería ser suficiente para comenzar!
