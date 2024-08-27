<?php
session_start();
// la variable action sera utilisé pour la gestion des opérations 
// qui auront lieu pour la gestion des différents modules, le 
// traitement d'une information sera gérée par les actions qui
// seront au préalable défini par le moyen d'envoi des données
$action = $_REQUEST['action'];

if (!empty($action)) {

    // import des controllers, afin de faciliter la manipulation des données
    // de nos différentes classes
    include_once('../controllers/cnx.php');
    
    include_once('../controllers/keywordController.php');    
    include_once('../controllers/rendreController.php');    
    include_once('../controllers/effectuerController.php');    

    // on instancie les classes (création des objets)
    $objKey    = new keywordControleur();
    $objRend   = new rendreControleur();
    $objEff    = new effectuerController();
}


// Ce script permet l'insertion des nouveaux profiles prestataires dans la plateforme
// la contrainte doit toujours au préalable être égaler à une valeur pour que l'opération aboutisse
if ($action == "getKey") {
    // récupération des champs
    $query = htmlspecialchars($_GET['query']);
    
    // Exécution de l'adresse de la requête d'insertion
    $stmt = $objKey->rechercherKeyword($query);

    // $suggestions = [];

    $suggestions = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    // Retourner les résultats uniques en format JSON
    echo json_encode($suggestions);

} 