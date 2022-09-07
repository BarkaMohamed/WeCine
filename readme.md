# WE Cine Test

Requirements
-------------

php > 7.4

composer v2.4.1(https://getcomposer.org/download/)

symfony cli (https://symfony.com/download)

récupérez une clé API dépuis votre compte TMDB  

Installation
------------

executez la commande : composer install

créez le fichier .env.local sous la racine

définissez les variables d'environnement dans le fichier .env.local :


* MOVIE_DB_API_URL=https://api.themoviedb.org
* MOVIE_DB_API_VERSION=3
* MOVIE_DB_API_KEY= VOTRE_CLE_API
* MOVIE_DB_API_LANGUAGE=FR


executez la commande : symfony server:start


