<?php
// importerle typmodel
include_once '../models/roleModel.php';

class roleControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_role';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // cette fonction ajoute un rôle
    public function creerRole(roleModel $rol){
        $query = "INSERT INTO {$this->tablename} (`librole`)
                    VALUES (?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $rol->getLibrole(),
        ]);
        
        return $success;
    }

    // cette fonction modifie un rôle
    public function modifierRole(roleModel $rol){
        $query = "UPDATE {$this->tablename} SET `librole`=?
                    WHERE `codrole`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $rol->getLibrole(),
            $rol->getCodrole(),
        ]);
      
        return $success;
    }

    // Cette fonction supprime un rôle
    public function supprimerRole($id){
        $query = "DELETE FROM {$this->tablename} WHERE `codrole`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }
    
    // Cette fonction supprime un rôle 
    public function selectionneRole($nomColonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomColonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // cette fonction affiche les différents rôles
    public function selectionneRoleTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `codrole` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }

    // cette fonction compte les différents rôles
    public function CompterRole(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY codrole DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les différents rôles
    public function AfficherRole($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codrole DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les différents rôles
    public function AfficherRoleTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codrole DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}