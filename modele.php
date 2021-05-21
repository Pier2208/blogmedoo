<?php

declare(strict_types=1);

define("SERVER", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DBNAME", "blog");

$connexion = connectDB();

function connectDB()
{
    $connexion = mysqli_connect(SERVER, USERNAME, PASSWORD, DBNAME);
    if (!$connexion)
        trigger_error("Erreur de connexion : " . mysqli_connect_error());

    //s'assurer que la connection traite du UTF8
    mysqli_query($connexion, "SET NAMES 'utf8'");

    return $connexion;
}

/**
 * fonction qui récupère tous les articles de blog
 * @return array un array possiblement vide ou d'articles
 */
function obtenir_articles(): array
{
    global $connexion;

    $resultats = [];

    $req = "SELECT id, titre, texte, username AS auteur
            FROM articles 
            JOIN usagers ON articles.idAuteur = usagers.username 
            ORDER BY articles.id DESC";

    $resultSet = mysqli_query($connexion, $req);

    if ($resultSet) {
        while ($rangee = mysqli_fetch_assoc($resultSet)) {
            array_push($resultats, $rangee);
        }
    }
    return $resultats;
}

/**
 * Fonction qui récupère un article de blog par id
 * @param  int $id
 * @return array un array vide ou un array contant UN SEUL article
 */
function obtenir_article_par_id(int $id): array
{
    global $connexion;

    $article = [];

    $req = mysqli_prepare($connexion, "SELECT * FROM articles WHERE id=?");
    if ($req) {
        mysqli_stmt_bind_param($req, 'i', $id);
        mysqli_stmt_execute($req);
        $resultSet = mysqli_stmt_get_result($req);

        if (mysqli_num_rows($resultSet) > 0) {
            $article = mysqli_fetch_assoc($resultSet);
        }
    }
    return $article;
}

/**
 * fonction qui recherche un article par mot-clé
 * @param string $recherche
 * @return array
 */
function rechercher_articles(string $recherche): array
{
    global $connexion;

    $articles = [];

    $recherche = "%$recherche%";
    $req = "SELECT id, titre, texte, username AS auteur
            FROM articles 
            JOIN usagers ON articles.idAuteur = usagers.username
            WHERE articles.titre LIKE ? OR articles.texte LIKE ?
            ORDER BY articles.titre";

    $req = mysqli_prepare($connexion, $req);
    mysqli_stmt_bind_param($req, 'ss', $recherche, $recherche);
    mysqli_stmt_execute($req);
    $resultSet = mysqli_stmt_get_result($req);

    if (mysqli_num_rows($resultSet) > 0) {
        while ($rangee = mysqli_fetch_assoc($resultSet)) {
            array_push($articles, $rangee);
        }
    }
    return $articles;
}

/**
 * Fonction qui met à jour un article de blog par id
 * @param  string $titre
 * @param  string $texte
 * @param  int $id
 * @return bool | null
 */
function editer_article(string $titre, string $texte, int $id): ?bool
{
    global $connexion;

    $req = mysqli_prepare($connexion, "UPDATE articles SET titre=?, texte=? WHERE id=?");
    if ($req) {
        mysqli_stmt_bind_param($req, 'ssi', $titre, $texte, $id);
        mysqli_stmt_execute($req);
        return mysqli_affected_rows($connexion) > 0 ? true : null;
        // ATTENTION: si l'update ne contient aucun changement, aucune rangée ne sera affectée, on retourne null plutôt que false
    }
}

/**
 * fonction qui ajoute un nouvel article de blog
 * @param  string $titre
 * @param  string $texte
 * @param  string $auteur
 * @return bool
 */
function ajouter_article(string $titre, string $texte, string $auteur): bool
{
    global $connexion;

    $req = mysqli_prepare($connexion, "INSERT INTO articles(titre, texte, idAuteur ) VALUES (?, ?, ?)");
    if ($req) {
        mysqli_stmt_bind_param($req, 'sss', $titre, $texte, $auteur);
        mysqli_stmt_execute($req);
        return mysqli_affected_rows($connexion) > 0 ? true : false;
    }
}

/**
 * fonction qui supprime un article de blog par id
 * @param  int $id
 * @return bool
 */
function supprimer_article(int $id): bool
{
    global $connexion;

    $req = mysqli_prepare($connexion, "DELETE FROM articles WHERE articles.id=?");
    if ($req) {
        mysqli_stmt_bind_param($req, 'i', $id);
        mysqli_stmt_execute($req);
        return mysqli_affected_rows($connexion) > 0 ? true : false;
    }
}

/**
 * fonction qui authentifie un utilisateur
 * @param  string $username
 * @param  string $password
 * @return bool
 */
function login(string $username, string $password): bool
{
    global $connexion;

    $req = mysqli_prepare($connexion, "SELECT password FROM usagers WHERE username=?");
    if ($req) {
        mysqli_stmt_bind_param($req, 's', $username);
        mysqli_stmt_execute($req);
        $resultSet = mysqli_stmt_get_result($req);

        if (mysqli_num_rows($resultSet) > 0) {
            $rangee = mysqli_fetch_assoc($resultSet);
            $hash = $rangee["password"];
            return password_verify($password, $hash);
        } else {
            return false;
        }
    }
}

/**
 * fonction qui déconnecte un utilisateur de sa session
 * @return bool
 */
function logout(): bool
{
    $_SESSION = array();
    print_r($_SESSION);

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    return session_destroy();
}
