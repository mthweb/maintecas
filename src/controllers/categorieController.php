<?php
// importerle typmodel
include_once '../models/categorieModel.php';

class categorieControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_categorie';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // cette fonction ajoute un rôle
    public function creerCategorie(categorieModel $cat){
        $query = "INSERT INTO {$this->tablename} (`libcat`)
                    VALUES (?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $cat->getLibcat(),
        ]);
        
        return $success;
    }

    // cette fonction modifie un rôle
    public function modifierCategorie(categorieModel $cat){
        $query = "UPDATE {$this->tablename} SET `libcat`=?
                    WHERE `codcat`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $cat->getLibcat(),
            $cat->getCodcat(),
        ]);
      
        return $success;
    }

    // Cette fonction supprime un rôle
    public function supprimerCategorie($id){
        $query = "DELETE FROM {$this->tablename} WHERE `codcat`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }
    
    // Cette fonction supprime un rôle 
    public function selectionneCategorie($nomColonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomColonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // cette fonction affiche les différents rôles
    public function selectionneCategorieTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `codcat` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }

    // cette fonction compte les différents rôles
    public function CompterCategorie(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY codcat DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les différents rôles
    public function AfficherCategorie($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codcat DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les différents rôles
    public function AfficherCategorieTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codcat DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}