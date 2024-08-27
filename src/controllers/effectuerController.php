<?php
// importerle model
include_once '../models/effectuerModel.php';

class effectuerController
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_effectuer';
    protected $tableJoint1= 'mt_entreprise';
    protected $tableJoint2= 'mt_service';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    /**
     * cette fonction permet la création des services qui seront effectué 
     * par le client
     */
    public function creerEffectuer(effectuerModel $eff){
        $query = "INSERT INTO {$this->tablename} (`service`, `entreprise`)
                    VALUES (?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $eff->getService(),
            $eff->getEntreprise(),
        ]);
        
        return $success;
    } 

    // Cette fonction affiche tous les différents choix des utilsateurs en fonction 
    // des arguments qui seront placés
    public function selectionneEffectuer($nomColonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomColonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // Cette fonction affiche tous les différents choix des utilsateurs
    public function selectionneEffectuerTous(){
        $query = "SELECT * FROM {$this->tablename} ";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }

    // Cette fonction compte tous les différents choix des utilsateurs
    public function CompterEffectuer(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

     // Cette fonction affiche tous les différents choix des utilsateurs
     public function AfficherChoixParEntreprise($val){
        $query = "SELECT * FROM {$this->tablename} 
                    JOIN {$this->tableJoint1} ON {$this->tablename}.entreprise = {$this->tableJoint1}.numentr  
                    JOIN {$this->tableJoint2} ON {$this->tablename}.`service` = {$this->tableJoint2}.codserv  
                    WHERE  entreprise=?";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val]);

        return $stmt;
    }

    // Cette fonction affiche tous les différents choix des utilsateurs
    public function AfficherEffectuer($start , $limite){
        $query = "SELECT * FROM {$this->tablename} 
                    JOIN {$this->tableJoint1} ON {$this->tablename}.entreprise = {$this->tableJoint1}.numentr
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    ORDER BY raison_sociale ASC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche tous les différents choix des utilsateurs
    public function AfficherEffectuerTous(){
        $query = "SELECT * FROM {$this->tablename} ";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    // cette fonction affiche les différents services sélectionnés
    public function AfficherServiceEffectuer($val, $start , $limite){
        $query = "SELECT * FROM {$this->tablename}
                    JOIN {$this->tableJoint1} ON {$this->tablename}.entreprise = {$this->tableJoint1}.numentr
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    WHERE `libserv` = ? LIMIT  {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val]);
            
        return $stmt;
    }

    public function AfficherServiceEffectuerParCode($val){
        $query = "SELECT * FROM {$this->tablename}
                    JOIN {$this->tableJoint1} ON {$this->tablename}.entreprise = {$this->tableJoint1}.numentr
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    WHERE `service` = ?";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val]);
            
        return $stmt;
    }
        
}