<?php

class moteurRechercheControleur
{
    private $cnx;

    //nom de la table 
    protected $tablename   = 'mt_prestataire';
    protected $tablename1  = 'mt_entreprise';
    protected $tablename2  = 'mt_service';
    protected $tablename3  = 'mt_categorie';

    function __construct()
    {
        $this->cnx = cnx::getConnexion();
    }
    SELECT id, `key`, `word`, audience
    FROM mt_keyword 
    WHERE MATCH(`word`) AGAINST("mon pneu est crévé je peux trouver un technicien quado" IN NATURAL LANGUAGE MODE)
    public function rechercherService($valeur){
        $query = "SELECT 'prestataire' AS source, idprestataire AS id, nomprestataire AS name, presentation, note 
                    FROM mt_prestataire 
                    WHERE MATCH(nomprestataire, presentation, zone_intervention, qualite) AGAINST(:searchQuery IN NATURAL LANGUAGE MODE))
                    UNION
                    (SELECT 'entreprise' AS source, numentr AS id, raison_sociale AS name, presentation, note 
                    FROM mt_entreprise 
                    WHERE MATCH(raison_sociale, presentation, zone_intervention, programme) AGAINST(:searchQuery IN NATURAL LANGUAGE MODE))
                    UNION
                    (SELECT 'service' AS source, codserv AS id, libserv AS name, '' AS presentation, NULL AS note 
                    FROM mt_service 
                    WHERE libserv LIKE :likeQuery)
                    UNION
                    (SELECT 'categorie' AS source, codcat AS id, libcat AS name, '' AS presentation, NULL AS note 
                    FROM mt_categorie 
                    WHERE libcat LIKE :likeQuery)
                    ORDER BY note DESC, name ASC
                ";
    
    $stmt = $this->cnx->prepare($query);
    $likeQuery = '%' . $valeur . '%';
    
    // Exécutez la requête
    $stmt->execute([
        ':searchQuery' => $valeur,
        ':likeQuery' => $likeQuery
    ]);
    
        
    }
}

