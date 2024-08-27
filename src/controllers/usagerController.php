<?php
// importerle typmodel
include_once '../models/usagerModel.php';

class usagerController
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_usager';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    public function creerUsager(usagerModel $usage){
        $query = "INSERT INTO {$this->tablename} (`nomusager`, `prenomusager`, `telusager`, `emailusager`, `otp_compte`,`token`)
                    VALUES (?,?,?,?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $usage->getnomusager(),
            $usage->getprenomusager(),
            $usage->gettelephoneusager(),
            $usage->getemailusager(),
            $usage->getOtp(),
            $usage->getToken(),
        ]);
        
        return $success;
    }

    public function modifierUsager(usagerModel $usage){
        $query = "UPDATE {$this->tablename} SET `nomusager`=?,`prenomusager`=?,`telusager`=?,`emailusager`=?
                    WHERE `idusager`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $usage->getnomusager(),
            $usage->getprenomusager(),
            $usage->gettelephoneusager(),
            $usage->getemailusager(),
        ]);
      
        return $success;
    }

    public function ajouterOtpCompteParTel(usagerModel $usage){
        $query = "UPDATE {$this->tablename} SET `otp_compte`=?, `token`=? WHERE `telusager`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $usage->getOtp(),
            $usage->getToken(),
            $usage->gettelephoneusager(),
        ]);
      
        return $success;
    }

    public function ajouterOtpCompteParMail(usagerModel $usage){
        $query = "UPDATE {$this->tablename} SET `otp_compte`=?, `token`=? WHERE `emailusager`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $usage->getOtp(),
            $usage->getToken(),
            $usage->getemailusager(),
        ]);
      
        return $success;
    }

    public function supprimerUsager($id){
        $query = "DELETE FROM {$this->tablename} WHERE `idusager`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    public function selectionneUsager($nomtypmodonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nomtypmodonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    public function selectionneUsagerTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `idusager` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    public function CompterUsager(){
        $query = "SELECT COUNT(*) FROM {$this->tablename} ORDER BY idusager DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();

        return $stmt;
    }

    public function AfficherUsager($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idusager DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function AfficherUsagerTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idusager DESC";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    public function verifierExistenceCompte($val){
        $query = "SELECT * FROM {$this->tablename} WHERE telusager='$val' OR emailusager='$val'";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    public function verifierExistenceCompteParMail($mail){
        $query = "SELECT * FROM {$this->tablename} WHERE emailusager=? ";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$mail]);
        
        return $stmt;
    }

    public function connexionUsager($val){
        $query = "SELECT * FROM {$this->tablename} WHERE telusager='$val' OR emailusager='$val'";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
}