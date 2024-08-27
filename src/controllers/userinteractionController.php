<?php
// importerle typmodel
include_once '../models/userinteractionModel.php';

class userinteractionController
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_user_interaction';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // on crée une interaction en fonction de la navigation de l'application
    public function creerInteraction(userinteractionModel $userinteract){
        $query = "INSERT INTO {$this->tablename} (`date_activite`, `activite`, `equipement`, `user`)
                    VALUES (?,?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $userinteract->getDateactivite(),
            $userinteract->getActivite(),
            $userinteract->getEquipement(),
            $userinteract->getUsager(),
        ]);
        
        return $success;
    }

    // On compte les navigations
    public function CompterInteraction(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY id_interaction DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // On affiche toutes les intéractions
    public function AfficherInteraction($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY id_interaction DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // On affiche toutes les intéractions
    public function AfficherInteractionTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY id_interaction DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}