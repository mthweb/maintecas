<?php
// importerle model
include_once '../models/serviceModel.php';

class serviceControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_service';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // Cette fonction créer les différents services
    public function creerService(serviceModel $mod){
        $query = "INSERT INTO {$this->tablename} (`libserv`)
                    VALUES (?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $mod->getlibserv(),
        ]);
        
        return $success;
    }

    // Cette fonction modifie les différents services
    public function modifierService(serviceModel $mod){
        $query = "UPDATE {$this->tablename} SET `libserv`=?
                    WHERE `codserv`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $mod->getlibserv(),
            $mod->getcodserv(),
        ]);
      
        return $success;
    }

    // Cette fonction supprimer les services
    public function supprimerService($id){
        $query = "DELETE FROM {$this->tablename} WHERE `codserv`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    // cette fonction sélectionne les services
    public function selectionneService($nommodonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nommodonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // cette fonction sélectionne les services
    public function selectionneServiceTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `codserv` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    // cette fonction compte les services
    public function CompterService(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY codserv DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les services
    public function AfficherService($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY rand() DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    
    // cette fonction affiche les services
    public function AfficherServiceTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codserv DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}