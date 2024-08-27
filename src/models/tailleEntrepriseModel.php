<?php

class tailleEntrepriseModel{
    private $codetaille, $libtaille;

    public function setcodtaille($codetaille){
        $this->codetaille =$codetaille;
    }

    public function getcodtaille(){
        return $this->codetaille;
    }

    public function setlibtaille($libtaille){
        $this->libtaille =$libtaille;
    }

    public function getlibtaille(){
         return $this->libtaille;
    }
    
}