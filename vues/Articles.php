<h1><?= $commande === 'Articles' ? 'Liste des articles' : 'Résultats de recherche ('. count($articles) .')' ?></h1>
<section class="articles">
    <?php
    if (count($articles) === 0) :
    ?>
        <h2 class="articlesNotFound"><i>Aucun article trouvé <?= 'pour ' . $_REQUEST["recherche"] ?? '' ?>!</i></h2>
        <?php
    else :
        foreach ($articles as $article) :
        ?>
            <div class="article">
                <h2 class="article__titre"><?= html($article["titre"]) ?></h2>
                <p class="article__texte"><?= html($article["texte"]) ?></p>
                <div class="article__auteur">
                    <span><i>Par <?= html($article["auteur"]) ?></i></span>
                    <?php
                    if (isset($_SESSION["username"]) && $_SESSION["username"] === $article["auteur"]) :
                    ?>
                        <div class="article__actions">
                            <a href="index.php?commande=EditerArticle&idArticle=<?= html($article["id"]) ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?commande=SupprimerArticle&idArticle=<?= html($article["id"]) ?>">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
    <?php
        endforeach;
    endif;
    ?>
</section>