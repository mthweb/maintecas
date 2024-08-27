<?php

session_start();


include_once('../controllers/usagerController.php');
include_once('../models/usagerModel.php');

// on importe notre classe connexion
include_once('../controllers/cnx.php');

// on instancie les classes
$objUsa    = new usagerController();
$objSetUsa = new usagerModel();


// donné que l'approche utilisé est l'orienté objet
include_once('../controllers/keywordController.php');    
include_once('../controllers/rendreController.php');    
include_once('../controllers/effectuerController.php');    

// on importe notre classe connexion
include_once('../controllers/cnx.php');

// on instancie les objets
$objKey    = new keywordControleur();
$objRend   = new rendreControleur();
$objEff    = new effectuerController();


// // $objSetUsa->setprenomusager('$prenom');
// //     $objSetUsa->setnomusager('$nom');
// //     $objSetUsa->settelephoneusager('$teleph');
// //     $objSetUsa->setemailusager('$email');

// //     $objUsa->creerUsager($objSetUsa);

// $input = "u";

// $stmt = $objKey->rechercherServiceAll($input);

// $suggession = array();

// while ($row = $res = $stmt->fetch()) {
//     $suggession[] = $row['key']. ' - '. $row['word'];
// }

// echo json_encode($suggession);

// // Déclaration de la variable qui gère la transaction par défaut nous définissons la 
//     // valeur par une province, la gestion est momentanément statique
//     $input = "Professionnelle";

//     $statement = $objRend->AfficherServiceRenduParservice("Technicien", $input ,$start, $limite);
//     $res = $statement->fetchAll();


    include_once('../controllers/usagerController.php');
    include_once('../models/usagerModel.php');

    // on importe notre classe connexion
    include_once('../controllers/cnx.php');

    // import de la fonction de génération des otps
    include_once('../function/otp.php');

    // on instancie les classes
    // $objUsa    = new usagerController();
    // $objSetUsa = new usagerModel();


    // $objSetUsa->setprenomusager($prenom);
    // $objSetUsa->setnomusager($nom);
    // $objSetUsa->settelephoneusager($teleph);
    // $objSetUsa->setemailusager($email);
    // $objSetUsa->setOtp($otp);
    // $objSetUsa->setToken($token);

    // $objUsa->creerUsager($objSetUsa);

    // on inclut les mutateurs pour la gestion des données étant
    // donné que l'approche utilisé est l'orienté objet
    include_once('../controllers/prestataireController.php');    
    include_once('../models/prestataireModel.php');    
    include_once('../controllers/selectionnerController.php');    
    include_once('../models/selectionnerModel.php');    
    
    // on importe notre classe connexion
    include_once('../controllers/cnx.php');

    // Importons la fonction de génération des sessions maintecas
    // pour la gestion des différents comptes prestataires
    include_once('../function/sessionMaintecas.php');

    // on instancie les classes, en créant les objets
    $objPrest    = new prestataireControleur();
    $objSetPrest = new prestataireModel();
    $objSelect   = new selectionnerControleur();
    $objSetSelect= new selectionnerModel();

    include_once('../controllers/prestataireController.php');    
    include_once('../models/prestataireModel.php');    
    include_once('../controllers/selectionnerController.php');    
    include_once('../models/selectionnerModel.php');    
    include_once('../controllers/interventionController.php');    
    include_once('../models/interventionModel.php');    
    
    // on importe notre classe connexion
    include_once('../controllers/cnx.php');

    // Importons la fonction de génération des sessions maintecas
    // pour la gestion des différents comptes prestataires
    include_once('../function/sessionMaintecas.php');

    // on instancie les classes, en créant les objets
    $objPrest    = new prestataireControleur();
    $objSetPrest = new prestataireModel();
    $objSelect   = new selectionnerControleur();
    $objSetSelect= new selectionnerModel();
    $objInter    = new interventionControleur();
    $objSetInter = new interventionModel();

    // echo sha1('12345');

    // $statement = $objSelect->AfficherSelection('17', '0', '5');
    // $result = $statement->fetchAll();

    // echo '<pre>';
    // print_r($result);
    // echo '</pre>';


      // //On selectione toutes les lignes
      // $statement = $objInter->AfficherInterventionParCompte('4', 0, 5);
      // $result = $statement->fetchAll();
  
      // //On compte le nombre de ligne
      // $data_count = $objInter->AfficherInterventionParCompte('4', 0, 5);
      // $total_data = $data_count->fetchColumn();


      // nous appelons les accesseurs afin d'exécuter notre requete d'insertion
    // $objSetInter->setNumInter('903438');
    // $objSetInter->setDatInter('12/12/2024');
    // $objSetInter->setCompte('68');
    // $objSetInter->setDatIntervention('12/12/2024');
    // $objSetInter->setLieuIntervention('Kin');
    // $objSetInter->setPrestataire('4');
    
    // // Exécution de l'adresse de la requête d'insertion
    // $objInter->creerIntervention($objSetInter);

    $start = 0;
    $limite= 5;


    //On selectione toutes les lignes
    // $statement = $objInter->AfficherInterventionParCompte($_SESSION['idprestataire'], $start, $limite);
    // $result = $statement->fetchAll();

    // print_r($result);

    // //On compte le nombre de ligne
    // $data_count = $objInter->AfficherInterventionParCompte($_SESSION['idprestataire'], $start, $limite);
    // echo $total_data = $data_count->fetchColumn();

    // $idModif='2';

    // $stmtInter  = $objInter->selectionneIntervention("numinter", $idModif);
    //     $interModif = $stmtInter->fetch();

    //     print_r($interModif);

    include_once('../controllers/keywordController.php');    
    include_once('../controllers/rendreController.php');    
    include_once('../controllers/effectuerController.php');    

    // on instancie les classes (création des objets)
    $objKey    = new keywordControleur();
    $objRend   = new rendreControleur();
    $objEff    = new effectuerController();


        // Exécution de l'adresse de la requête d'insertion
    $stmt = $objKey->rechercherKeyword($query);

    // $suggestions = [];

    $suggestions = $stmt->fetchAll(PDO::FETCH_ASSOC);