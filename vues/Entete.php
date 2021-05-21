<html>

<head>
    <meta charset='utf-8'>
    <meta name="description" content="<?= isset($meta["description"]) ? $meta["description"] : 'Blog Me Doo' ?>">
    <link href="assets/css/main.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <title><?= isset($meta["titre"]) ? $meta["titre"] . ' - Blog Me Doo' : 'Blog Me Doo' ?></title>
</head>

<body>

    <header class="navbar">
        <a class="navbar__logo" href="index.php">
            <?= file_get_contents('assets/media/logo.svg'); ?>
            <span>Blog Me Doo</span>
        </a>
        <small class="navbar__connectedAs"><?= isset($_SESSION["username"]) ? '(connecté en tant que ' . $_SESSION["username"] . ')' : '' ?></small>
        <?php
        if ($commande === 'Articles' || $commande === 'RechercherArticle') :
        ?>
            <form class="rechercherArticle" method="GET">
                <input type="text" name="recherche" placeholder="ex. ma recherche" value="<?= $_REQUEST["recherche"] ?? '' ?>" />
                <input type="hidden" name="commande" value="RechercherArticle" />
                <button type="submit" name="rechercher" class="rechercherBtn" value="Rechercher"><i class="fas fa-search"></i></button>
            </form>
        <?php
        endif;
        ?>
        <nav>
            <ul class="navbar__menu">
                <?php
                if (!isset($_SESSION["username"])) :
                ?>
                    <li>
                        <i class="fas fa-sign-in-alt"></i>
                        <a href="index.php?commande=Login">Se connecter</a>
                    </li>
                <?php
                else :
                ?>
                    <li>
                        <i class="fas fa-edit"></i>
                        <a href="index.php?commande=AjouterArticle">Ajouter un article</a>
                    </li>
                    <li>
                        <i class="fas fa-sign-out-alt"></i>
                        <a href="index.php?commande=Logout">Se déconnecter</a>
                    </li>
                <?php
                endif;
                ?>
            </ul>
        </nav>
    </header>
    <main class="container">