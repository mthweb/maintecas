<?php
// la variable action sera utilisé pour la gestion des opérations 
// qui auront lieu pour la gestion des différents modules, le 
// traitement d'une information sera gérée par les actions qui
// seront au préalable défini par le moyen d'envoi des données
$action = $_REQUEST['action'];

if (!empty($action)) {

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
}


// Nous écrivons un script pour obtenir les informations sur les interventions
if ($action == 'getIntervention') {
    if (isset($_GET['inter_id'])) {
        $idModif    = strip_tags($_GET['inter_id']);
        $stmtInter  = $objInter->selectionneIntervention("idinter", $idModif);
        $interModif = $stmtInter->fetch();

        if (isset($interModif) && !empty($interModif)) {
            $res = [
                'status' => 200,
                'message' => "Intervention trouvée avec succès par id",
                'data' => $interModif
            ];
            echo json_encode($res);
            return false;

            // echo "Tuteur ajouté avec succès";
        } else {
            $res = [
                'status' => 404,
                'message' => "Intervention non existante pas"
            ];
            echo json_encode($res);
            return false;
        }
    }
}


// Ce script gère la programmation des interventions dans la plateforme maintecas, l'utilisateur peut donc
// insérer ses différentes interventions
if ($action == "definirIntervention") {
    // récupération des champs
    $num_inter   = htmlspecialchars($getNumIntervention);
    $datinter    = htmlspecialchars(date('Y-m-d'));
    $date_inter  = htmlspecialchars($_POST['dateIntervention']);
    $lieu_inter  = htmlspecialchars($_POST['lieu_inter']);
    $compteUsager= htmlspecialchars($_POST['compteUsager']);
    $prestataire = htmlspecialchars($_POST['prestataire']);
    $cout_inter  = htmlspecialchars($_POST['cout_inter']);
    $details     = htmlspecialchars($_POST['details']);

    // nous posons une contrainte qui rendra l'erreur 422 ssi les 
    //  champs de saisis sont null
    if ($num_inter == NULL || $datinter == NULL || $date_inter == NULL || $lieu_inter == NULL || 
            $compteUsager == NULL || $prestataire == NULL || $cout_inter == NULL || $details == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Aucune valeur n\'a été trouvée'
        ];
    }

    // créons une variable pour recevoir la nouvelle valeur de la clé utilisateur,
    // par défaut cette variable sera égale à la valeur de la clé renvoyé par la 
    // plateforme
    // $key_final = $compteUsager;


    // créons une regex pour vérifier si le format saisi est un numéro de téléphone
    // $pattern = '/^\+?[0-9]{7,15}$/';

    // nous allons grace au filtre de php, vérifier si quel type de valeur a été saisie
    // dans nos champs de saisi
    // if (filter_var($compteUsager,FILTER_VALIDATE_EMAIL)) {
    //     $stmt_usager = $objUsa->selectionneUsager("emailusager",$compteUsager);
    //     $data_usager = $stmt_usager->fetch();
    //     // assignation de la valeur finale
    //     $key_final   = $data_usager['idusager'];

    // }elseif(preg_match($pattern,$compteUsager)){
    //     $stmt_usager = $objUsa->selectionneUsager("telusager",$compteUsager);
    //     $data_usager = $stmt_usager->fetch();
    //     // assignation de la valeur finale
    //     $key_final   = $data_usager['idusager'];

    // }else{
    //     // $key_final = $compteUsager;
    //     // Nous allons récupéré via le numéro de téléphone les informations de l'utilisateur s'il a un compte
    //     $stmt_usager = $objUsa->selectionneUsager("numtelusager",$compteUsager);
    //     $data_usager = $stmt_usager->fetch();

    //     // Nous récupérons la clé de l'utilisateur
    //     $key_final = $data_usager['idusager'];
    // }

    // nous appelons les accesseurs afin d'exécuter notre requete d'insertion
    $objSetInter->setNumInter($num_inter);
    $objSetInter->setDatInter($datinter);
    $objSetInter->setCompte('1');
    $objSetInter->setDatIntervention($date_inter);
    $objSetInter->setLieuIntervention($lieu_inter);
    $objSetInter->setPrixIntervention($cout_inter);
    $objSetInter->setDetails($details);
    $objSetInter->setPrestataire($prestataire);
    
    // Exécution de l'adresse de la requête d'insertion
    $objInter->creerIntervention($objSetInter);

    if ($objInter) {
               
        $res = [
            'status' => 200,
            'message' => "Intervention envoyée avec succès"
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 500,
            'message' => "Echec!"
        ];
        echo json_encode($res);  
        return false;
    }
} 

