<?php
// importerle model
include_once '../models/choisirModel.php';

class choisirControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_choisir';
    protected $tableJoint1= 'mt_entreprise';
    protected $tableJoint2= 'mt_mode_paiement';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    /**
     * cette fonction permet la création d'un choix c'est-à-dire que 
     * l'utilisateur peut sélectionner autant de mode de paiement pour 
     * relier à son compte maintecas
     */
    public function creerChoix(choisirModel $chx){
        $query = "INSERT INTO {$this->tablename} (`entreprise`, `modepaiement`, `numcompte`)
                    VALUES (?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $chx->getEntreprise(),
            $chx->getModepaiement(),
            $chx->getNumcompte(),
        ]);
        
        return $success;
    }

   

    // Cette fonction affiche tous les différents choix des utilsateurs en fonction 
    // des arguments qui seront placés
    public function selectionneChoix($nomColonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomColonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // Cette fonction affiche tous les différents choix des utilsateurs
    public function selectionneChoixTous(){
        $query = "SELECT * FROM {$this->tablename} ";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }

    // Cette fonction compte tous les différents choix des utilsateurs
    public function CompterChoix(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche tous les différents choix des utilsateurs
    public function AfficherChoix($start , $limite){
        $query = "SELECT * FROM {$this->tablename} LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche tous les différents choix des utilsateurs
    public function AfficherChoixParEntreprise($val){
        $query = "SELECT * FROM {$this->tablename} 
                    JOIN {$this->tableJoint1} ON {$this->tablename}.entreprise = {$this->tableJoint1}.numentr  
                    JOIN {$this->tableJoint2} ON {$this->tablename}.modepaiement = {$this->tableJoint2}.codmode  
                    WHERE  entreprise=?";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val]);

        return $stmt;
    }

    // Cette fonction affiche tous les différents choix des utilsateurs
    public function AfficherChoixTous(){
        $query = "SELECT * FROM {$this->tablename} ";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}