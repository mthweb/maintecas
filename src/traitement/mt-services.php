<?php
// la variable action sera utilisé pour la gestion des opérations 
// qui auront lieu pour la gestion des différents modules, le 
// traitement d'une information sera gérée par les actions qui
// seront au préalable défini par le moyen d'envoi des données
$action = $_REQUEST['action'];

if (!empty($action)) {

    // on inclut les mutateurs pour la gestion des données étant
    // donné que l'approche utilisé est l'orienté objet
    include_once('../controllers/serviceController.php*');    
    
    // on importe notre classe connexion
    include_once('../controllers/cnx.php');

    // on instancie les classes, en créant les objets
    $objServ = new serviceControleur();
}





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
    $statement = $objServ->AfficherServiceTous();
    $res = $statement->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objServ->CompterService("Technicien",$start, $limite);
    $total_data = $data_count->fetchColumn();


    $output = '
         <div id="horizontal-nav" class="container pb-5">
            <div class="btn-prev" role="button" tabindex="0">
                <svg viewBox="0 0 24 24">
                    <path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z" fill="hsl(141, 15%, 50%)">
                    </path>
                </svg>
            </div>

            <div class="menu-wrap">
                <ul class="menu">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <li class="list-item">
                    <button value="'. $row['codserv'] .'" class="pill">'.$row['libserv'].'</button>
                </li>
            ';
        }
        // echo $output;
    } else {
        $output .= '
            <div class="text-center container pt-2 pb-2 mb-5">
                Aucun service
            </div>
        ';
        // echo $output;
    }

    $output .= '
        <div class="btn-next" role="button">
            <svg viewBox="0 0 24 24">
                <path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z" fill="hsl(141, 15%, 50%)">
                </path>
            </svg>
        </div>
    </div>
    ';

    echo $output;
}