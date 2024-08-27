<?php
// importerle model
include_once '../models/administrateurModel.php';

class administrateurControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_administrateur';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    /**
     * cette fonction permet la création d'un administrateur c'est-à-dire la 
     * création d'un compte administrateur pour la gestion de la plateforme
     */
    public function creerAdmin(administrateurModel $adm){
        $query = "INSERT INTO {$this->tablename} (`nomsession`, `nomutilisateur`, `motdepasse`, `role`)
                    VALUES (?,?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $adm->getNomsession(),
            $adm->getNomutilisateur(),
            $adm->getPassword(),
            $adm->getRole(),
        ]);
        
        return $success;
    }

    // Cette fonction permet la modification d'un administrateur
    public function modifierAdmin(administrateurModel $adm){
        $query = "UPDATE {$this->tablename} SET`nomsession`=?,`nomutilisateur`=?,`motdepasse`=?,`role`=?
                    WHERE `matricule`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $adm->getNomsession(),
            $adm->getNomutilisateur(),
            $adm->getPassword(),
            $adm->getMatri(),
        ]);
      
        return $success;
    }

    // Cette fonction permet la suppression d'un administrateur
    public function supprimerAdmin($id){
        $query = "DELETE FROM {$this->tablename} WHERE `matricule`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    // Cette fonction permet de sélectionner un administrateur en fonction
    // du critère qui sera défini
    public function selectionneAdmin($nomColonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomColonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // Cette fonction affiche tous les administrateurs du stite 
    public function selectionneAdminTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `matricule` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    // Cette fonction affiche tous les administrateurs du stite 
    public function CompterAdmin(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY matricule DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche tous les administrateurs du stite 
    public function AfficherAdmin($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY matricule DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche tous les administrateurs du stite 
    public function AfficherAdminTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY matricule DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}