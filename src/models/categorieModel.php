<?php

class categorieModel{
    private $codcat, $libcat;

    public function setCodcat($codcat){
        $this->codcat =$codcat;
    }

    public function getCodcat(){
        return $this->codcat;
    }

    public function setLibcat($libcat){
        $this->libcat = $libcat;
    }

    public function getLibcat(){
        return $this->libcat;
    }
}

