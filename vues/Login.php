<?php
$username = $username ?? "";
$password = $password ?? "";
// reset complet du formulaire uniquement en cas d'erreur de username et/ou password
if (isset($erreurs["connexion"]))
    $username = $password = '';
?>

<form method="POST">
    <div class="form__title">
    <?= file_get_contents('assets/media/logo.svg'); ?>
        <h1>Bonjour,</h1>
    </div>
    <div class="form-group">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" id="username" value="<?= $username ?>" />
        <small class="form__error--field"><?= $erreurs['username'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" value="<?= $password ?>" />
        <small class="form__error--field"><?= $erreurs['password'] ?? '' ?></small>
    </div>
    <input type="submit" name="login" value="Login" />
    <input type="hidden" name="commande" value="ValidationLogin" />
    <?php
    if (isset($erreurs["connexion"])) :
    ?>
        <div class="form__error--global"><?= $erreurs["connexion"] ?></div>
    <?php
    endif;
    ?>
</form>