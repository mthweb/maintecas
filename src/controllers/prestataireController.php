<?php
// importerle model
include_once '../models/prestataireModel.php';

class prestataireControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_prestataire';
    protected $tableJoint1= 'mt_disponibilite';
    protected $tableJoint2= 'mt_type_compte';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // Cette fonction créer ou ajoute un prestatairer
    public function creerPrestataire(prestataireModel $emp){
        $query = "INSERT INTO {$this->tablename} (`session_maintecas`, `nomprestataire`, `telprestataire`, `emailprestataire`, 
        `qualite`, `zone_intervention`, `presentation`, `type_compte`, `categorie`, `disponibilite`, `note`)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $emp->getSessionMaintecas(),
            $emp->getNomprestataire(),
            $emp->getTelprestataire(),
            $emp->getEmailprestataire(),
            $emp->getQualite(),
            $emp->getZoneintervention(),
            $emp->getPresentation(),
            $emp->getTypecompte(),
            $emp->getCategorie(),
            $emp->getDisponibilite(),
            $emp->getNote(),
        ]);
        
        return $success;
    }

    // Cette fonction modifie les informations du prestataire
    public function modifierPrestataire(prestataireModel $emp){
        $query = "UPDATE {$this->tablename} SET `nomprestataire`=?,`prenomprestataire`=?,`telprestataire`=?,`emailprestataire`=?,`qualite`=?,`zone_intervention`=?,`presentation`=?,`type_compte`=?,`disponibilite`=?,`note`=?
                    WHERE `idprestataire`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $emp->getNomprestataire(),
            $emp->getPrenprestataire(),
            $emp->getTelprestataire(),
            $emp->getEmailprestataire(),
            $emp->getQualite(),
            $emp->getZoneintervention(),
            $emp->getPresentation(),
            $emp->getTypecompte(),
            $emp->getDisponibilite(),
        ]);
      
        return $success;
    }

    public function modifierConfigurationPrestataire(prestataireModel $emp){
        $query = "UPDATE {$this->tablename} SET `qualite`=?,`zone_intervention`=?,`presentation`=?,`disponibilite`=?
                    WHERE `idprestataire`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $emp->getQualite(),
            $emp->getZoneintervention(),
            $emp->getPresentation(),
            $emp->getDisponibilite(),
            $emp->getIdprestataire(),
        ]);
      
        return $success;
    }

    // Cette fonction supprime un prestataire
    public function supprimerPrestataire($id){
        $query = "DELETE FROM {$this->tablename} WHERE `idprestataire`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    // Cette fonction affiche tous les prestataires par critère de sélection
    public function selectionnePrestataire($nomcolonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} 
                    JOIN {$this->tableJoint1} ON  {$this->tablename}.disponibilite = {$this->tableJoint1}.iddispo
                    WHERE ".$nomcolonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    public function selectionnePrestataireParParametre($nomcolonne, $valeur, $valeur2, $start, $limite){
        $query = "SELECT * FROM {$this->tablename} 
                    JOIN {$this->tableJoint1} ON  {$this->tablename}.disponibilite = {$this->tableJoint1}.iddispo
                    JOIN {$this->tableJoint2} ON  {$this->tablename}.type_compte = {$this->tableJoint2}.codtypcompte
                    WHERE ".$nomcolonne."=? "."AND libtypecompte=?  ORDER BY `idprestataire` DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur, $valeur2]);
        
        return $stmt;
    }

    public function connexionPrestataire($nomcolonne, $valeur, $valeur2){
        $query = "SELECT * FROM {$this->tablename} 
                    JOIN {$this->tableJoint1} ON  {$this->tablename}.disponibilite = {$this->tableJoint1}.iddispo
                    JOIN {$this->tableJoint2} ON  {$this->tablename}.type_compte = {$this->tableJoint2}.codtypcompte
                    WHERE ".$nomcolonne."=? "."AND `password`=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur, $valeur2]);
        
        return $stmt;
    }

    


    // Cette fonction affiche tous les prestataires
    public function selectionnePrestataireTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `idprestataire` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    // Cette fonction affiche tous les prestataires
    public function selectionnePrestataireTousLimite($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `idprestataire` DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }


    // Cette fonction compte tous les prestataires
    public function CompterPrestataire(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY idprestataire DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche tous les prestataires
    public function AfficherPrestataire($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idprestataire DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche tous les prestataires
    public function AfficherPrestataireTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idprestataire DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}