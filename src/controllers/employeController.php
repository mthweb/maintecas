<?php
// importerle model
include_once '../models/employeModel.php';

class employeControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_employe';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // Cette fonction créer ou ajoute un employer
    public function creerEmploye(employeModel $emp){
        $query = "INSERT INTO {$this->tablename} (`nomemploye`, `prenomemploye`, `telemploye`, `emailemploye`, `qualite`, `zone_intervention`, `presentation`, `type_compte`, `disponibilite`, `note`)
                    VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $emp->getNomemploye(),
            $emp->getPrenemploye(),
            $emp->getTelemploye(),
            $emp->getEmailemploye(),
            $emp->getQualite(),
            $emp->getZoneintervention(),
            $emp->getPresentation(),
            $emp->getTypecompte(),
            $emp->getDisponibilite(),
        ]);
        
        return $success;
    }

    // Cette fonction modifie les informations de l'employé
    public function modifierEmploye(employeModel $emp){
        $query = "UPDATE {$this->tablename} SET `nomemploye`=?,`prenomemploye`=?,`telemploye`=?,`emailemploye`=?,`qualite`=?,`zone_intervention`=?,`presentation`=?,`type_compte`=?,`disponibilite`=?,`note`=?
                    WHERE `idemploye`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $emp->getNomemploye(),
            $emp->getPrenemploye(),
            $emp->getTelemploye(),
            $emp->getEmailemploye(),
            $emp->getQualite(),
            $emp->getZoneintervention(),
            $emp->getPresentation(),
            $emp->getTypecompte(),
            $emp->getDisponibilite(),
        ]);
      
        return $success;
    }

    // Cette fonction supprime un employé
    public function supprimerEmploye($id){
        $query = "DELETE FROM {$this->tablename} WHERE `idemploye`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    // Cette fonction affiche tous les employés par critère de sélection
    public function selectionneEmploye($nomemponne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomemponne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // Cette fonction affiche tous les employés
    public function selectionneEmployeTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `idemploye` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    // Cette fonction compte tous les employés
    public function CompterEmploye(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY idemploye DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche tous les employés
    public function AfficherEmploye($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idemploye DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche tous les employés
    public function AfficherEmployeTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idemploye DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}