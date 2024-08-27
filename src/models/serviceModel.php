<?php

class serviceModel{
    private $codserv,$libserv;

    public function setcodserv($codserv){
        $this->codserv =$codserv;
    }

    public function getcodserv(){
        return $this->codserv;
    }

    public function setlibserv($libserv){
        $this->libserv =$libserv;
    }

    public function getlibserv(){
         return $this->libserv;
    }
    
}