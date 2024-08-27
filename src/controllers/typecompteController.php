<?php
// importerle typmodel
include_once '../models/typecompteModel.php';

class typecompteControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_type_compte';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    public function creerTypecompte(typecompteModel $typmod){
        $query = "INSERT INTO {$this->tablename} (`libtypecompte`)
                    VALUES (?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $typmod->getlibtypcompte(),
        ]);
        
        return $success;
    }

    public function modifierTypecompte(typecompteModel $typmod){
        $query = "UPDATE {$this->tablename} SET `libtypecompte`=?
                    WHERE `codtypcompte`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $typmod->getlibtypcompte(),
            $typmod->getcodtypcompte(),
        ]);
      
        return $success;
    }

    public function supprimerTypecompte($id){
        $query = "DELETE FROM {$this->tablename} WHERE `codtypcompte`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    public function selectionneTypecompte($nomtypmodonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomtypmodonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    public function selectionneTypecompteTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `codtypcompte` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    public function CompterTypecompte(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY codtypcompte DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    public function AfficherTypecompte($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codtypcompte DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function AfficherTypecompteTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codtypcompte DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}