<?php
require_once("../inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- VERIFICATION ADMIN ---//
if (!internauteEstConnecteEtEstAdmin()) {
    header("location:../connexion.php");
    exit();
} //--- ENREGISTREMENT PRODUIT ---//
if (!empty($_POST)) { // debug($_POST);
    $photo_bdd = "";
    if (!empty($_FILES['photo']['name'])) { // debug($_FILES);
        $nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name'];
        $photo_bdd = RACINE_SITE . "photo/$nom_photo";
        $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . "/photo/$nom_photo";
        copy($_FILES['photo']['tmp_name'], $photo_dossier);
    }
    foreach ($_POST as $indice => $valeur) {
        $_POST[$indice] = htmlEntities(addSlashes($valeur));
    }
    executeRequete("INSERT INTO produit (id_produit, reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) values ('',
'$_POST[reference]', '$_POST[categorie]', '$_POST[titre]', '$_POST[description]', '$_POST[couleur]', '$_POST[taille]', '$_POST[public]', '$photo_bdd',
'$_POST[prix]', '$_POST[stock]')");
    $contenu .= '<div class="validation">Le produit a été ajouté</div>';
} //--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut.inc.php");
echo $contenu;
?>
<form method="post" enctype="multipart/form-data" action="">
<h2> Formulaire Produits </h2><br>
    <label for="reference">Référence</label><br>
    <input type="text" id="reference" name="reference" placeholder="La référence de produit"> <br><br>
    <label for="categorie">Categorie</label><br>
    <input type="text" id="categorie" name="categorie" placeholder="La catégorie de produit"><br><br>
    <label for="titre">Titre</label><br>
    <input type="text" id="titre" name="titre" placeholder="Le titre du produit"> <br><br>
    <label for="description">Description</label><br>
    <textarea name="description" id="description" placeholder="La description du produit"></textarea><br><br>
    <label for="couleur">Couleur</label><br>
    <input type="text" id="couleur" name="couleur" placeholder="La couleur du produit"> <br><br>
    <label for="taille">Taille</label><br>
    <select name="taille">
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
    </select><br><br>
    <label for="public">Public</label><br>
    <input type="radio" name="public" value="m" checked>Homme
    <input type="radio" name="public" value="f">Femme<br><br>
    <label for="photo">Photo</label><br>
    <input type="file" id="photo" name="photo"><br><br>
    <label for="prix">Prix</label><br>
    <input type="text" id="prix" name="prix" placeholder="Le prix du produit"><br><br>
    <label for="stock">Stock</label><br>
    <input type="text" id="stock" name="stock" placeholder="Le stock du produit"><br><br>
    <input type="submit" value="Enregistrement du produit">
</form>
<?php require_once("../inc/bas.inc.php"); ?>