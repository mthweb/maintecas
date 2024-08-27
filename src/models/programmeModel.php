<?php

class programmeModel{
    private $codpgm,$libpgm;

    public function setcodpgm($codpgm){
        $this->codpgm =$codpgm;
    }

    public function getcodpgm(){
        return $this->codpgm;
    }

    public function setlibpgm($libpgm){
        $this->libpgm =$libpgm;
    }

    public function getlibpgm(){
        return $this->libpgm;
    }
}