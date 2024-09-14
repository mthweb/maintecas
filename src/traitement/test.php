<?php
 // on inclut les mutateurs pour la gestion des données étant
    // donné que l'approche utilisé est l'orienté objet
    include_once('../controllers/interventionController.php');    
    include_once('../controllers/usagerController.php');    
    include_once('../models/interventionModel.php');    
    
    // on importe notre classe connexion
    include_once('../controllers/cnx.php');

    // Import de la fonction de génération des numéros aléatoires d'intervetion
    // maintecas
    include_once('../helpers/intervention-number.php');

    // on instancie les classes, en créant les objets
    $objInter    = new interventionControleur();
    $objSetInter = new interventionModel();
    $objUsa      = new usagerController();


$objSetInter->setNumInter('89890');
    $objSetInter->setDatInter('23/09/2024');
    $objSetInter->setCompte('23');
    $objSetInter->setDatIntervention('23/09/2024');
    $objSetInter->setLieuIntervention('23/09/2024');
    $objSetInter->setPrixIntervention('10');
    $objSetInter->setDetails('$details');
    $objSetInter->setPrestataire('8');
    
    // Exécution de l'adresse de la requête d'insertion
    $objInter->creerIntervention($objSetInter);


    $stmt_usager = $objUsa->selectionneUsager("telusager",'24300000');
    while($data_usager = $stmt_usager->fetch()){
        // assignation de la valeur finale
        echo $key_final   = $data_usager['idusager'];
    }
    