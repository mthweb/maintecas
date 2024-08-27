<?php
// importerle model
include_once '../models/entretienModel.php';

class entretienControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_entretien';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    public function creerEntretien(entretienModel $ent){
        $query = "INSERT INTO {$this->tablename} (`datemis`, `contenu`, `emetteur`, `destinataire`)
                    VALUES (?,?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $ent->getDatemis(),
            $ent->getContenu(),
            $ent->getEmetteur(),
            $ent->getDestinataire(),
        ]);
        
        return $success;
    }

    public function modifierEntretien(entretienModel $ent){
        $query = "UPDATE {$this->tablename} SET `contenu`=?
                    WHERE `idmess`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $ent->getContenu(),
            $ent->getIdmess()
        ]);
      
        return $success;
    }

    public function supprimerEntretien($id){
        $query = "DELETE FROM {$this->tablename} WHERE `idmess`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    public function selectionneEntretien($nomentonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomentonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    public function selectionneEntretienTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `idmess` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    public function CompterEntretien(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY idmess DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    public function AfficherEntretien($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idmess DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function AfficherEntretienTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idmess DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}