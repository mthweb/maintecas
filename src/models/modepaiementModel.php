<?php

class modepaiementModel{
    private $codmode, $libmode;

    public function setCodmod($codmode){
        $this->codmode = $codmode;
    }

    public function getCodmod(){
        return $this->codmode;
    }

    public function setLibmode($libmode){
        $this->libmode = $libmode;
    }

    public function getLibmod(){
        return $this->libmode;
    }
}