<?php
namespace App\Controller;
use App\Model\Utilisateur;
use App\Utils\Utilitaire;
use App\Vue\Template;
class UtilisateurController extends Utilisateur{
    //Méthodes
    public function addUtilisateur(): void{
        $error = "";
        //tester si le bouton est cliqué
        if(isset($_POST["submit"])){
            //tester si les champs sont remplis
            if(!empty($_POST["nom_utilisateur"])AND !empty($_POST["prenom_utilisateur"]) AND
            !empty($_POST["mail_utilisateur"]) AND !empty($_POST["password_utilisateur"]) AND
            !empty($_POST["confirm_password"])){
                //tester si les 2 mots de passe correspondent
                if($_POST["password_utilisateur"]==$_POST["confirm_password"]){
                    $mail = Utilitaire::cleanInput($_POST["mail_utilisateur"]);
                    $this->setMail($mail);
                    //test si le compte n'existe pas
                    if(!$this->getUtilisateurByMail()){
                        //Hasher le mot de passe
                        $hash = password_hash(Utilitaire::cleanInput($_POST["password_utilisateur"]),PASSWORD_DEFAULT);
                        //Nettoyer les entrées du fomulaire
                        $nom = Utilitaire::cleanInput($_POST["nom_utilisateur"]);
                        $prenom = Utilitaire::cleanInput($_POST["prenom_utilisateur"]);
                        $image = './public/asset/images/defaut.png';
                        //test si l'utilisateur à importé un fichier
                        if(!empty($_FILES["image_utilisateur"]["tmp_name"])){
                            //récupére l'extension du fichier
                            $ext = Utilitaire::getFileExtension($_FILES["image_utilisateur"]["name"]);
                            //renommer le fichier
                            $name_image = uniqid().".".$ext;
                            //remplace la variable image
                            $image = "./Public/asset/images/".$name_image;
                            //déplacer le fichier
                            move_uploaded_file($_FILES["image_utilisateur"]["tmp_name"],
                            $image);
                        }
                        //setter les valeurs dans l'objet Utilisateur
                        $this->setNom($nom);
                        $this->setPrenom($prenom);
                        $this->setPassword($hash);
                        $this->setImage($image);
                        $this->getRole()->setId(1);
                        //ajouter en bdd
                        $this->insertUtilisateur();
                        $error = "Le compte a été ajouté en BDD";
                    }
                    //test le compte existe
                    else {
                        $error = "Les informations d'inscription sont incorrectes";
                    }
                }
                //cas les mots de passe sont différents
                else{
                    $error = "Les mots de passe sont différents";
                }
            }
            //test si les champs ne sont pas remplis
            else{
                $error = "Veuillez remplir tous les champs du formulaire";
            }
        }
        Template::render('navbar.php', 'Inscription', 'vueAddUser.php', 'footer.php', 
        $error, [], ['main.css']);
    }
    public function connexionUtilisateur(): void {
        $error = "";
        //test si le bouton est cliqué
        if(isset($_POST["submit"])){
            //test si les champs sont bien remplis
            if(!empty($_POST["mail_utilisateur"])AND !empty($_POST["password_utilisateur"])){
                
                $mail = Utilitaire::cleanInput($_POST["mail_utilisateur"]);
                $this->setMail($mail);
                //récupérer le compte utilisateur ou false
                $recup = $this->getUtilisateurByMail();
                //test si le compte existe
                if($recup){
                    //mot de passe BDD
                    $hash = $recup->getPassword();
                    //password formulaire
                    $password = Utilitaire::cleanInput($_POST["password_utilisateur"]);
                    //test si le mot de passe est valide
                    if(password_verify($password, $hash)){
                        //créer une session
                        $_SESSION["connected"] = true;
                        $_SESSION["nom"] = $recup->getNom();
                        $_SESSION["prenom"] = $recup->getPrenom();
                        $_SESSION["image"] = $recup->getImage();
                        $_SESSION["id"] = $recup->getId();
                        $error = "Connecté";
                    }
                    //test si le password est invalide
                    else {
                        $error = "Les informations de connexion sont invalides";
                    }
                }
                //test si le compte n'existe pas
                else{
                    $error = "Les informations de connexion sont invalides";
                }
            }
            else{
                $error = "Veuillez remplir tous les champs du formulaire";
            }
        }
        Template::render('navbar.php', 'Connexion', 'vueConnexion.php', 'footer.php', 
        $error, [], ['main.css']);
    }
}
