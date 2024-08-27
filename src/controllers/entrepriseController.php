<?php
// importerle model
include_once '../models/entrepriseModel.php';

class entrepriseControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_entreprise';
    protected $tableJoint1= 'mt_taille_entreprise';
    protected $tableJoint2= 'mt_disponibilite';
    protected $tableJoint3= 'mt_secteur';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // Cette fonction créer ou ajoute une entreprise
    public function creerEntreprise(entrepriseModel $ent){
        $query = "INSERT INTO {$this->tablename} (`raison_sociale`, `adresse_courriel`, `telephone`, `zone_intervention`, `presentation`, `programme`, `taille_entreprise`, `disponibilite`, `tache`, `note`)
                    VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $ent->getRaisonsociale(),
            $ent->getAdressecourriel(),
            $ent->getTelephone(),
            $ent->getZoneintervention(),
            $ent->getPresentation(),
            $ent->getProgramme(),
            $ent->getTaille(),
            $ent->getDisponibilite(),
            $ent->getTache(),
            $ent->getNote(),
        ]);
        
        return $success;
    }

    // Cette fonction modifie les informations de l'entreprise
    public function modifierEntreprise(entrepriseModel $ent){
        $query = "UPDATE {$this->tablename} SET `raison_sociale`=?,`adresse_courriel`=?,`telephone`=?,`zone_intervention`=?,`presentation`=?,`programme`=?,`taille_entreprise`=?,`disponibilite`=?,`tache`=?,`note`=?
                    WHERE `numentr`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $ent->getRaisonsociale(),
            $ent->getAdressecourriel(),
            $ent->getTelephone(),
            $ent->getZoneintervention(),
            $ent->getPresentation(),
            $ent->getProgramme(),
            $ent->getTaille(),
            $ent->getDisponibilite(),
            $ent->getTache(),
            $ent->getNote(),
            $ent->getNumentr(),
        ]);
      
        return $success;
    }

    // Cette fonction supprime une entreprise
    public function supprimerEntreprise($id){
        $query = "DELETE FROM {$this->tablename} WHERE `idemploye`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    // Cette fonction affiche tous les entreprises par critère de sélection
    public function selectionneEntreprise($nomemponne, $valeur){
        $query = "SELECT * FROM {$this->tablename} 
                    JOIN {$this->tableJoint1} ON {$this->tablename}.taille_entreprise = {$this->tableJoint1}.codetaille
                    JOIN {$this->tableJoint2} ON {$this->tablename}.disponibilite = {$this->tableJoint2}.iddispo
                    WHERE ".$nomemponne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // Cette fonction affiche tous les entreprises
    public function selectionneEntrepriseTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `numentr` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    // Cette fonction compte tous les entreprises
    public function CompterEntreprise(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY numentr DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche tous les entreprises
    public function AfficherEntreprise($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY numentr DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche tous les entreprises
    public function AfficherEntrepriseTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY numentr DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}