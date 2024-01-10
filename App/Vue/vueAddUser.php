<?php ob_start()?>
    <h1>Ajouter un compte utilisateur :</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nom_utilisateur">Saisir le nom :</label>
        <input type="text" name="nom_utilisateur">
        <label for="prenom_utilisateur">Saisir le prénom :</label>
        <input type="text" name="prenom_utilisateur">
        <label for="mail_utilisateur">Saisir le mail :</label>
        <input type="email" name="mail_utilisateur">
        <label for="password_utilisateur">Saisir le mot de passe :</label>
        <input type="password" name="password_utilisateur">
        <label for="confirm_password">Confirmer le mot de passe :</label>
        <input type="password" name="confirm_password">
        <label for="image_utilisateur">Ajouter une image de profil</label>
        <input type="file" name="image_utilisateur">
        <input type="submit" value="S'inscrire" name="submit">
    </form>
    <p><?=$error?></p>
<?php $content = ob_get_clean()?>
