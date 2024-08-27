<?php

class paiementModel{
    private $idpaie, $datpaie, $montant, $idcmd;

    public function setIdpaie($idpaie){
        $this->idpaie = $idpaie;
    }

    public function getIdpaie(){
        return $this->idpaie;
    }

    public function setDatpaie($datpaie){
        $this->datpaie = $datpaie;
    }

    public function getDatpaie(){
        return $this->datpaie;
    }

    public function setMontant($montant){
        $this->montant = $montant;
    }

    public function getMontant(){
        return $this->montant;
    }

    public function setIdcmd($idcmd){
        $this->idcmd = $idcmd;
    }

    public function getIdcmd(){
        return $this->idcmd;
    }
}