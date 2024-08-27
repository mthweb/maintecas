<?php

class selectionnerModel{
    private $id_selection, $prestataire, $merchantID, $merchantPassword;

    public function setIdselection($id_selection){
        $this->id_selection =$id_selection;
    }

    public function getIdselection(){
        return $this->id_selection;
    }

    public function setPrestataire($prestataire){
        $this->prestataire =$prestataire;
    }

    public function getPrestataire(){
        return $this->prestataire;
    }

    public function setMarchantId($merchantID){
        $this->merchantID =$merchantID;
    }

    public function getMarchantId(){
        return $this->merchantID;
    }

    public function setMarchantPass($merchantPassword){
        $this->merchantPassword =$merchantPassword;
    }

    public function getMarchantPass(){
        return $this->merchantPassword;
    }

}