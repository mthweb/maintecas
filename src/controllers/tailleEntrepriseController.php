<?php
// importerle model
include_once '../models/tailleEntrepriseModel.php';

class tailleEntrepriseControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_taille_entreprise';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // Cette fonction créer les différentes tailles 
    public function creerTailleEntreprise(tacheModel $tac){
        $query = "INSERT INTO {$this->tablename} (`libtaille`)
                    VALUES (?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $tac->getlibtache(),
        ]);
        
        return $success;
    }

    // Cette fonction modifie les différentes tailles
    public function modifierTache(tacheModel $tac){
        $query = "UPDATE {$this->tablename} SET `libtaille`=?
                    WHERE `codetaille`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $tac->getlibtache(),
            $tac->getcodtache(),
        ]);
      
        return $success;
    }

    // Cette fonction supprimer les tailles
    public function supprimerTailleEntreprise($id){
        $query = "DELETE FROM {$this->tablename} WHERE `codetaille`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    // cette fonction sélectionne les tailles
    public function selectionneTailleEntreprise($nommodonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nommodonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // cette fonction sélectionne les tailles
    public function selectionneTailleEntrepriseTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `codetaille` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    // cette fonction compte les tailles
    public function CompterTailleEntreprise(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY codetaille DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les tailles
    public function AfficherTailleEntreprise($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codetaille DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    
    // cette fonction affiche les tailles
    public function AfficherTailleEntrepriseTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codetaille DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}