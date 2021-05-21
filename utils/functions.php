<?php

declare(strict_types=1);

$schema = ["login" => ["username", "password"], "add" => ["titre", "texte"]];

/**
 * Fonction de validation du formulaire de login
 * @param  string $username
 * @param string $password
 * @return array
 */
function valider_login(string $username, string $password): array
{
    $erreurs = [];
    if (empty($username)) $erreurs["username"] = "Champs requis";
    if (empty($password)) $erreurs["password"] = "Champs requis";
    return $erreurs;
}

/**
 * Fonction de validation du formulaire d'ajout ou d'édition d'un article
 * @param  string $titre
 * @param string $password
 * @return array
 */
function valider_article_form(string $titre, string $texte): array
{
    $erreurs = [];
    if (empty($titre)) $erreurs["titre"] = "Champs requis";
    if (empty($texte)) $erreurs["texte"] = "Champs requis";
    return $erreurs;
}

/**
 * Helper pour htmlSpecialChars
 * @param  string $texte
 * @return string
 */
function html(string $texte): string
{
    return htmlspecialchars($texte, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
