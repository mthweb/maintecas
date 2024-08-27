<?php
// importerle model
include_once '../models/interventionModel.php';

class interventionControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_intervention';
    protected $tableJoint1= 'mt_usager';
    protected $tableJoint2= 'mt_prestataire';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }
    /**
     * Cette fonction permet de créer une nouvelle commande, le client peut donc
     * formuler sa requête et celle-ci sera enregistrée
     */
    public function creerIntervention(interventionModel $inter){
        $query = "INSERT INTO {$this->tablename} (`numinter`, `datinter`, `compte`, `date_intervention`, `lieu_intervention`, `prix_intervention`, `details_intervention`, `prestataire`)
                    VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $inter->getNumInter(),
            $inter->getDatInter(),
            $inter->getCompte(),
            $inter->getDatIntervention(),
            $inter->getLieuIntervention(),
            $inter->getPrixIntervention(),
            $inter->getDetails(),
            $inter->getPrestataire(),
        ]);
        
        return $success;
    }

    

    // cette fonction permet la validation d'une commande 
    // la logique stipule que l'état de la commande doit passer à 1 
    // pour être validé
    public function validerIntervention(interventionModel $inter){
        $query = "UPDATE {$this->tablename} SET `etat`='1', `statut` = 'validée'
                    WHERE `idinter`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $inter->getIdInter(),
        ]);
      
        return $success;
    }

    // Cette fonction permet l'annulation d'une commande, l'état de 
    // la commande reste donc à 0
    public function annulerIntervention(interventionModel $inter){
        $query = "UPDATE {$this->tablename} SET `etat`='0', `statut` = 'annulée'
                    WHERE `idinter`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $inter->getIdInter(),
        ]);
      
        return $success;
    }

    // Cette fonction permet de supprimer une commande 
    public function supprimerIntervention($id){
        $query = "DELETE FROM {$this->tablename} WHERE `idinter`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    // Cette fonction sélectionne une commande sur critère dans les arguments
    public function selectionneIntervention($nomcmdonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} 
                    JOIN {$this->tableJoint1} ON {$this->tablename}.compte = {$this->tableJoint1}.idusager  
                    JOIN {$this->tableJoint2} ON {$this->tablename}.prestataire = {$this->tableJoint2}.idprestataire  
                    WHERE ".$nomcmdonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // cette fonction affiche toutes les commandes
    public function selectionneInterventionTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `idinter` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    // cette fonction permet le comptage des commandes enregistrées
    public function CompterIntervention(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY idinter DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // cette fonction permet le comptage des commandes enregistrées
    public function CompterInterventionParCompte($val){
        $query = "SELECT COUNT(*) FROM {$this->tablename} WHERE prestataire=? AND `etat` = '0'  ORDER BY idinter DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$val]);

        return $stmt;
    }

    // cette fonction affiche toutes les commandes
    public function AfficherIntervention($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idinter DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche toutes les commandes
    public function AfficherInterventionTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idinter DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    // cette fonction affiche toutes les commandes
    public function verifierIntervention(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idinter DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    

    // cette fonction affiche toutes les commandes
    public function AfficherInterventionParCompte($val,$start,$limite){
        $query = "SELECT * FROM {$this->tablename} 
                    JOIN {$this->tableJoint1} ON {$this->tablename}.compte = {$this->tableJoint1}.idusager  
                    JOIN {$this->tableJoint2} ON {$this->tablename}.prestataire = {$this->tableJoint2}.idprestataire  
                    WHERE prestataire = ? ORDER BY idinter DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val]);

        return $stmt;
    }

}