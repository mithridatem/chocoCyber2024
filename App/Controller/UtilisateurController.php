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
                    //Hasher le mot de passe
                    $hash = password_hash(Utilitaire::cleanInput($_POST["password_utilisateur"]),PASSWORD_DEFAULT);
                    //Nettoyer les entrées du fomulaire
                    $nom = Utilitaire::cleanInput($_POST["nom_utilisateur"]);
                    $prenom = Utilitaire::cleanInput($_POST["prenom_utilisateur"]);
                    $mail = Utilitaire::cleanInput($_POST["mail_utilisateur"]);
                    $image = './public/asset/images/defaut.png';
                    //setter les valeurs dans l'objet Utilisateur
                    $this->setNom($nom);
                    $this->setPrenom($prenom);
                    $this->setMail($mail);
                    $this->setPassword($hash);
                    $this->setImage($image);
                    $this->getRole()->setId(1);
                    $recup = $this->getUtilisateurByMail();
                    dd($recup);
                    //ajouter en bdd
                    $this->insertUtilisateur();
                    //afficher un message
                    $error = "Le compte a bien été ajouté en BDD";
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
}
