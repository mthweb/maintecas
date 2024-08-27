<?php

class entretienModel{
    private $idmess, $datemis, $contenu, $emetteur, $destinataire;

    public function setIdmess($idmess){
        $this->idmess = $idmess;
    }

    public function getIdmess(){
        return $this->idmess;
    }

    public function setDatemis($datemis){
        $this->datemis = $datemis;
    }

    public function getDatemis(){
        return $this->datemis;
    }

    public function setContenu($contenu){
        $this->contenu = $contenu;
    }

    public function getContenu(){
        return $this->contenu;
    }

    public function setEmetteur($emetteur){
        $this->emetteur = $emetteur;
    }

    public function getEmetteur(){
        return $this->emetteur;
    }

    public function setDestinataire($destinataire){
        $this->destinataire = $destinataire;
    }

    public function getDestinataire(){
        return $this->destinataire;
    }
}