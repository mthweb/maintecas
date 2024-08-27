<?php
// importerle typmodel
include_once '../models/programmeModel.php';

class programmeControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_programme';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    // cette fonction ajoute un programme
    public function creerProgramme(programmeModel $typpgm){
        $query = "INSERT INTO {$this->tablename} (`libpgm`)
                    VALUES (?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $typpgm->getlibpgm(),
        ]);
        
        return $success;
    }

    // cette fonction modifie un programme
    public function modifierProgramme(programmeModel $typpgm){
        $query = "UPDATE {$this->tablename} SET `libpgm`=?
                    WHERE `codpgm`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $typpgm->getlibpgm(),
            $typpgm->getcodpgm(),
        ]);
      
        return $success;
    }

    // Cette fonction supprime un programme
    public function supprimerProgramme($id){
        $query = "DELETE FROM {$this->tablename} WHERE `codpgm`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    public function selectionneProgramme($nomtypmodonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomtypmodonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    // cette fonction affiche les différents programmes
    public function selectionneProgrammeTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `codpgm` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }

    // cette fonction compte les différents programmes
    public function CompterProgramme(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY codpgm DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les différents programmes
    public function AfficherProgramme($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codpgm DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les différents programmes
    public function AfficherProgrammeTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY codpgm DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}