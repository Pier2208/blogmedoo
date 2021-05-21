<?php

session_start();

if (isset($_REQUEST['commande'])) {
    $commande = $_REQUEST['commande'];
} else {
    $commande = 'Articles';
}

require_once('modele.php');
require_once('utils/functions.php');

switch ($commande) {
        // la page présentant tous les articles du blog
    case 'Articles':
        $articles = obtenir_articles();
        $meta['titre'] = "Tous les articles";
        $meta['description'] = "Retrouvez tous les articles de nos bloggeurs.";

        require_once("vues/Entete.php");
        require_once("vues/Articles.php");
        require_once("vues/PiedDePage.php");
        break;

    case 'RechercherArticle':
        // si la recherche est vide, pas de requête à la BD
        if (isset($_REQUEST["recherche"]) && empty($_REQUEST["recherche"])) {
            header("Location: index.php?commande=Articles");
        } else {
            // récupération du terme de la recherche
            $articles = rechercher_articles($_REQUEST["recherche"]);
            $meta['titre'] = "Résultats de recherche";

            require_once("vues/Entete.php");
            require_once("vues/Articles.php");
            require_once("vues/PiedDePage.php");
            break;
        }


        //la page de formulaire d'ajout d'un article
    case 'AjouterArticle':
        // un user non auth est redirigé
        if (!isset($_SESSION["username"]))
            header("Location: index.php?commande=Articles");

        $meta['titre'] = "Publier un article";
        require_once("vues/Entete.php");
        require_once("vues/AjouterArticle.php");
        require_once("vues/PiedDePage.php");
        break;

        // fonction de validation et d'ajout d'un nouvel article
    case "ValidationAjoutArticle":
        // récupération des données du nouvel article en train d'être créé
        if (isset($_REQUEST["titre"], $_REQUEST["texte"])) {
            $titre = trim($_REQUEST["titre"]);
            $texte = trim($_REQUEST["texte"]);

            // validation
            $erreurs = valider_article_form($titre, $texte);
            if ($erreurs) {
                require_once("vues/Entete.php");
                require_once("vues/AjouterArticle.php");
                require_once("vues/PiedDePage.php");
                return;
            }

            // ajout du nouvel article dans la BD
            $isValid = ajouter_article($titre, $texte, $_SESSION["username"]);
            if ($isValid)
                header("Location: index.php?commande=Articles");
            // else erreur insertion failed
        }
        break;

        // la page de formulaire d'édition d'un article
    case 'EditerArticle':
        // un user non auth est redirigé
        if (!isset($_SESSION["username"]))
            header("Location: index.php?commande=Articles");

        if (isset($_REQUEST["idArticle"])) {
            $idArticle = (int) trim($_REQUEST["idArticle"]);

            // un user ne peut éditer que ses propres articles
            $article = obtenir_article_par_Id(($idArticle));
            if ($article && $article["idAuteur"] === $_SESSION["username"]) {
                $meta['titre'] = "Editer un article";
                require_once("vues/Entete.php");
                require_once("vues/AjouterArticle.php");
                require_once("vues/PiedDePage.php");
            } else {
                // si idArticle qui n'existe pas passé dans la query string ou si currentUser n'est pas l'auteur de l'article
                header("Location: index.php?commande=Articles");
            }
        }
        break;

        // fonction d'édition d'un article existant
    case "ValidationEditArticle":
        // récupération des données de l'article en train d'être édité
        if (isset($_REQUEST["titre"], $_REQUEST["texte"], $_REQUEST["idArticle"])) {
            $titre = trim($_REQUEST["titre"]);
            $texte = trim($_REQUEST["texte"]);
            $idArticle = (int) trim($_REQUEST["idArticle"]);

            // validation des données
            $erreurs = valider_article_form($titre, $texte);
            if ($erreurs) {
                require_once("vues/Entete.php");
                require_once("vues/AjouterArticle.php");
                require_once("vues/PiedDePage.php");
                return;
            }
            // mise à jour de l'article dans la BD
            $isValid = editer_article($titre, $texte, $idArticle);
            if ($isValid || is_null($isValid)) {
                header("Location: index.php?commande=Articles");
            }
        }
        break;

        // la fonction de suppression d'un article existant
    case "SupprimerArticle":
        if (isset($_REQUEST["idArticle"]) && !empty($_REQUEST["idArticle"])) {
            $idArticle = (int) trim($_REQUEST["idArticle"]);
            $article = obtenir_article_par_id($idArticle);

            // un user ne peut supprimer que ses propres articles
            if ($article["idAuteur"] === $_SESSION["username"])
                supprimer_article($idArticle);
        }
        header("Location: index.php?commande=Articles");
        break;


        // la page présentant le formulaire de login
    case 'Login':
        // empêcher un retour sur la page login si user est authentifié
        if (isset($_SESSION["username"]))
            header("Location: index.php?commande=Articles");
        else {
            $meta['titre'] = "Se connecter";
            $meta['description'] = "Connecte-toi et deviens bloggeur sur Blog Me Doo!";
            require_once("vues/Entete.php");
            require_once("vues/Login.php");
        }
        break;


        // la fonction de validation et de login d'un utilisateur
    case 'ValidationLogin':
        // recupération user input
        if (isset($_REQUEST["username"], $_REQUEST["password"])) {
            $username = trim($_REQUEST["username"]);
            $password = trim($_REQUEST["password"]);

            // validation user input
            $erreurs = valider_login($username, $password);
            if ($erreurs) {
                require_once("vues/Entete.php");
                require_once("vues/Login.php");
                require_once("vues/PiedDePage.php");
                return;
            }

            // vérification des credentials et mise en session du username
            $isValid = login($username, $password);
            if ($isValid) {
                $_SESSION["username"] = $username;
                header("Location: index.php?commande=Articles");
            } else {
                $erreurs['connexion'] = "Mauvaise combinaison nom d'utilisateur/mot de passe";
                require_once("vues/Entete.php");
                require_once("vues/Login.php");
                require_once("vues/PiedDePage.php");
            }
        }
        break;

        // la fonction de logout
    case "Logout":
        if (logout())
            header("Location: index.php?commande=Articles");
        break;
}
