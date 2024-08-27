<?php
// la variable action sera utilisé pour la gestion des opérations 
// qui auront lieu pour la gestion des différents modules, le 
// traitement d'une information sera gérée par les actions qui
// seront au préalable défini par le moyen d'envoi des données
$action = $_REQUEST['action'];

if (!empty($action)) {

    // on inclut les mutateurs pour la gestion des données étant
    // donné que l'approche utilisé est l'orienté objet
    include_once('../controllers/disponibiliteController.php');   
    

    // on importe notre classe connexion
    include_once('../controllers/cnx.php');

    // on instancie les classes, en créant les objets 
    $objDisp    = new disponibiliteControleur();
    $objSetDisp = new disponibiliteModel();    
}

// récupération de la disponibilité
if ($action == "getRow") {

    //On selectione toutes les lignes
    $statement = $objDisp->AfficherDispoTous();
    $res = $statement->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objDisp->AfficherDispoTous();
    $total_data = $data_count->fetchColumn();


    $output = '
        <nav class="nav nav-underline" aria-label="Secondary navigation">
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a class="nav-link" >
                    <button class="btn btn-outline-dark rounded-5" id="dispo-btn" value="'. $row['iddispo'].'"> 
                        '. $row['libdispo'].'
                        <i class="fa fa-calendar"></i>
                    </button>
                </a>
            ';
        }
        // echo $output;
    } 
        $output .= '
            </nav>
        ';
 
    echo $output;
}
