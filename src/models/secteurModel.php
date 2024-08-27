<?php

class secteurModel{
    private $codesecteur, $libsecteur;

    public function setCodsecteur($codesecteur){
        $this->codesecteur =$codesecteur;
    }

    public function getCodsecteur(){
        return $this->codesecteur;
    }

    public function setLibsecteur($libsecteur){
        $this->libsecteur = $libsecteur;
    }

    public function getLibsecteur(){
        return $this->libsecteur;
    }
}

