<?php
// importerle model
include_once '../models/messagerieModel.php';

class messagerieControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename  = 'mt_messagerie';
    protected $tableJoint1= 'mt_prestataire';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }

    public function creerMessage(messagerieModel $mess){
        $query = "INSERT INTO {$this->tablename} (`datemis`, `contenu`, `emetteur`, `destinataire`)
                    VALUES (?,?,?,?)";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $mess->getDatemis(),
            $mess->getContenu(),
            $mess->getEmetteur(),
            $mess->getDestinataire(),
        ]);
        
        return $success;
    }

    public function modifierMessage(messagerieModel $mess){
        $query = "UPDATE {$this->tablename} SET `contenu`=?
                    WHERE `idmess`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([
            $mess->getContenu(),
            $mess->getIdmess()
        ]);
      
        return $success;
    }

    public function supprimerMessage($id){
        $query = "DELETE FROM {$this->tablename} WHERE `idmess`=?";
        $stmt = $this->cnx->prepare($query);
        $success = $stmt->execute([$id]);

        return $success;
    }

    public function selectionneMeessage($nommessonne, $valeur){
        $query = "SELECT * FROM {$this->tablename} WHERE ".$nommessonne."=?";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$valeur]);
        
        return $stmt;
    }

    public function selectionneMessageTous(){
        $query = "SELECT * FROM {$this->tablename} ORDER BY `idmess` DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute();
    
        return $stmt;
    }
    
    // cette requête permet de suivre l'evolution d'un message c'est-à-dire savoir si celui-ci est lu ou pas
    // deux signaux ou valeurs ont été utilisées soit 0 pour non lu et 1 pour lu
    public function CompterMessageParSession($session){
        $query = "SELECT COUNT(*) FROM {$this->tablename} 
                    WHERE `emetteur`=? AND `status` = '0' ORDER BY idmess DESC";
        $stmt = $this->cnx->prepare($query); 
        $stmt->execute([$session]);

        return $stmt;
    }

    public function AfficherMessage($start , $limite){
        $query = "SELECT * FROM {$this->tablename} ORDER BY idmess DESC LIMIT {$start}, {$limite}";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // cette requête permet d'afficher uniquement les derniers messages envoyés par un utilisateurs
    // le tri des messages ce fait par id et la limite des messages à afficher est de 1
    public function AfficherMessageParSession($session){
        $query = "SELECT * FROM {$this->tablename} 
                    JOIN {$this->tableJoint1} ON {$this->tablename}.emetteur = {$this->tableJoint1}.idprestataire
                    WHERE `recepteur` = ? GROUP BY emetteur";
        $stmt = $this->cnx->prepare($query);
        $stmt->execute([$session]);
        
        return $stmt;
    }
    
}