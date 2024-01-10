<?php
namespace App\Model;
use App\Utils\BddConnect;
class Roles extends BddConnect{
    //Attributs
    private ?int $id_roles;
    private ?string $nom_roles;
    //Getters et Setters
    public function getId(): ?int {
        return $this->id_roles;
    }
    public function setId(?int $id): void {
        $this->id_roles = $id;
    }
    public function getNom(): ?string {
        return $this->nom_roles;
    }
    public function setNom(?string $nom): void {
        $this->nom_roles = $nom;
    }
}