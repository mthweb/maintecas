<?php

class rechercheModel{
    private $id_recherche, $date_recherche, $contenu, $compte, $etat;

    public function setIdrecherche($id_recherche){
        $this->id_recherche =$id_recherche;
    }

    public function getIdrecherche(){
        return $this->id_recherche;
    }

    public function setDaterecherche($date_recherche){
        $this->date_recherche =$date_recherche;
    }

    public function getDaterecherche(){
        return $this->date_recherche;
    }

    public function setContenu($contenu){
        $this->contenu =$contenu;
    }

    public function getContenu(){
        return $this->contenu;
    }

    public function setCompte($compte){
        $this->compte =$compte;
    }

    public function getCompte(){
        return $this->compte;
    }

    public function setEtat($etat){
        $this->etat =$etat;
    }

    public function getEtat(){
        return $this->etat;
    }
}