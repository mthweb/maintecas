<?php

class documentModel{
    private $iddoc, $denomination, $employe;

    public function setIddoc($iddoc){
        $this->iddoc = $iddoc;
    }

    public function getIddoc(){
        return $this->iddoc;
    }

    public function setDenomination($denomination){
        $this->denomination = $denomination;
    }

    public function getDenomination(){
        return $this->denomination;
    }

    public function setEmploye($employe){
        $this->employe = $employe;
    }

    public function getEmploye(){
        return $this->employe;
    }
    
}