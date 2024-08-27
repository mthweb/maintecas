<?php
session_start();
// la variable action sera utilisé pour la gestion des opérations 
// qui auront lieu pour la gestion des différents modules, le 
// traitement d'une information sera gérée par les actions qui
// seront au préalable défini par le moyen d'envoi des données
$action = $_REQUEST['action'];

if (!empty($action)) {

    // on inclut les mutateurs pour la gestion des données étant
    // donné que l'approche utilisé est l'orienté objet
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
}


// Ce script permet l'insertion des nouveaux profiles prestataires dans la plateforme
// la contrainte doit toujours au préalable être égaler à une valeur pour que l'opération aboutisse
if ($action == "addNew") {
    // récupération des champs
    $session_maint   = htmlspecialchars($sessionMaintecas);
    $nom_prestataire = htmlspecialchars($_POST['nomprestataire']);
    $tel_prestataire = htmlspecialchars($_POST['telprestataire']);
    $mailprestataire = htmlspecialchars($_POST['mailprestataire']);
    $compte          = htmlspecialchars($_POST['compte']);

    // nous posons une contrainte qui rendra l'erreur 422 ssi les 
    //  champs de saisis sont null
    if ($session_maint == NULL || $nom_prestataire == NULL || $tel_prestataire == NULL || $compte == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Aucune valeur n\'a été trouvée'
        ];
    }

    // nous appelons les accesseurs afin d'exécuter notre requete d'insertion
    $objSetPrest->setSessionMaintecas($session_maint);
    $objSetPrest->setNomprestataire($nom_prestataire);
    $objSetPrest->setTelprestataire($tel_prestataire);
    $objSetPrest->setEmailprestataire($mailprestataire);
    $objSetPrest->setQualite('salut! bienvenu chez maintecas technologie. Veuillez définir vos qualités.');
    $objSetPrest->setZoneintervention('salut! bienvenu chez maintecas technologie. Veuillez configurer votre zone');
    $objSetPrest->setPresentation('salut! bienvenu chez maintecas technologie. Veuillez vous presenter.');
    $objSetPrest->setTypecompte($compte);
    $objSetPrest->setCategorie('1');
    $objSetPrest->setDisponibilite('1');
    $objSetPrest->setNote('0.00');
    

    // Exécution de l'adresse de la requête d'insertion
    $objPrest->creerPrestataire($objSetPrest);

    if ($objPrest) {
        // Nous créons une session à chaque nouvelle création de profile
        // en vue de permettre la gestion de la partie configuration compte
        // pour chaque compte qui vient d'être nouvellement ajouté 
        session_start();
        $_SESSION['compteactif'] = $mailprestataire;
        
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


// Ce script fais une modification des informations du compte utilisateur, le prestataire définit les 
// infors qui s'afficheront sur son proile
if ($action == "majConfigCompte") {
    // récupération des champs
    $prestata = htmlspecialchars($_POST['idprestataire']);
    $qualites = htmlspecialchars($_POST['qualite']);
    $zone     = htmlspecialchars($_POST['address']);
    $presenta = htmlspecialchars($_POST['presentation']);
    $dispo    = htmlspecialchars($_POST['dispo']);

    // nous posons une contrainte qui rendra l'erreur 422 ssi les 
    //  champs de saisis sont null
    if ($qualites == NULL || $zone == NULL || $presenta == NULL || $dispo == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Aucune valeur n\'a été trouvée'
        ];
    }

    // Nous assignons les données récupérées dans les variables au sein des mutateurs
    $objSetPrest->setQualite($qualites);
    $objSetPrest->setZoneintervention($zone);
    $objSetPrest->setPresentation($presenta);
    $objSetPrest->setDisponibilite($dispo);
    $objSetPrest->setIdprestataire($prestata);

    // Nous exécutons la requête de mise à jour de configuration des informations des utilisateurs
    $objPrest->modifierConfigurationPrestataire($objSetPrest);

    if ($objPrest) {
        // Nous créons une session à chaque nouvelle création de profile
        // en vue de permettre la gestion de la partie configuration compte
        // pour chaque compte qui vient d'être nouvellement ajouté 
        session_start();
        $_SESSION['token_account'] = $prestata;

    
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

// Nous implémentons un script pour l'authentification des prestataires dans leur compte
if ($action == "seConnecter") {
    // récupération des champs
    $username    = htmlspecialchars($_POST['username']);
    $password    = sha1(htmlspecialchars($_POST['password']));

    if ($username == NULL || $password == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Aucune valeur n\'a été trouvée'
        ];
    }

    // Nous allons géré deux, l'un permettra l'authentification via l'adresse mail 
    // l'autre cas via le numéro de téléphone
    if (filter_var($username,FILTER_VALIDATE_EMAIL)) {
        // Nous appellons la requête permettant l'authentification des prestataires
        $stmt = $objPrest->connexionPrestataire("emailprestataire",$username, $password);

        if($stmt->rowCount() > 0){
            // session_start();
            $donnees = $stmt->fetch();

            $_SESSION['idprestataire']     = $donnees['idprestataire'];
            $_SESSION['session_maintecas'] = $donnees['session_maintecas'];
            $_SESSION['nomprestataire']    = $donnees['nomprestataire'];
            $_SESSION['telprestataire']    = $donnees['telprestataire'];
            $_SESSION['emailprestataire']  = $donnees['emailprestataire'];
            $_SESSION['libtypecompte']     = $donnees['libtypecompte'];

            $res = [
                'status' => 200,
                'message' => "authentification ok!"
            ];
            echo json_encode($res);
            return false;

        }else{
            $res = [
                'status' => 300,
                'message' => "Ce compte n'existe pas. Veuillez vous inscrire en tant technicien!"
            ];
            echo json_encode($res);
            return false;
        }
    }else{
        // Nous appellons la requête permettant l'authentification des prestataires
        $stmt = $objPrest->connexionPrestataire("telprestataire",$username, $password);

        if($stmt->rowCount() > 0){
            session_start();
            $donnees = $stmt->fetch();

            $_SESSION['idprestataire']     = $donnees['idprestataire'];
            $_SESSION['session_maintecas'] = $donnees['session_maintecas'];
            $_SESSION['nomprestataire']    = $donnees['nomprestataire'];
            $_SESSION['telprestataire']    = $donnees['telprestataire'];
            $_SESSION['emailprestataire']  = $donnees['emailprestataire'];
            $_SESSION['libtypecompte']     = $donnees['libtypecompte'];

        }else{
            $res = [
                'status' => 300,
                'message' => "Ce compte n'existe pas. Veuillez vous inscrire en tant technicien!"
            ];
            echo json_encode($res);
            return false;
        }
    }

    

}

// ce script gère la configuration des modes de paiements qui seront sélectionnés par l'utilisateur
if($action == "addModePaiement"){
    // récupération des champs
    $prestataire   = htmlspecialchars($_POST['prestataire']);
    $id_marchand   = htmlspecialchars($_POST['idmarchand']);
    $pass_marchand = htmlspecialchars($_POST['passmarchand']);

    if ($prestataire == NULL || $id_marchand == NULL || $pass_marchand == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Aucune valeur n\'a été trouvée'
        ];
    }

    // appel des mutateurs et accesseurs
    $objSetSelect->setPrestataire($prestataire);
    $objSetSelect->setMarchantId($id_marchand);
    $objSetSelect->setMarchantPass($pass_marchand);

    // exécution de la requête 
    $objSelect->creerSelection($objSetSelect);

    if ($objSelect) {
        
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

// script de validation des interventions, la logique implémentée suppose que la commande utilise deux 
// champs dont etat qui est un boolèen qui reçoit 0 et 1 puis statut une chaine qui dit si l'intervention
// est validée ou pas
if ($action == "setIntervention") {
    # récupération des valeurs
    $intervention = htmlspecialchars($_POST['intervention_key']);

    if ($intervention == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Aucune valeur n\'a été trouvée'
        ];
    }

    // appel des mutateurs et accesseurs
    $objSetInter->setEtat('1');
    $objSetInter->setStatut('validée');
    $objSetInter->setIdInter($intervention);
    // exécution de la requête 
    $objInter->validerIntervention($objSetInter);


    if ($objInter) {
        
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


if ($action == 'getRowSelection') {
    //Déclaration des variables
    $_POST['page'] ?? 1;
    $limite = 5;
    $page = 1;

    if ($_POST['page'] ?? 1 > 1) {
        $start = (($_POST['page'] - 1) * $limite);
        echo 'Page ' . $page  = $_POST['page'];
    } else {
        $start = 0;
    }

    //On selectione toutes les lignes
    $statement = $objSelect->AfficherSelection($_SESSION['idprestataire'], $start, $limite);
    $result = $statement->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objSelect->CompterSelection($_SESSION['idprestataire']);
    $total_data = $data_count->fetchColumn();


    $output = '
    <label class="">' . $total_data . ' compte(s) marchand</label>
    <hr>
    <table class="table table-responsive table table-borderless table-condensed" id="listcategorie">
        <thead class="text-muted fw-lighter">
            <tr>
                <th class="col-md-2"></th>
                <th class="col-md-2">Marchand ID</th>
                <th class="col-md-2">Marchand mot de passe</th>
                <th class="col-md-2">Action</th>
            </tr>
        </thead>
        
        
    ';
    if ($total_data > 0) {
        foreach ($result as $row) {
            $output .= '
            <tbody class="bg-transparent">
                <tr class="border-bottom">

                    <td></td>   
                    <td>' . $row['MerchantID']  .   '</td>   
                    <td>' . $row['MerchantPassword']  .   '</td>   
                    <td>
                        <button value="'.$row['id_selection'].'" class="btn btn-light rounded-5">
                            <i class="fa fa-trash-o"></i>
                        </button>

                        <button value="'.$row['id_selection'].'" class="btn btn-light rounded-5">
                            <i class="fa fa-edit-o"></i>
                        </button>
                    </td>   
                             
                </tr>
            </tbody>
            ';
        }
    } else {
        $output .= '
        <div class="container text-center mx-auto">
            Aucune passerelle de paiement trouvée
        </div>
        ';
    }

    $output .= '
    </table>
    <br>
    <div class="text-center ">
        <ul class="pagination justify-content-center">
    ';
    $total_links = ceil($total_data / $limite);

    $previous_link = '';
    $next_link = '';
    $page_link = '';

    if ($total_links > 4) {
        if ($page < 5) {
            for ($count = 1; $count <= 5; $count++) {
                $page_array[] = $count;
            }

            $page_array[] = '...';
            $page_array[] = $total_links;
        } else {
            $end_limite = $total_links - 5;

            if ($page > $end_limite) {
                $page_array[] = 1;
                $page_array[] = '...';

                for ($count = $end_limite; $count <= $total_links; $count++) {
                    $page_array[] = $count;
                }
            } else {
                $page_array[] = 1;
                $page_array[] = '...';

                for ($count = $page - 1; $count <= $page + 1; $count++) {
                    $page_array[] = $count;
                }

                $page_array[] = '...';
                $page_array[] = $total_links;
            }
        }
    } else {
        for ($count = 1; $count <= $total_links; $count++) {
            $page_array[] = $count;
        }
    }

    for ($count = 0; $count < count($page_array); $count++) {

        if ($page == $page_array[$count]) {
            $page_link .= '
                <li class="page-item active">
                    <a class="page-link" href="#">
                        ' . $page_array[$count] . '
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            ';

            $previous_id = $page_array[$count] - 1;

            if ($previous_id > 0) {
                $previous_link = '
                <li class="page-item">
                    <a href="javascript:void(0)" data-page_number="' . $previous_id . '" class="page-link">
                        Previous
                    </a>
                </li>';
            } else {
                $previous_link = '
                    <li class="page-item disabled">
                        <a href="#" class="page-link">Previous</a>
                    </li>
                ';
            }

            $next_id = $page_array[$count] + 1;

            if ($next_id >= $total_links) {
                $next_link = '
                    <li class="page-item disabled">
                        <a href="#" class="page-link">Next</a>
                    </li>
                ';
            } else {
                $next_link = '
                    <li class="page-item">
                        <a href="javascript:void(0)" data-page_number="' . $next_id . '" class="page-link">Next</a>
                    </li>
                ';
            }
        } else {
            if ($page_array[$count] == "...") {
                $page_link .= '
                    <li class="page-item disabled">
                        <a href="#" class="page-link">...</a>
                    </li>
                ';
            } else {
                $page_link .= '
                    <li class="page-item">
                        <a href="javascript:void(0)" data-page_number="' . $page_array[$count] . '" class="page-link">
                            ' . $page_array[$count] . '
                        </a>
                    </li>
                ';
            }
        }
    }

    $output .= $previous_link . $page_link . $next_link;

    echo $output;

    $output .= '
        </ul>
    </div>   
    ';

    echo $output;
}


// ce script permet de récupérer les interventions de l'utilisateur concerné
if ($action == "getInterventionCompte") {
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
    $statement = $objInter->AfficherInterventionParCompte($_SESSION['idprestataire'], $start, $limite);
    $result = $statement->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objInter->AfficherInterventionParCompte($_SESSION['idprestataire'], $start, $limite);
    $total_data = $data_count->fetchColumn();


    $output = '
    <label class=""></label>
    ';
    if ($total_data > 0) {
        foreach ($result as $row) {
            $output .= '
            <a href="../vue/details.php?id=' . $row['idinter']  . '&info='. sha1($row['idusager']) .'" class="list-group-item list-group-item-action py-3 lh-tight">
                <div class="d-flex w-100 align-items-center">
                    <img src="../assets/index.png" width="50" class="shadow rounded-circle me-3 mb" alt="">
                    <div class="mt-2">
                        <strong class="mb-1">' . $row['prenomusager']  . ' ' .$row['nomusager']. '</strong>
                        
                        <div class="col-12 mb-1 small">
                            Intervention à ' . $row['lieu_intervention']  .   ',
                            à partir de ' . $row['date_intervention']  .   '
                        </div>
                        ';

                        $output.='
                        <td>
                            '; if ($row['etat'] == "0") { 
                                $output.= "<div class='text-danger'>En attente...</div>";
                            }else{
                                $output.= "<div class='text-primary'>Approuvée</div>";
                            }';
                        </td>
                        ';
                        $output.='
                    </div>
                </div>
            </a>
            ';
        }
    } else {
        $output .= '
        <div class="container text-center mx-auto pt-5 pb-5">
            Aucune intervention retrouvée
        </div>
        ';
        
    }


    echo $output;

    $output .= '
        </ul>
    </div>   
    ';


}