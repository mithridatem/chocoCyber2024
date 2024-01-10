<?php
namespace App\Model;
use App\Utils\BddConnect;
use App\Model\Roles;
class Utilisateur extends BddConnect{
    //Attributs
    private ?int $id_utilisateur;
    private ?string $nom_utilisateur;
    private ?string $prenom_utilisateur;
    private ?string $mail_utilisateur;
    private ?string $password_utilisateur;
    private ?string $image_utilisateur;
    private ?bool $statut_utilisateur;
    private ?Roles $role;
    //Constructeur
    public function __construct(){
        $this->role = new Roles();
    }
    //Getters et Setters
    public function getId(): ?int {
        return $this->id_utilisateur;
    }
    public function setId(?int $id): void {
        $this->id_utilisateur = $id;
    }
    public function getNom(): ?string {
        return $this->nom_utilisateur;
    }
    public function setNom(?string $nom): void {
        $this->nom_utilisateur = $nom;
    }
    public function getPrenom(): ?string {
        return $this->prenom_utilisateur;
    }
    public function setPrenom(?string $prenom): void {
        $this->prenom_utilisateur = $prenom;
    }
    public function getMail(): ?string{
        return $this->mail_utilisateur;
    }
    public function setMail(?string $mail): void {
        $this->mail_utilisateur = $mail;
    }
    public function getPassword(): ?string {
        return $this->password_utilisateur;
    }
    public function setPassword(?string $password): void {
        $this->password_utilisateur = $password;
    }
    public function getImage(): ?string {
        return $this->image_utilisateur;
    }
    public function setImage(?string $image): void {
        $this->image_utilisateur = $image;
    }
    public function getStatut(): ?bool {
        return $this->statut_utilisateur;
    }
    public function setStatut(?bool $statut): void {
        $this->statut_utilisateur = $statut;
    }
    public function getRole(): ?Roles {
        return $this->role;
    }
    public function setRole(?Roles $role): void{
        $this->role = $role;
    }
    //Méthodes
    public function insertUtilisateur(): void {
        try {
            //Récupération des données
            $nom = $this->nom_utilisateur;
            $prenom = $this->prenom_utilisateur;
            $mail = $this->mail_utilisateur;
            $password = $this->password_utilisateur;
            $image = $this->image_utilisateur;
            $id_roles = $this->role->getId();
            //Requête SQL
            $requete = $this->connexion()->prepare('INSERT INTO utilisateur(
                nom_utilisateur,prenom_utilisateur,mail_utilisateur,password_utilisateur,image_utilisateur,id_roles
                ) VALUE(?,?,?,?,?,?)'
            );
            $requete->bindParam(1,$nom,\PDO::PARAM_STR);
            $requete->bindParam(2,$prenom,\PDO::PARAM_STR);
            $requete->bindParam(3,$mail,\PDO::PARAM_STR);
            $requete->bindParam(4,$password,\PDO::PARAM_STR);
            $requete->bindParam(5,$image,\PDO::PARAM_STR);
            $requete->bindParam(6,$id_roles,\PDO::PARAM_INT);
            $requete->execute();
        } 
        catch (\Exception $e) {
            die('Error : '.$e->getMessage());
        }
    }
    public function getUtilisateurByMail(): ?Utilisateur{
        try {
            $mail = $this->mail_utilisateur;
            $requete = $this->connexion()->prepare('SELECT id_utilisateur,nom_utilisateur,prenom_utilisateur
            ,mail_utilisateur,password_utilisateur,image_utilisateur FROM utilisateur
            WHERE mail_utilisateur = ?');
            $requete->bindParam(1,$mail, \PDO::PARAM_STR);
            $requete->execute();
            $requete->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, Utilisateur::class);
            return $requete->fetch();
        } 
        catch (\Exception $e) {
            die('Error : '.$e->getMessage());
        }
    }
    public function __toString(): string {
        return $this->nom_utilisateur;
    }
}
