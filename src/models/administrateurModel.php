<?php

class administrateurModel{
    private $matricule, $nomsession, $nomutilisateur, $motdepasse, $role;
    
    public function setMatri($matricule){
        $this->matricule = $matricule;
    }

    public function getMatri(){
        return $this->matricule;
    }

    public function setNomsession($nomsession){
        $this->nomsession = $nomsession;
    }

    public function getNomsession(){
        return $this->nomsession;
    }

    public function setNomutilisateur($nomutilisateur){
        $this->nomutilisateur = $nomutilisateur;
    }

    public function getNomutilisateur(){
        return $this->nomutilisateur;
    }

    public function setPassword($motdepasse){
        $this->motdepasse = $motdepasse;
    }

    public function getPassword(){
        return $this->motdepasse;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function getRole(){
        return $this->role;
    }
}