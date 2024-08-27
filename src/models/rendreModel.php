<?php

class rendreModel{
    private $employe,$codserv;

    public function setemploye($employe){
        $this->employe =$employe;
    }

    public function getemploye(){
        return $this->employe;
    }

    public function setcodserv($codserv){
        $this->codserv = $codserv;
    }

    public function getcodserv(){
        return $this->codserv;
    }
}

