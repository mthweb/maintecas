<?php
// importerle model
include_once '../models/documentModel.php';

class documentControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_document';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // cette fonction permet d'ajouter un document soit les documents 
    // attestant qu'un employé est réellement détentaire des droits d'exercices
    public function creerDocument(documentModel $doc){
        $query = "INSERT INTO {$this->tablename} (`denomination`, `employe`)
                    VALUES (?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $doc->getDenomination(),
            $doc->getEmploye(),
        ]);
        
        return $success;
    }

    // cette fonction permet la modification des documents en cas d'echec de chargement
    // ou d'insertion 
    public function modifierDocument(documentModel $doc){
        $query = "UPDATE {$this->tablename} SET `denomination`=?,`employe`=?
                    WHERE `iddoc`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $doc->getDenomination(),
            $doc->getEmploye(),
            $doc->getIddoc(),
        ]);
      
        return $success;
    }

    // Cette fonction supprimer un document
    public function supprimerDocument($id){
        $query = "DELETE FROM {$this->tablename} WHERE `iddoc`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    // cette fonction sélectionne un document par critère
    public function selectionneDocument($nomdoconne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomdoconne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }
    // cette fonction affiche tous les documents
    public function selectionneDocumentTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `iddoc` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
     // cette fonction compte tous les documents
    public function CompterDocument(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY iddoc DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }
    // cette fonction affiche tous les documents par limite
    public function AfficherDocument($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY iddoc DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    
    // cette fonction affiche tous les documents
    public function AfficherDocumentTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY iddoc DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}