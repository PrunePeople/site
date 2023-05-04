<?php
function executeRequete($req)
{ // La fonction sera destinée à recevoir 1 argument entrant (la requête SQL arrivera dans la variable de reception $req prévue à cet effet).
  global $mysqli; // permet d'avoir accès à la variable $mysqli définie dans le fichier init.inc.php (espace global) à l'intérieur de notre fonction (espace local).
  $résultat = $mysqli->query($req); // on exécute la requête reçue en argument et on gardera les résultats dans la variable $résultat.
  if (!$résultat) { // si la variable $résultat renvoie false, c'est qu'il y a une erreur de requête SQL
    die("Erreur sur la requete sql.<br>Message : " . $mysqli->error . "<br>Code: " . $req); // Dans le cas où la requête échoue, on lui demande d'adresser 1 message et d'arreter l'exécution du code avec l'utilisation de die.
  }
  return $résultat; // en cas d'une requête de SELECTion, on retournera un objet issu de la classe mysqli_result. Sinon (pour INSERT/UPDATE/DELETE), nous retournerons un boolean TRUE (1).
}

function debug($var, $mode = 1)
{ // La fonction sera destinée à recevoir 1 ou 2 argument(s) entrant(s). En premier ce sera la variable/array/object à explorer et en second ce sera 1 mode d'affichage.
  echo '<div style="background: orange; padding: 5px; float: right; clear: both;">';
  $trace = debug_backtrace()[0]; // Fonction prédéfinie retournant un tableau Array contenant des informations tel que la ligne et le fichier où est exécuté la fonction.
  echo "Debug demandé dans le fichier : {$trace['file']} à la ligne {$trace['line']}."; // Au moment de l'affichage, cela permettra de savoir de quel fichier vient la demande de debug
  if ($mode === 1) { // Si le mode 1 est précisé en argument (ou qu'il n'y a pas d'informations contraires), nous ferons un print_r
    echo '<pre>';
    print_r($var);
    echo '</pre>';
  } else {
    echo '<pre>';
    var_dump($var);
    echo '</pre>'; // Sinon, nous ferons un var_dump
  }
  echo '</div>';
}
// ------------------------------------
function internauteEstConnecte() // permet de savoir si l'internaute est connecté par une simple condition :
{
  if (!isset($_SESSION['membre'])) // si la session membre n'existe pas, c'est que l'internaute n'est pas passé par la page de connexion (ou alors qu'il a été déconnecté depuis). on retournera la valeur "FALSE" pour dire "Faux l'internaute n'est pas connecté".
    return false;
  else // sinon, c'est que la session membre existe et donc que l'internaute est connecté
    return true;
} //------------------------------------
function internauteEstConnecteEtEstAdmin() // permettre de savoir si l'internaute est connecté en tant qu'administrateur (statut a 1) ou en tant que membre (statut a 0)
{
  if (internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) // si la fonction internauteEstConnecte() renvoie "TRUE", l'internaute est connecté (avec 1 fichier de session + cookie), on vérifie donc si son statut est a 1. Si oui, nous renverrons TRUE pour dire "Vrai, cet internaute est connecté et est admin".
    return true;
  else // sinon, c'est soit que l'internaute n'est pas connecté ou soit que l'internaute est connecté mais sans avoir les droits d'administration, nous renverrons donc "FALSE" pour dire "Faux cet internaute n'est pas administrateur".
    return false;
}