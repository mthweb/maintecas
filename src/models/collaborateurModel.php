<?php

class collaborateurModel{
    private $idcollabo, $nomcollabo, $prenomcollabo, $email, $telephone, $typecompte, $entreprise, $statut;

    public function setIdcollabo($idcollabo){
        $this->idcollabo = $idcollabo;
    }

    public function getIdcollabo(){
        return $this->idcollabo;
    }

    public function setNomcollabo($nomcollabo){
        $this->nomcollabo = $nomcollabo;
    }

    public function getNomcollabo(){
        return $this->nomcollabo;
    }

    public function setPrenomcollabo($prenomcollabo){
        $this->prenomcollabo = $prenomcollabo;
    }

    public function getPrenomcollabo(){
        return $this->prenomcollabo;
    }

    public function setemail($email){
        $this->email = $email;
    }

    public function getemail(){
        return $this->email;
    }


    public function setTel($telephone){
        $this->telephone = $telephone;
    }

    public function getTel(){
        return $this->telephone;
    }

    public function setTycompte($typecompte){
        $this->typecompte = $typecompte;
    }

    public function getTycompte(){
        return $this->typecompte;
    }



    public function setStatut($statut){
        $this->statut = $statut;
    }

    public function getStatut(){
        return $this->statut;
    }

    public function setEntreprise($entreprise){
        $this->entreprise = $entreprise;
    }

    public function getEntreprise(){
        return $this->entreprise;
    }
}