<?php
// importerle typmodel
include_once '../models/secteurModel.php';

class secteurControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_secteur';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // cette fonction ajoute un rôle
    public function creerSecteur(programmeModel $typpgm){
        $query = "INSERT INTO {$this->tablename} (`libsecteur`)
                    VALUES (?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $typpgm->getlibpgm(),
        ]);
        
        return $success;
    }

    // cette fonction modifie un rôle
    public function modifierSecteur(programmeModel $typpgm){
        $query = "UPDATE {$this->tablename} SET `libsecteur`=?
                    WHERE `codesecteur`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $typpgm->getlibpgm(),
            $typpgm->getcodpgm(),
        ]);
      
        return $success;
    }

    // Cette fonction supprime un secteur
    public function supprimerSecteur($id){
        $query = "DELETE FROM {$this->tablename} WHERE `codesecteur`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }
    
    // Cette fonction selectionne un secteur 
    public function selectionneSecteur($nomColonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomColonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // cette fonction affiche les différents secteurs
    public function selectionneSecteurTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `codesecteur` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }

    // cette fonction compte les différents secteurs
    public function CompterProgramme(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY codesecteur DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les différents secteurs
    public function AfficherProgramme($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codesecteur DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les différents secteurs
    public function AfficherProgrammeTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codesecteur DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}