<!-- On utilise le même formulaire pour l'ajout et l'édition d'un article -->

<?php
// si IdArticle existe --> edit mode, sinon ajout mode
if (isset($idArticle)) {
    $idArticle = $article['idArticle'] ?? $_GET["idArticle"];
    $titre = $article['titre'] ?? $_GET["titre"];
    $texte = $article['texte'] ?? $_GET["texte"];
} else {
    $titre = $_GET["titre"] ?? "";
    $texte = $_GET["texte"] ?? "";
}
?>

<form class="ajouterArticle" method="GET">
    <div class="form__title">
        <h1><?= isset($idArticle) ? 'Éditer un article' : 'Ajouter un article' ?></h1>
    </div>
    <div class="form-group">
        <label for="titre">Titre:</label>
        <input type="text" name="titre" id="titre" value="<?= html($titre) ?>" />
        <small class="form__error--field"><?= $erreurs['titre'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label for="texte">Texte:</label>
        <textarea name="texte" id="texte" cols="30" rows="10"><?= html($texte) ?></textarea>
        <small class="form__error--field"><?= $erreurs['texte'] ?? '' ?></small>
    </div>

    <input type="hidden" name="auteur" value="<?= $_SESSION["username"] ?>" />
    <!-- idArticle est passé en champ caché, disponible sur $_SESSION puis passé en arg de editer_article -->
    <input type="hidden" name="idArticle" value="<?= $idArticle ?? null ?>" />
    <input type="submit" name="<?= isset($idArticle) ? "Éditer" : "Ajouter" ?>" value="<?= isset($idArticle) ? "Éditer" : "Ajouter" ?>" />
    <!-- la bonne commande - edit ou ajout - est passée dynamiquement au controleur -->
    <input type="hidden" name="commande" value="<?= isset($idArticle) ? "ValidationEditArticle" : "ValidationAjoutArticle" ?>" />
</form>