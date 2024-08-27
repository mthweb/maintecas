<?php
// importerle model
include_once '../models/selectionnerModel.php';

class selectionnerControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_selectionner';
    protected $tableJoin1 = 'mt_mode_paiement';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // cette fonction crée une sélection qui permet de faire un choix sur 
    // les modes de paiement
    public function creerSelection(selectionnerModel $sel){
        $query = "INSERT INTO {$this->tablename} (`prestataire`, `MerchantID`, `MerchantPassword`)
                    VALUES (?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $sel->getPrestataire(),
            $sel->getMarchantId(),
            $sel->getMarchantPass(),
        ]);
        
        return $success;
    }
    
    // Cette fonction compte les différents modes de paiements sélectionnés
    public function CompterSelection($val){
        $query = "SELECT COUNT(*) FROM {$this->tablename} WHERE `prestataire` = ?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$val]);

        return $stmt;
    }

    // Cette fonction affiche les différents modes de paiements sélectionnés
    public function AfficherSelection($val, $start , $limite){
        $query = "SELECT * FROM {$this->tablename} WHERE `prestataire` = ? LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val]);

        return $stmt;
    }
    
    // Cette fonction affiche les différents modes de paiements sélectionnés
    public function AfficherSelectionTous(){
        $query = "SELECT * FROM {$this->tablename}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    public function AfficherSelectionParCompte($val){
        $query = "SELECT * FROM {$this->tablename} 
                    -- JOIN {$this->tableJoin1}  ON {$this->tablename}.modepaiement = {$this->tableJoin1}.codmode
                    WHERE prestataire=? ";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val]);
        
        return $stmt;
    }
    
}