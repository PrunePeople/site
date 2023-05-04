<?php require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if (isset($_GET['action']) && $_GET['action'] == "deconnexion") { 
    /*
    Si l'internaute clic sur le lien deconnexion, nous arriverons sur la page
    connexion.php avec l'information suivante dans l'url ?action=deconnexion. C'est la raison pour laquelle nous utilisons la superglobale $_GET afin de
    detecter cette action et de déconnecter l'internaute via session_destroy();.
    */
    session_destroy();
}
// si l'internaute est déjà connecté mais qu'il tente d'aller sur la page de
// connexion (volontairement ou involontairement), nous le renverrons automatiquement dans son espace de profil
if (internauteEstConnecte()) {
    header("location:profil.php");
}
if ($_POST) { // permet de detecter si l'internaute à cliqué sur le bouton submit pour se connecter.
    // $contenu .= "pseudo : " . $_POST['pseudo'] . "<br>mdp : " . $_POST['mdp'] . "";
    $résultat = executeRequete("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'"); // Nous allons utiliser notre fonction executeRequete pour allez consulter la base afin de savoir si le pseudo avec lequel l'internaute tente de se connecter correspond bien à 1 compte réel sur notre site web.
    if ($résultat->num_rows != 0) { // Si le nombre de retours est différent de 0 (donc 1 logiquement :p), c'est que le pseudo est connu et que le compte existe, on peut avancer...
        // $contenu .= '<div style="background:green">pseudo connu!</div>';
        $membre = $résultat->fetch_assoc(); // Revenons sur le cas du pseudo valide, nous devons absolument traiter (fetch_assoc) pour connaitre les informations récupérées en base. En effet, nous devons savoir si le membre a le bon pseudo mais aussi s'il possède le bon mot de passe associé.
        if ($membre['mdp'] == $_POST['mdp']) { // On compare le mdp posté (dans le formulaire de connexion) avec le mdp du membre (récupéré dans la base de données), s'il s'agit du même mdp dans les deux cas, on crée à l'internaute une session et on la remplit avec certaines informations (c'est ce qui permet réellement de connecter et de maintenir connecté quelqu'un sur 1 site web).
            //$contenu .= '<div class="validation">mdp connu!</div>';
            foreach ($membre as $indice => $element) {
                if ($indice != 'mdp') {
                    $_SESSION['membre'][$indice] = $element;
                }
            }
            header("location:profil.php"); // Si l'accouplement pseudo/mot de passe est bon, nous redirigeons l'internaute vers sa page de profil (puisqu'il est maintenant connecté !)
        } else { // Sinon, le mdp est mauvais et nous informons l'internaute. 
            $contenu .= '<div class="erreur">Erreur de MDP</div>';
        }
    } else { // Sinon, nous informons l'internaute qu'il y a une erreur sur son pseudo...
        $contenu .= '<div class="erreur">Erreur de pseudo</div>';
    }
}

//--------------------------------- AFFICHAGE HTML ---------------------------------//
?>
<?php require_once("inc/haut.inc.php"); ?>
<?php echo $contenu; ?>
<form method="post" action="">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo"><br> <br>
    <label for="mdp">Mot de passe</label><br>
    <input type="text" id="mdp" name="mdp"><br><br>
    <input type="submit" value="Se connecter">
</form>
<?php require_once("inc/bas.inc.php"); ?>