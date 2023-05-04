<?php
require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if (!internauteEstConnecte()) // vérifie si l'internaute (!) N'EST PAS connecté (le point d'exclamation demande si la fonction renvoie false, donc si l'internaute n'est pas connecté).
    header("location:connexion.php"); // Si l'internaute n'est pas connecté, il n'a rien à faire sur la page de profil, nous le renvoyons vers la page de connexion
// debug($_SESSION);
// Pour construire la page de profil, nous piochons dans le fichier session (dans le dossier /tmp/ sur le serveur, 
// par l'intermédiaire de la superglobale $_SESSION) afin d'afficher les informations de l'internaute connecté.
$contenu .= '<h2 class="centre">Bonjour_<strong>' . $_SESSION['membre']['pseudo'] . '</strong></h2><br>';
$contenu .= '<div class="cadre"><h3> Voici vos informations </h3>';
$contenu .= '<p> Votre email est: ' . $_SESSION['membre']['email'] . '<br>';
$contenu .= 'Votre ville est: ' . $_SESSION['membre']['ville'] . '<br>';
$contenu .= 'Votre cp est: ' . $_SESSION['membre']['code_postal'] . '<br>';
$contenu .= 'Votre adresse est: ' . $_SESSION['membre']['adresse'] . '</p></div><br><br>';
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("inc/haut.inc.php");
echo $contenu;
require_once("inc/bas.inc.php");