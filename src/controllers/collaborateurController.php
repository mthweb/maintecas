<?php
// importerle model
include_once '../models/collaborateurModel.php';

class collaborateurControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_collaborateur';
    protected $tableJoint1= 'mt_type_compte';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    public function creerCollaborateur(collaborateurModel $col){
        $query = "INSERT INTO {$this->tablename} (`nomcollabo`, `prenomcollabo`, `email`, `telephone`, `typecompte`, `entreprise`, `statut`)
                    VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $col->getNomcollabo(),
            $col->getPrenomcollabo(),
            $col->getemail(),
            $col->getTel(),
            $col->getTycompte(),
            $col->getEntreprise(),
            $col->getStatut(),
        ]);
        
        return $success;
    }

    public function modifierCollaborateur(collaborateurModel $col){
        $query = "UPDATE {$this->tablename} SET `nomcollabo`=?,`prenomcollabo`=?,`email`=?,`telephone`=?,`typecompte`=?,`entreprise`=?,`statut`=?
                    WHERE `idcollabo`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $col->getNomcollabo(),
            $col->getPrenomcollabo(),
            $col->getemail(),
            $col->getTel(),
            $col->getTycompte(),
            $col->getEntreprise(),
            $col->getStatut(),
        ]);
      
        return $success;
    }

    public function supprimerCollaborateur($id){
        $query = "DELETE FROM {$this->tablename} WHERE `idcollabo`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    public function selectionneCollaborateur($nomColonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomColonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    public function selectionneCollaborateurActif($nomColonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} 
                    JOIN {$this->tableJoint1} ON {$this->tablename}.typecompte = {$this->tableJoint1}.codtypcompte
                    WHERE ".$nomColonne."=?"."AND `statut`='1'";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    public function selectionneCollaborateurTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `idcollabo` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    public function CompterCollaborateur(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY idcollabo DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    public function AfficherCollaborateur($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idcollabo DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function AfficherCollaborateurTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idcollabo DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}