<?php

class employeModel{

    private $idemploye, $nomemploye, $prenomemploye, $telemploye;
    private $emailemploye, $qualite, $zone_intervention, $presentation;
    private $type_compte, $disponibilite, $usager, $note; 

    public function setIdemploye($idemploye){
        $this->idemploye = $idemploye;
    }

    public function getIdemploye(){
        return $this->idemploye;
    }

    public function setNomemploye($nomemploye){
        $this->nomemploye = $nomemploye;
    }

    public function getNomemploye(){
        return $this->nomemploye;
    }

    public function setPrenemploye($prenomemploye){
        $this->prenomemploye = $prenomemploye;
    }

    public function getPrenemploye(){
        return $this->prenomemploye;
    }

    public function setTelemploye($telemploye){
        $this->telemploye = $telemploye;
    }

    public function getTelemploye(){
        return $this->telemploye;
    }

    public function setEmailmploye($emailemploye){
        $this->emailemploye = $emailemploye;
    }

    public function getEmailemploye(){
        return $this->emailemploye;
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

    public function setUsager($note){
        $this->note = $note;
    }

    public function getUsager(){
        return $this->usager;
    }

    public function setNote($usager){
        $this->usager = $usager;
    }

    public function getNote(){
        return $this->note;
    }
}