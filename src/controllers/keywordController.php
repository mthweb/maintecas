<?php

class keywordControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename   = 'mt_keyword';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }
   
    public function rechercherMot($valeur){
        $query = "SELECT id, `key`, `word`, audience 
                    FROM {$this->tablename} WHERE MATCH(`word`) 
                    AGAINST(? IN NATURAL LANGUAGE MODE)";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    public function compterRechercheMot($valeur){
        $query = "SELECT COUNT(*) FROM {$this->tablename} WHERE MATCH(`word`) 
                    AGAINST(? IN NATURAL LANGUAGE MODE)";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }
    
    public function rechercherServiceAll($valeur){
        $query = "SELECT `key`, `word` FROM `mt_keyword` WHERE `key` LIKE ? OR `word` LIKE ?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    public function rechercherKeyword($valeur){
        $query = "SELECT `key`, `word` FROM `mt_keyword` WHERE `word` LIKE '%$valeur%'";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
        
        return $stmt;
    }
    
    // Cette fonction affiche tous les employés
    public function AfficherKeyword($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY rand() DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction compte tous les prestataires
    public function CompterKeyword(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY id DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }
}

