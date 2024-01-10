<?php ob_start()?>
    <h1>Se connecter :</h1>
    <form action="" method="post">
        <label for="mail_utilisateur">Saisir le mail :</label>
        <input type="email" name="mail_utilisateur">
        <label for="password_utilisateur">Saisir le mot de passe :</label>
        <input type="password" name="password_utilisateur">
        <input type="submit" value="Connexion" name="submit">
    </form>
    <p><?=$error?></p>
<?php $content = ob_get_clean()?>
