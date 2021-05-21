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
            <svg id="#logo" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" viewBox="0 0 512 512">
                <path d="M416.798 255.13l-95.416 3.267c-0.297 11.991-3.82 23.163-9.718 32.738 10.476 9.687 35.277 32.604 50.698 46.899l0.041-0.041c0.082 0.082 0.082 0.123 0.164 0.215 7.536 6.963 12.82 11.868 12.82 11.868 15.421 14.971 30.802 21.647 45.783 19.865 26.942-3.185 45.701-32.256 45.783-32.368 8.858-14.684 10.978-27.894 6.543-40.346-8.981-25.159-42.035-40.048-50.658-43.571-1.741 0.44-3.318 0.911-5.182 1.28l-0.86 0.195z" fill="#000000" />
                <path d="M153.047 369.234c-3.635 8.745-20.982 53.586-4.976 81.92 7.567 13.414 22.395 21.524 44.063 24.013 0.266 0 24.904 2.765 44.165-13.005 14.090-11.51 22.2-30.331 24.248-55.818l0.297 0.021c-1.239-3.901-1.833-6.574-1.935-7.096l-12.022-77.168 1.219-0.185c-12.175-1.495-23.337-6.308-32.573-13.538l-62.484 60.856z" fill="#000000" />
                <path d="M191.959 242.77c2.55-11.5 8.161-21.873 15.872-30.228l-70.195-54.763c-5.816-2.417-38.462-15.032-63.15-2.99-13.373 6.553-22.579 19.825-27.29 39.465l-0.154 0.492-0.164 0.542c-0.072 0.164-6.052 17.992 4.127 33.506 9.963 15.207 32.942 24.423 66.478 26.665l74.343-13.578 0.133 0.891z" fill="#000000" />
                <path d="M267.284 321.341c1.935 12.615 11.623 74.783 11.5 74.25 0.082 0.286 7.475 32.174 28.959 42.353 10.998 5.233 24.658 3.922 40.499-3.789 5.959-7.711 30.679-44.114-0.676-82.227l-49.039-45.363c-8.745 7.516-19.446 12.697-31.242 14.776z" fill="#000000" />
                <path d="M377.18 131.358c9.339-26.050 10.117-47.565 2.181-64.020-9.022-18.657-26.255-24.422-27.024-24.668-26.665-8.571-47.821-7.967-62.781 1.802-19.118 12.441-23.019 36.731-23.47 40.059v107.674c11.694 1.833 22.395 6.727 31.212 13.906l79.882-74.752z" fill="#000000" />
                <path d="M255.98 211.579c-25.017 0-45.322 20.327-45.322 45.291 0 24.955 20.296 45.24 45.322 45.24 24.924 0 45.21-20.286 45.21-45.24-0.010-24.965-20.286-45.291-45.209-45.291z" fill="#000000" />
                <path d="M245.801 129.762l-0.266 0.071c-17.674-53.904-38.584-72.233-52.992-78.080-14.643-5.97-25.631-0.42-26.050-0.225-12.012 6.594-18.617 15.248-20.132 26.481-4.864 35.983 42.343 90.358 60.979 108.268v0 0 0l-0.102 0.082 16.875 13.25c6.636-3.696 13.936-6.206 21.678-7.404 0.010-13.456 0.010-39.23 0.010-62.444z" fill="#000000" />
                <path d="M414.198 234.946c26.419-5.673 43.981-15.841 50.862-29.43 7.383-14.674 0.584-29.778 0.543-29.86l-0.461-0.901-0.215-0.983c-2.14-8.428-6.738-14.613-13.978-18.913-21.637-12.728-58.419-4.997-65.741-3.287l-74.343 69.602c3.338 5.222 6.062 10.947 7.844 17.019l95.488-3.246z" fill="#000000" />
                <path d="M266.005 84.91c0 0 0.021-0.144 0.082-0.379v-0.624l-0.082 1.004z" fill="#000000" />
                <path d="M379.003 129.649l-1.822 1.71c-0.276 0.686-0.461 1.403-0.697 2.13l2.519-3.84z" fill="#000000" />
                <path d="M484.557 168.786c-0.185-0.604-0.44-1.116-0.625-1.72l-0.082-0.133 0.707 1.853z" fill="#000000" />
                <path d="M415.222 234.926l-1.024 0.020c-0.215 0.051-0.481 0.133-0.697 0.185l1.721-0.205z" fill="#000000" />
                <path d="M420.741 252.846v0 0z" fill="#000000" />
                <path d="M350.024 433.285c-0.604 0.317-1.178 0.563-1.782 0.87-0.625 0.768-1.096 1.351-1.239 1.515l3.021-2.386z" fill="#000000" />
                <path d="M362.363 338.043c0.041 0.062 0.123 0.113 0.205 0.185-0.082-0.103-0.082-0.144-0.164-0.215l-0.041 0.031z" fill="#000000" />
                <path d="M151.593 370.658l1.454-1.433c0.399-0.942 0.696-1.577 0.696-1.618l-2.15 3.051z" fill="#000000" />
                <path d="M136.581 156.979l1.044 0.798c0.553 0.236 0.973 0.399 0.983 0.42l-2.028-1.219z" fill="#000000" />
                <path d="M27.771 188.436c0 0-0.041 0.164-0.102 0.286-0.041 0.256-0.143 0.502-0.226 0.778l0.328-1.065z" fill="#000000" />
                <path d="M207.35 186.266v0 0z" fill="#000000" />
                <path d="M113.725 269.517c-5.356 2.161-32.645 14.080-42.312 36.311-5.017 11.428-4.751 23.89 0.85 36.997 0.338 0.748 17.992 34.345 78.684 9.605l1.147-0.471 0.952-0.829c1.607-1.444 39.618-35.584 45.936-71.536l0.932-5.325-4.823-2.437c-22.559-11.305-73.994-3.676-79.78-2.765l-0.819 0.133-0.768 0.317zM184.658 277.104c-5.427 30.935-40.919 62.863-41.287 63.171l2.099-1.29c-47.104 19.18-59.618-1.567-60.13-2.447-3.697-8.786-4.004-17.132-0.584-24.873 7.557-17.438 31.683-27.556 34.396-28.651l-1.577 0.44c14.459-2.274 55.388-6.43 70.994 1.392l-3.911-7.741z" fill="#000000" />
                <path d="M115.497 276.45l0.953-0.195c0.348-0.144 0.645-0.215 0.645-0.215l-1.597 0.409z" fill="#000000" />
                <path d="M145.081 348.723l4.885-3.697c-0.645 0.236-1.167 0.42-1.751 0.676l-3.133 3.021z" fill="#000000" />
            </svg>
            <span>Blog Me Doo</span>
        </a>
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