<?php
// importerle model
include_once '../models/tacheModel.php';

class tacheControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_tache';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // Cette fonction créer les différents tâches 
    public function creerTache(tacheModel $tac){
        $query = "INSERT INTO {$this->tablename} (`libtache`)
                    VALUES (?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $tac->getlibtache(),
        ]);
        
        return $success;
    }

    // Cette fonction modifie les différents tâches
    public function modifierTache(tacheModel $tac){
        $query = "UPDATE {$this->tablename} SET `libtache`=?
                    WHERE `codtache`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $tac->getlibtache(),
            $tac->getcodtache(),
        ]);
      
        return $success;
    }

    // Cette fonction supprimer les tâches
    public function supprimerTache($id){
        $query = "DELETE FROM {$this->tablename} WHERE `codtache`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    // cette fonction sélectionne les services
    public function selectionneTache($nommodonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nommodonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // cette fonction sélectionne les tâches
    public function selectionneTacheTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `codtache` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    // cette fonction compte les tâches
    public function CompterTache(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY codtache DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les tâches
    public function AfficherTache($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codtache DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    
    // cette fonction affiche les tâches
    public function AfficherTacheTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codtache DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}