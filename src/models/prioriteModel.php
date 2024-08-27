<?php

class prioriteModel{
    private $idpriorite, $permettre_facturation, $commander_surveiller, $organiser_service, $autre, $entreprise;

    public function setIdpriorite($idpriorite){
        $this->idpriorite = $idpriorite;
    }

    public function getIdpriorite(){
        return $this->idpriorite;
    }

    public function setPermfact($permettre_facturation){
        $this->permettre_facturation = $permettre_facturation;
    }

    public function getPermefact(){
        return $this->permettre_facturation;
    }

    public function setCommander($commander_surveiller){
        $this->commander_surveiller = $commander_surveiller;
    }

    public function getCommander(){
        return $this->commander_surveiller;
    }

    public function setOrganiser($organiser_service){
        $this->organiser_service = $organiser_service;
    }

    public function getOrganiser(){
        return $this->organiser_service;
    }

    public function setAutre($autre){
        $this->autre = $autre;
    }

    public function getAutre(){
        return $this->autre;
    }

    public function setEntreprise($entreprise){
        $this->entreprise = $entreprise;
    }

    public function getEntreprise(){
        return $this->entreprise;
    }
}