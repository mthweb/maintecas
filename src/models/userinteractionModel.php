<?php

class userinteractionModel{
    private $id_interaction, $date_activite, $activite, $equipement, $user;

    public function setidinteraction($id_interaction){
        $this->id_interaction =$id_interaction;
    }

    public function getidinteraction(){
        return $this->id_interaction;
    }

    public function setDateactivite($date_activite){
        $this->date_activite =$date_activite;
    }

    public function getDateactivite(){
        return $this->date_activite;
    }

    public function setActivite($activite){
        $this->activite =$activite;
    }

    public function getActivite(){
        return $this->activite;
    }

    public function setEquipement($equipement){
        $this->equipement =$equipement;
    }

    public function getEquipement(){
        return $this->equipement;
    }

    public function setUsager($user){
        $this->user =$user;
    }

    public function getUsager(){
        return $this->user;
    }
} 