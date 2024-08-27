<?php
// la variable action sera utilisé pour la gestion des opérations 
// qui auront lieu pour la gestion des différents modules, le 
// traitement d'une information sera gérée par les actions qui
// seront au préalable défini par le moyen d'envoi des données
$action = $_REQUEST['action'];

if (!empty($action)) {

    // on inclut les mutateurs pour la gestion des données étant
    // donné que l'approche utilisé est l'orienté objet
    include_once('../controllers/entrepriseController.php');
    include_once('../models/entrepriseModel.php');
    include_once('../controllers/effectuerController.php');    
    

    // on importe notre classe connexion
    include_once('../controllers/cnx.php');

    // on instancie les classes, en créant les objets 
    $objEnt    = new entrepriseControleur();
    $objSetEnt = new entrepriseModel();
    $objEff    = new effectuerController(); 
    
}


// nous préparons le script d'insertion des données relatifs aux entreprises
if ($action == "addNew") {
    // récupération des champs
    $orga    = htmlspecialchars($_POST['orga']);
    $addpro  = htmlspecialchars($_POST['addpro']);
    $tailEnt = htmlspecialchars($_POST['tailEnt']);
    $tel     = htmlspecialchars($_POST['tel']);
    // $serv    = htmlspecialchars($_POST['service']);
    // $tache   = htmlspecialchars($_POST['tache']);

    // nous posons une contrainte qui rendra l'erreur 422 ssi les 
    //  champs de saisis sont null
    if ($orga == NULL || $addpro == NULL || $tailEnt == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Aucune valeur n\'a été trouvée'
        ];
    }

    // nous appelons les accesseurs afin d'exécuter notre requete d'insertion
    $objSetEnt->setRaisonsociale($orga);
    $objSetEnt->setAdressecourriel($addpro);
    $objSetEnt->setTelephone($tel);
    $objSetEnt->setZoneintervention('Vide');
    $objSetEnt->setPresentation('Vide');
    $objSetEnt->setProgramme('1');
    $objSetEnt->setTaille('1');
    $objSetEnt->setDisponibilite('1');
    $objSetEnt->setTache('1');
    $objSetEnt->setNote("0");
    // $objSetEnt->setTache($tache);

    // Exécution de l'adresse de la requête d'insertion
    $objEnt->creerEntreprise($objSetEnt);

    if ($objEnt) {
        session_start();
        $_SESSION['emailActif'] = $addpro;
        
        $res = [
            'status' => 200,
            'message' => "opération effectuée avec succès"
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


// affichage des entreprises
if ($action ="getRow") {

    //Déclaration des variables
    $_POST['page'] ?? 1;
    $limite = 5;
    $page = 1;

    if ($_POST['page'] ?? 1 > 1) {
        $start = (($_POST['page'] - 1) * $limite);
        $page  = $_POST['page'];
    } else {
        $start = 0;
    }

    //On selectione toutes les lignes
    $statement = $objEff->AfficherEffectuer($start, $limite);
    $res = $statement->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objEff->CompterEffectuer();
    $total_data = $data_count->fetchColumn();


    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img avatar="'. $row['raison_sociale'].'" class="rounded-circle me-2" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'. $row['raison_sociale'].'</strong>
                            <div class="col-10 mb-1 small">'. $row['libserv'].'</div>
                        </span>
                    </div>
                </a>
            ';
        }
        // echo $output;
    } else {
        $output .= '
            <div class="text-center container pt-2 pb-2 mb-5">
                Aucun collaborateur
            </div>
        ';
        // echo $output;
    }

    $output .= '
            <div class="mt-0">
                <a href="" class="btn btn-light rounded-0 col-12 col-md-12">
                    voir tout
                </a>
            </div>
        </div>
    </div>
    ';

    echo $output;
}