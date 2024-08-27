<?php
// importerle model
include_once '../models/prioriteModel.php';

class prioriteControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_priorite';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // Cette fonction crée un paiement sur base d'une commande
    public function creerPriorite(prioriteModel $prp){
        $query = "INSERT INTO {$this->tablename} (`permettre_facturation`, `commander_surveiller`, `organiser_service`, `autre`, `entreprise`)
                    VALUES (?,?,?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $prp->getPermefact(),
            $prp->getCommander(),
            $prp->getOrganiser(),
            $prp->getAutre(),
            $prp->getEntreprise(),
        ]);
        
        return $success;
    }

    // Cette fonction modifie une priorité 
    public function modifierPriorite(prioriteModel $prp){
        $query = "UPDATE {$this->tablename} SET `permettre_facturation`=?,`commander_surveiller`=?,`organiser_service`=?,`autre`=?,`entreprise`=?
                    WHERE `idpriorite`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $prp->getPermefact(),
            $prp->getCommander(),
            $prp->getOrganiser(),
            $prp->getAutre(),
            $prp->getEntreprise(),
            $prp->getIdpriorite(),
        ]);
      
        return $success;
    }

    // Cette fonction supprime une priorité 
    public function supprimerPriorite($id){
        $query = "DELETE FROM {$this->tablename} WHERE `idpriorite`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    // Cette fonction affiche les différentes priorités  
    public function selectionnePriorite($nompaieonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nompaieonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }
    
    // Cette fonction affiche les différentes priorités 
    public function selectionnePrioriteTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `idpriorite` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    // Cette fonction compte les différentes priorités  
    public function CompterPriorite(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY idpriorite DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche les différentes priorités  
    public function AfficherPriorite($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idpriorite DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Cette fonction affiche les différentes priorités 
    public function AfficherPrioriteTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idpriorite DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}