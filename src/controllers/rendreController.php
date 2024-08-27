<?php
// importerle model
include_once '../models/rendreModel.php';

class rendreControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_rendre';
    protected $tableJoint1= 'mt_prestataire';
    protected $tableJoint2= 'mt_service';
    protected $tableJoint3= 'mt_type_compte';
    protected $tableJoint4= 'mt_categorie';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    public function creerRendre(rendreModel $rend){
        $query = "INSERT INTO {$this->tablename} (`employe`, `service`)
                    VALUES (?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $rend->getemploye(),
            $rend->getcodserv(),
        ]);
        
        return $success;
    }

    // Cette fonction supprime un rôle 
    public function selectionneRendu($nomColonne, $valeur){
        $query = "SELECT * FROM {$this->tablename}
                    JOIN {$this->tableJoint1} ON {$this->tablename}.employe = {$this->tableJoint1}.idprestataire
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    WHERE ".$nomColonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }
    
    // cette fonction compte les différents services sélectionnés
    public function CompterRendre(){
        $query = "SELECT COUNT(*) FROM {$this->tablename}";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les différents services sélectionnés
    public function AfficherRendre($start , $limite){
        $query = "SELECT * FROM {$this->tablename} 
                    JOIN {$this->tableJoint1} ON {$this->tablename}.employe = {$this->tableJoint1}.idprestataire
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    JOIN {$this->tableJoint3} On {$this->tableJoint1}.`type_compte`= {$this->tableJoint3}.codtypcompte
                    ORDER BY nomprestataire ASC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les différents services sélectionnés
    // cette requête renvoie les données par le type de service rendu
    public function AfficherRendreTous($start , $limite){
        $query = "SELECT * FROM {$this->tablename} LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // cette fonction affiche les différents services sélectionnés
    public function AfficherServiceRendu($val, $val2, $start , $limite){
        $query = "SELECT * FROM {$this->tablename}
                    JOIN {$this->tableJoint1} ON {$this->tablename}.employe = {$this->tableJoint1}.idprestataire
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    JOIN {$this->tableJoint3} On {$this->tableJoint1}.`type_compte`= {$this->tableJoint3}.codtypcompte
                    WHERE `libserv` = ? AND `libtypecompte`=? LIMIT  {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val,$val2]);
        
        return $stmt;
    }

    // cette fonction affiche les différents services sélectionnés
    public function AfficherServiceRenduParCompte($val, $start , $limite){
        $query = "SELECT * FROM {$this->tablename}
                    JOIN {$this->tableJoint1} ON {$this->tablename}.employe = {$this->tableJoint1}.idprestataire
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    JOIN {$this->tableJoint3} On {$this->tableJoint1}.`type_compte`= {$this->tableJoint3}.codtypcompte
                    WHERE `libtypecompte`=? LIMIT  {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val]);
        
        return $stmt;
    }

    // cette fonction affiche les différents services sélectionnés
    public function AfficherServiceRenduTous($val, $start , $limite){
        $query = "SELECT * FROM {$this->tablename}
                    JOIN {$this->tableJoint1} ON {$this->tablename}.employe = {$this->tableJoint1}.idprestataire
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    JOIN {$this->tableJoint3} On {$this->tableJoint1}.`type_compte`= {$this->tableJoint3}.codtypcompte
                    WHERE `libserv` = ?  LIMIT  {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val]);
        
        return $stmt;
    }

    // cette fonction affiche les différents services sélectionnés
    public function AfficherServiceRenduTousParZone($val, $val2, $start , $limite){
        $query = "SELECT * FROM {$this->tablename}
                    JOIN {$this->tableJoint1} ON {$this->tablename}.employe = {$this->tableJoint1}.idprestataire
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    JOIN {$this->tableJoint3} On {$this->tableJoint1}.`type_compte`= {$this->tableJoint3}.codtypcompte
                    WHERE `libserv` = ? AND `zone_intervention` LIKE '%$val2%'  LIMIT  {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val]);
        
        return $stmt;
    }

    public function AfficherServiceRenduTousParZoneParDisponibilite($val, $val2, $val3, $start , $limite){
        $query = "SELECT * FROM {$this->tablename}
                    JOIN {$this->tableJoint1} ON {$this->tablename}.employe = {$this->tableJoint1}.idprestataire
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    JOIN {$this->tableJoint3} On {$this->tableJoint1}.`type_compte`= {$this->tableJoint3}.codtypcompte
                    WHERE `libserv` = ? AND `zone_intervention` LIKE '%$val2%' AND disponibilite = ?  LIMIT  {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val,$val3]);
        
        return $stmt;
    }

    public function AfficherServiceRenduTousParZoneParNote($val, $val2, $val3, $start , $limite){
        $query = "SELECT * FROM {$this->tablename}
                    JOIN {$this->tableJoint1} ON {$this->tablename}.employe = {$this->tableJoint1}.idprestataire
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    JOIN {$this->tableJoint3} On {$this->tableJoint1}.`type_compte`= {$this->tableJoint3}.codtypcompte
                    WHERE `libserv` = ? AND `zone_intervention` LIKE '%$val2%' AND `note` = ?  LIMIT  {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val,$val3]);
        
        return $stmt;
    }

    public function AfficherServiceRenduTousParZoneParCategorie($val, $val2, $val3, $start , $limite){
        $query = "SELECT * FROM {$this->tablename}
                    JOIN {$this->tableJoint1} ON {$this->tablename}.employe = {$this->tableJoint1}.idprestataire
                    JOIN {$this->tableJoint2} ON {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    JOIN {$this->tableJoint3} ON {$this->tableJoint1}.`type_compte`= {$this->tableJoint3}.codtypcompte
                    JOIN {$this->tableJoint4} ON {$this->tableJoint1}.`categorie`= {$this->tableJoint4}.codcat
                    WHERE `libserv` = ? AND `zone_intervention` LIKE '%$val2%' AND `libcat` = ?  LIMIT  {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val,$val3]);
        
        return $stmt;
    }

    public function suggessionProfileParZone($val, $val2, $start , $limite){
        $query = "SELECT * FROM {$this->tablename}
                    JOIN {$this->tableJoint1} ON {$this->tablename}.employe = {$this->tableJoint1}.idprestataire
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    JOIN {$this->tableJoint3} On {$this->tableJoint1}.`type_compte`= {$this->tableJoint3}.codtypcompte
                    WHERE `libserv` = ? AND `zone_intervention` NOT LIKE '%$val2%'  LIMIT  {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val]);
        
        return $stmt;
    }


    public function AfficherServiceRenduParCode($val, $val2, $start , $limite){
        $query = "SELECT * FROM {$this->tablename}
                    JOIN {$this->tableJoint1} ON {$this->tablename}.employe = {$this->tableJoint1}.idprestataire
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    JOIN {$this->tableJoint3} On {$this->tableJoint1}.`type_compte`= {$this->tableJoint3}.codtypcompte
                    WHERE `service` = ? AND `libtypecompte`=? LIMIT  {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val,$val2]);
        
        return $stmt;
    }
    
    public function AfficherServiceRenduParservice($val, $val2, $start , $limite){
        $query = "SELECT * FROM {$this->tablename}
                    JOIN {$this->tableJoint1} ON {$this->tablename}.employe = {$this->tableJoint1}.idprestataire
                    JOIN {$this->tableJoint2} On {$this->tablename}.`service`= {$this->tableJoint2}.codserv
                    JOIN {$this->tableJoint3} On {$this->tableJoint1}.`type_compte`= {$this->tableJoint3}.codtypcompte
                    JOIN {$this->tableJoint4} ON {$this->tableJoint1}.`categorie`= {$this->tableJoint4}.codcat

                    WHERE `libtypecompte`=? AND `libserv` = ?  LIMIT  {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$val,$val2]);
        
        return $stmt;
    }
    
}