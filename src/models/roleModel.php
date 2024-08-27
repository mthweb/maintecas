<?php

class roleModel{
    private $codrole, $librole;

    public function setCodrole($codrole){
        $this->codrole =$codrole;
    }

    public function getCodrole(){
        return $this->codrole;
    }

    public function setLibrole($librole){
        $this->librole = $librole;
    }

    public function getLibrole(){
        return $this->librole;
    }
}

