<?php

class entrepriseModel{
    private $numentr, $raison_sociale, $adresse_courriel, $telephone;
    private $zone_intervention, $presentation, $programme, $taille_entreprise;
    private $disponibilite, $tache, $usager, $note;

    public function setNumentr($numentr){
        $this->numentr = $numentr;
    }

    public function getNumentr(){
        return $this->numentr;
    }

    public function setRaisonsociale($raison_sociale){
        $this->raison_sociale = $raison_sociale;
    }

    public function getRaisonsociale(){
        return $this->raison_sociale;
    }

    public function setAdressecourriel($adresse_courriel){
        $this->adresse_courriel = $adresse_courriel;
    }

    public function getAdressecourriel(){
        return $this->adresse_courriel;
    }

    
    public function setTelephone($telephone){
        $this->telephone = $telephone;
    }

    public function getTelephone(){
        return $this->adresse_courriel;
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

    public function setProgramme($programme){
        $this->programme = $programme;
    }

    public function getProgramme(){
        return $this->programme;
    }

    public function setTaille($taille_entreprise){
        $this->taille_entreprise = $taille_entreprise;
    }

    public function getTaille(){
        return $this->taille_entreprise;
    }

    public function setDisponibilite($disponibilite){
        $this->disponibilite = $disponibilite;
    }

    public function getDisponibilite(){
        return $this->disponibilite;
    }

    public function setTache($tache){
        $this->tache = $tache;
    }

    public function getTache(){
        return $this->tache;
    }

    public function setUsager($usager){
        $this->usager = $usager;
    }

    public function getUsager(){
        return $this->usager;
    }

    public function setNote($note){
        $this->note = $note;
    }

    public function getNote(){
        return $this->note;
    }
}