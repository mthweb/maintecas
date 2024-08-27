<?php

class effectuerModel{
    private $service, $entreprise;

    public function setService($service){
        $this->service = $service;
    }

    public function getService(){
        return $this->service;
    }

    public function setEntreprise($entreprise){
        $this->entreprise = $entreprise;
    }

    public function getEntreprise(){
        return $this->entreprise;
    }
}