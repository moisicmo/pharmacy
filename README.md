# SISTEMA DE INVENTARIO DE FARMACIA



## EMPEZAR

existen dos alternativas:
  - levantar el proyecto con XAMPP o WAMPP
  - levantar el proyecto con DOCKER

## COMO LEVANTAR CON DOCKER

  - instalar docker
  - ejecutar docker-compose up --build -d
  - :D
  - tu proyecto esta en http://localhost:29000
  - phpmyadmin esta en http://localhost:29005

## BASE DE DATOS

  - crea la base de datos llamada pharmacy 
  - importa el archivo .sql al phpmyadmin


  como subir codigo
  siempre comenzar haciendo un git stash
  - git stash save "nombre para acordarse" <- esto guarda su codigo o avance en memoria, sin comiilas
  - git pull <- esto trae todos los cambios existentes en el repositorio
  - git stash pop <- esto trae el codigo guardado al proyecto
  en este momento es preferible corregir todos los errores y conflictos
  - git add . <- agrega en memoria todos los archivos que sufrieron cambios para enviar
  - git commit -m "mensaje" <- prepara el commit con un mensaje, con comillas
  - git pus <- envia el codigo al repositorio