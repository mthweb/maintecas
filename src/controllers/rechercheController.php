<?php
// importerle typmodel
include_once '../models/rechercheModel.php';

class rechercheControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_recherche';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // cette fonction ajoute un programme
    public function creerRecherche(rechercheModel $rec){
        $query = "INSERT INTO {$this->tablename} (`date_recherche`, `contenu`, `compte`, `etat`)
                    VALUES (?,?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $rec->getDaterecherche(),
            $rec->getContenu(),
            $rec->getCompte(),
            $rec->getEtat(),
        ]);
        
        return $success;
    }

    // Cette fonction supprime un programme
    public function supprimerRecherche($id){
        $query = "DELETE FROM {$this->tablename} WHERE `id_recherche`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    public function selectionneRecherche($nomcolonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomcolonne."=?"."AND etat = '0'";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // cette fonction affiche les différents recherche
    public function selectionneRechercheTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `id_recherche` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }

    // cette fonction compte les différents recherche
    public function CompterRecherche(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY id_recherche DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les différentes recherche
    public function AfficherRecherche($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY id_recherche DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les différentes recherches
    public function AfficherRechercheTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY id_recherche DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}