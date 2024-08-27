<?php

class choisirModel{
    private $entreprise, $modepaiement, $numcompte;
    
    public function setEntreprise($entreprise){
        $this->entreprise = $entreprise;
    }

    public function getEntreprise(){
        return $this->entreprise;
    }

    public function setModepaiement($modepaiement){
        $this->modepaiement = $modepaiement;
    }

    public function getModepaiement(){
        return $this->modepaiement;
    }

    public function setNumcompte($numcompte){
        $this->numcompte = $numcompte;
    }

    public function getNumcompte(){
        return $this->numcompte;
    }


}