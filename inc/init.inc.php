<!-- Le fichier init.inc.php (nommé .inc car destiné à l'inclusion et non pas à l'affichage), va nous permettre d'initialiser plusieurs choses sur notre site web. -->

<?php
//--------- BDD
$mysqli = new mysqli("localhost", "root", "", "site"); // nom du serveur, le pseudo, le mot de passe, et la base de données
if ($mysqli->connect_error) // condition est présente $mysqli->connect_error pour afficher un message d'erreur en Français si jamais la connexion ne peut pas se faire
    die('Un problème est survenu lors de la tentative de connexion à la BDD : ' . $mysqli->connect_error);
// $mysqli->set_charset("utf8"); // permet de régler l'encodage de la base de données.

//--------- SESSION: permettra en effet de maintenir (et ne pas perdre) l'internaute connecté au site web même s'il navigue de page en page.
session_start(); // permet de créer (ou lire) 1 fichier de session sur le serveur

//--------- CHEMIN
define("RACINE_SITE", "/php2/site/"); // permet de gérer notre site web en chemin absolu et non pas relatif.

//--------- VARIABLES
$contenu = ''; // est une variable initialisée à vide pour éviter d'avoir des erreurs undefined si jamais nous tentons de l'afficher.

//--------- AUTRES INCLUSIONS
require_once("fonction.inc.php"); // nous allons inclure notre fichier de fonction avec nous. Du coup, lorsque nous appellerons le fichier init.inc.php, cela aura aussi pour effet d'inclure le fichier fonction.inc.php, (2 en 1) !