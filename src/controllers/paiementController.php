<?php
// importerle model
include_once '../models/paiementModel.php';

class paiememtControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_paiement';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // Cette fonction crée un paiement sur base d'une commande
    public function creerPaiement(paiementModel $paie){
        $query = "INSERT INTO {$this->tablename} (`datpaie`, `montant`, `commande`)
                    VALUES (?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $paie->getDatpaie(),
            $paie->getMontant(),
            $paie->getIdcmd(),
        ]);
        
        return $success;
    }

    // Cette fonction modifie un paiement
    public function modifierPaiement(paiementModel $paie){
        $query = "UPDATE {$this->tablename} SET `datpaie`=?,`montant`=?,`commande`=?
                    WHERE `idpaie`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $paie->getDatpaie(),
            $paie->getMontant(),
            $paie->getIdcmd(),
        ]);
      
        return $success;
    }

    // Cette fonction supprime un paiement
    public function supprimerPaiement($id){
        $query = "DELETE FROM {$this->tablename} WHERE `idpaie`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    // Cette fonction affiche les paiements 
    public function selectionneModepaiement($nompaieonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nompaieonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }
    
    // Cette fonction affiche les paiements
    public function selectionnePaiementTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `idpaie` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    // Cette fonction compte les paiement 
    public function CompterPaiement(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY idpaie DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche les paiements 
    public function AfficherPaiement($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idpaie DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche les paiements 
    public function AfficherPaiementTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idpaie DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}