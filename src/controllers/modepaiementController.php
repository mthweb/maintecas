<?php
// importerle model
include_once '../models/modepaiemmdpModel.php';

class modepaiementControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_mode_paiement';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    public function creerModepaiement(modepaiementModel $mdp){
        $query = "INSERT INTO {$this->tablename} (`libmode`)
                    VALUES (?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $mdp->getLibmod(),
        ]);
        
        return $success;
    }

    public function modifierModepaiement(modepaiementModel $mdp){
        $query = "UPDATE {$this->tablename} SET `libmode`=?
                    WHERE `codmod`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $mdp->getLibmod(),
            $mdp->getCodmod()
        ]);
      
        return $success;
    }

    public function supprimerModepaiement($id){
        $query = "DELETE FROM {$this->tablename} WHERE `codmode`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    public function selectionneModepaiement($nommdponne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nommdponne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    public function selectionneModepaiementTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `codmode` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    public function CompterModepaiement(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY codmode DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    public function AfficherModepaiement($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codmode DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function AfficherModepaiementTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codmode DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}