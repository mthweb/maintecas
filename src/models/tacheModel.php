<?php

class tacheModel{
    private $codtache, $libtache;

    public function setcodtache($codtache){
        $this->codtache =$codtache;
    }

    public function getcodtache(){
        return $this->codtache;
    }

    public function setlibtache($libtache){
        $this->libtache =$libtache;
    }

    public function getlibtache(){
         return $this->libtache;
    }
    
}