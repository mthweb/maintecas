<?php

class prestataireModel{

    private $idprestataire, $nomprestataire, $prenomprestataire, $telprestataire;
    private $emailprestataire, $qualite, $zone_intervention, $presentation;
    private $type_compte, $disponibilite, $note, $categorie, $session_maintecas; 

    public function setIdprestataire($idprestataire){
        $this->idprestataire = $idprestataire;
    }

    public function getIdprestataire(){
        return $this->idprestataire;
    }

    public function setNomprestataire($nomprestataire){
        $this->nomprestataire = $nomprestataire;
    }

    public function getNomprestataire(){
        return $this->nomprestataire;
    }

    public function setPrenprestataire($prenomprestataire){
        $this->prenomprestataire = $prenomprestataire;
    }

    public function getPrenprestataire(){
        return $this->prenomprestataire;
    }

    public function setTelprestataire($telprestataire){
        $this->telprestataire = $telprestataire;
    }

    public function getTelprestataire(){
        return $this->telprestataire;
    }

    public function setEmailprestataire($emailprestataire){
        $this->emailprestataire = $emailprestataire;
    }

    public function getEmailprestataire(){
        return $this->emailprestataire;
    }

    public function setQualite($qualite){
        $this->qualite = $qualite;
    }

    public function getQualite(){
        return $this->qualite;
    }


    public function setZoneintervention($zone_intervention){
        $this->zone_intervention = $zone_intervention;
    }

    public function getZoneintervention(){
        return $this->zone_intervention;
    }


    public function setPresentation($presentation){
        $this->presentation = $presentation;
    }

    public function getPresentation(){
        return $this->presentation;
    }

    public function setTypecompte($type_compte){
        $this->type_compte = $type_compte;
    }

    public function getTypecompte(){
        return $this->type_compte;
    }

    public function setDisponibilite($disponibilite){
        $this->disponibilite = $disponibilite;
    }

    public function getDisponibilite(){
        return $this->disponibilite;
    }
          
    public function setNote($note){
        $this->note = $note;
    }

    public function getNote(){
        return $this->note;
    }

    public function setCategorie($categorie){
        $this->categorie = $categorie;
    }

    public function getCategorie(){
        return $this->categorie;
    }

    public function setSessionMaintecas($session_maintecas){
        $this->session_maintecas = $session_maintecas;
    }

    public function getSessionMaintecas(){
        return $this->session_maintecas;
    }
}