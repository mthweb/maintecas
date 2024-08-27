<?php

class interventionModel{
    private $idinter, $numinter, $datinter, $compte, $date_intervention, $lieu_intervention, $prix_intervention,
    $details, $etat, $statut, $prestataire;

    public function setIdInter($idinter){
        $this->idinter = $idinter;
    }

    public function getIdInter(){
        return $this->idinter;
    }

    public function setNumInter($numinter){
        $this->numinter = $numinter;
    }

    public function getNumInter(){
        return $this->numinter;
    }

    public function setDatInter($datinter){
        $this->datinter = $datinter;
    }

    public function getDatInter(){
        return $this->datinter;
    }

    public function setCompte($compte){
        $this->compte = $compte;
    }

    public function getCompte(){
        return $this->compte;
    }

    public function setDatIntervention($date_intervention){
        $this->date_intervention = $date_intervention;
    }

    public function getDatIntervention(){
        return $this->date_intervention;
    }

    public function setLieuIntervention($lieu_intervention){
        $this->lieu_intervention = $lieu_intervention;
    }

    public function getLieuIntervention(){
        return $this->lieu_intervention;
    }

    public function setPrixIntervention($prix_intervention){
        $this->prix_intervention = $prix_intervention;
    }

    public function getPrixIntervention(){
        return $this->prix_intervention;
    }

    public function setDetails($details){
        $this->details = $details;
    }

    public function getDetails(){
        return $this->details;
    }

    public function setEtat($etat){
        $this->etat = $etat;
    }

    public function getEtat(){
        return $this->etat;
    }

    public function setStatut($statut){
        $this->statut = $statut;
    }

    public function getStatut(){
        return $this->statut;
    }

    public function setPrestataire($prestataire){
        $this->prestataire = $prestataire;
    }

    public function getPrestataire(){
        return $this->prestataire;
    }
}