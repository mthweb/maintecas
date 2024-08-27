<?php
// importerle model
include_once '../models/disponibiliteModel.php';

class disponibiliteControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_disponibilite';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    /**
     * cette fonction permet la création d'une disponibilité 
     */
    public function creerDispo(disponibiliteModel $dis){
        $query = "INSERT INTO {$this->tablename} (`libdispo`)
                    VALUES (?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $dis->getLibdispo()
        ]);
        
        return $success;
    }

    // Cette fonction permet de modifier une disponibilité 
    public function modifierDispo(disponibiliteModel $dis){
        $query = "UPDATE {$this->tablename} SET `libdispo`=?
                    WHERE `iddispo`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $dis->getLibdispo()
        ]);
      
        return $success;
    }

    /**
     * Cette fonction permettra de supprimer une disponibilité
     */
    public function supprimerDispo($id){
        $query = "DELETE FROM {$this->tablename} WHERE `iddispo`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    // Cette fonction affiche toutes les différentes disponibilités 
    public function selectionneDispo($nomColonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomColonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // Cette fonction affiche tous les différentes disponibilités 
    public function selectionneDispoTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `iddispo` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }

    // Cette fonction compte tous les différentes disponibilités
    public function CompterDispo(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY `iddispo` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche tous les différentes disponibilités 
    public function AfficherDispo($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `iddispo` DESC LIMIT {$start}, {$limite} ";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche tous les différentes disponibilités 
    public function AfficherDispoTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `iddispo` DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}