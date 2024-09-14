<?php
// ============================================= transaction getRow affichage des valeurs par flitre ==========================================//

// on débute une session
session_start();
// la variable action sera utilisé pour la gestion des opérations 
// qui auront lieu pour la gestion des différents modules, le 
// traitement d'une information sera gérée par les actions qui
// seront au préalable défini par le moyen d'envoi des données
$action = $_REQUEST['action'];

// On initialise une variable $method et on l'affecte
// la veleur de la super globase $_SERVER["REQUEST_METHOD"]
// afin qu'il puisse gérer les méthodes entrées par les utilisateurs 
// $method = $_REQUEST['REQUEST_METHOD'];

if (!empty($action)) {

    // on inclut les mutateurs pour la gestion des données étant
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

}


// On écrit le script pour la recherche des données
if ($action == "rechercherService" && isset($_POST['input'])) {
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

    $input = htmlspecialchars($_POST['input']);

    //On selectione toutes les lignes
    $stmt = $objKey->rechercherMot($input);
    $res = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objKey->compterRechercheMot($input);
    $total_data = $data_count->fetchColumn();

    // initialisation des variables pour la récupération des données 
    // du résultat des recherches 
    $outputAll  ="";
    $technicien ="";
    $ouvirer    ="";
    $entreprise ="";
    $zone_interv="";
    $horaire    ="";
    $avis       ="";

    $output = '';
    if ($total_data > 0) {
                
        foreach ($res as $row) {
            // Nous posons une logique qui implique la récupération du mot clé recherché
            $getKey = $row['key'];
                        
            $outputTechnicien = '';
            $outputOuvrier = '';
            $outputEntreprise = '';

            $stmt_res = $objRend->AfficherServiceRendu($getKey,"Technicien",$start, $limite);
            $fetch_res = $stmt_res->fetchAll();

            foreach ($fetch_res as $rowData) {
                $outputTechnicien .= ' 
                    <div class="card swiper-slide">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <img src="../assets/profile_client/index.png" border="2" class="rounded-circle border-primary" width="70" height="70" alt="">
                            </div>
                                                                                                                   
                            <div class="mb-3">
                                <h5 class="fw-bold small">Nom prestataire</h5>
                            </div>
                            
                            <div class="mb-2">
                                <h5 class="small">Technicien</h5>
                            </div>

                            <div class="mb-3">
                                <a href="" class="btn btn-primary rounded-5">
                                    Contacter
                                </a>
                            </div>
                        </div>
                    </div>
                ';
            }      

            $stmt_res = $objRend->AfficherServiceRendu($getKey,"Ouvrier",$start, $limite);
            $fetch_res = $stmt_res->fetchAll();
            foreach ($fetch_res as $rowData) {
                $outputOuvrier .= ' 
                    <div class="d-flex text-muted pt-3 border-bottom">
                        <a href="../vue/profile-view.php?id='. $rowData['idprestataire'].'&text='.sha1($rowData['idprestataire']).'">
                            <img src="../../assets/profile_client/index.png" width="50" height="50" class="mb-4 me-2" alt="">
                        </a>
                                    
                        <p class="pb-3 mb-0 small lh-sm">
                            <strong class="d-block text-gray-dark">' . $rowData['nomprestataire']  . '</strong>
                            '.$rowData['presentation'].'
                        </p>
                    </div>
                ';
            }

            $stmt_res_ent = $objEff->AfficherServiceEffectuer($getKey,$start, $limite);

            if($stmt_res_ent->rowCount() > 0){
                $fetch_res_ent = $stmt_res_ent->fetchAll();

                foreach ($fetch_res_ent as $rowDataEnt) {
                $outputEntreprise .= ' 
                    <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
                        <div class="d-flex w-100 align-items-center ">
                            <img src="assets/profile_client/index.png" class="rounded-circle me-2" width="50" class="me-2" alt="">
                            <span class="mb-1">
                                <strong>nom entreprise</strong>
                                <div class="col-10 mb-1 small">services</div>
                            </span>
                        </div>
                    </a>
                ';
                }
            }else{
                $outputEntreprise .='
                    <div class="text-center">
                        Aucune donnée information <br> ne correspond à votre demande
                    </div>
                ';
            }
            

        }
                
    } 
    $response = array(
        "tout_profile"=>$outputAll,
        "technicien"=>$outputTechnicien,
        "ouvrier"=>$outputOuvrier,
        "entrepirise"=>$outputEntreprise
    );

    echo json_encode($response);

}


if ($action == "saisirBesoin") {
    $_POST['page'] ?? 1;
    $limite = 5;
    $page = 1;

    if ($_POST['page'] ?? 1 > 1) {
        $start = (($_POST['page'] - 1) * $limite);
        echo 'Page ' . $page  = $_POST['page'];
    } else {
        $start = 0;
    }


    $input = htmlspecialchars($_POST['input']);

    
    //On selectione toutes les lignes
    $stmt = $objRend->AfficherServiceRenduTousParZone($_SESSION['input'], $input, $start, $limite);

    $suggession = array();

    while ($row = $res = $stmt->fetchAll()) {
        $suggession[] = $row['key']. ' - '. $row['word'];
    }

    if ($suggession) {
        $res = [
            'status' => 200,
            'message' => "opération effectuée avec succès"
        ];
        echo json_encode($suggession);
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

// Nous récupérons les données de recherche par la commune
if ($action == "communeGet") {

    $_POST['page'] ?? 1;
    $limite = 5;
    $page = 1;

    if ($_POST['page'] ?? 1 > 1) {
        $start = (($_POST['page'] - 1) * $limite);
        echo 'Page ' . $page  = $_POST['page'];
    } else {
        $start = 0;
    }


    $input = htmlspecialchars($_POST['commune']);

    
    //On selectione toutes les lignes
    $stmt = $objRend->AfficherServiceRenduTousParZone($_SESSION['input'], $input, $start, $limite);
    $res  = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objRend->AfficherServiceRenduTousParZone($_SESSION['input'],$input,$start, $limite);
    $total_data = $data_count->fetchColumn();
    
    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a href="./technicien-profile.php?id='.$row['idprestataire'].'&info='.$row['libserv'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
                            <div class="col-10 mb-1 small">'.$row['nomprestataire'].'</div>
                        </span>
                    </div>
                </a>
            ';
        }
        // echo $output;

        $output.='
            <div class="mt-0">
                <a href="" class="btn btn-light rounded-0 col-12 col-md-12">
                    voir tout
                </a>
            </div>
        ';
    } else {
        $output .= '
            <div class="text-center container pt-5 pb-5 mb-5">
                Aucune information pour cette zone
            </div>
        ';
        // echo $output;
    }

    $output .= '
        </div>
    </div>
    ';

    echo $output;
}


// Nous récupérons les données de recherche par la ville
if ($action == "villeGet") {

    $_POST['page'] ?? 1;
    $limite = 5;
    $page = 1;

    if ($_POST['page'] ?? 1 > 1) {
        $start = (($_POST['page'] - 1) * $limite);
        echo 'Page ' . $page  = $_POST['page'];
    } else {
        $start = 0;
    }


    $input = htmlspecialchars($_POST['ville']);

    
    //On selectione toutes les lignes
    $stmt = $objRend->AfficherServiceRenduTousParZone($_SESSION['input'], $input, $start, $limite);
    $res  = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objRend->AfficherServiceRenduTousParZone($_SESSION['input'],$input,$start, $limite);
    $total_data = $data_count->fetchColumn();
    
    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a  href="./technicien-profile.php?id='.$row['idprestataire'].'&info='.$row['libserv'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
                            <div class="col-10 mb-1 small">'.$row['nomprestataire'].'</div>
                        </span>
                    </div>
                </a>
            ';
        }
        // echo $output;

        $output.='
            <div class="mt-0">
                <a href="" class="btn btn-light rounded-0 col-12 col-md-12">
                    voir tout
                </a>
            </div>
        ';
    } else {
        $output .= '
            <div class="text-center container pt-5 pb-5 mb-5">
                Aucune information pour cette zone
            </div>
        ';
        // echo $output;
    }

    $output .= '
        </div>
    </div>
    ';

    echo $output;
}

// Nous récupérons les données de recherche par la disponibilité
if ($action == "dispoGet") {

    $_POST['page'] ?? 1;
    $limite = 5;
    $page = 1;

    if ($_POST['page'] ?? 1 > 1) {
        $start = (($_POST['page'] - 1) * $limite);
        echo 'Page ' . $page  = $_POST['page'];
    } else {
        $start = 0;
    }


    $input = htmlspecialchars($_POST['dispo']);

    
    //On selectione toutes les lignes
    $stmt = $objRend->AfficherServiceRenduTousParZoneParDisponibilite($_SESSION['input'], $_SESSION['address'], $input, $start, $limite);
    $res  = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objRend->AfficherServiceRenduTousParZoneParDisponibilite($_SESSION['input'],$_SESSION['address'], $input ,$start, $limite);
    $total_data = $data_count->fetchColumn();
    
    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a href="./technicien-profile.php?id='.$row['idprestataire'].'&info='.$row['libserv'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
                            <div class="col-10 mb-1 small">'.$row['nomprestataire'].'</div>
                        </span>
                    </div>
                </a>
            ';
        }
        // echo $output;

        $output.='
            <div class="mt-0">
                <a href="" class="btn btn-light rounded-0 col-12 col-md-12">
                    voir tout
                </a>
            </div>
        ';
    } else {
        $output .= '
            <div class="text-center container pt-5 pb-5 mb-5">
                Aucune information pour cette zone
            </div>
        ';
        // echo $output;
    }

    $output .= '
        </div>
    </div>
    ';

    echo $output;
}

// Nous récupérons les données de recherche par note
if ($action == "noteGet") {

    $_POST['page'] ?? 1;
    $limite = 5;
    $page = 1;

    if ($_POST['page'] ?? 1 > 1) {
        $start = (($_POST['page'] - 1) * $limite);
        echo 'Page ' . $page  = $_POST['page'];
    } else {
        $start = 0;
    }


    $input = htmlspecialchars($_POST['note']);

    
    //On selectione toutes les lignes
    $stmt = $objRend->AfficherServiceRenduTousParZoneParNote($_SESSION['input'], $_SESSION['address'], $input, $start, $limite);
    $res  = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objRend->AfficherServiceRenduTousParZoneParNote($_SESSION['input'],$_SESSION['address'], $input ,$start, $limite);
    $total_data = $data_count->fetchColumn();
    
    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a href="./technicien-profile.php?id='.$row['idprestataire'].'&info='.$row['libserv'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
                            <div class="col-10 mb-1 small">'.$row['nomprestataire'].'</div>
                        </span>
                    </div>
                </a>
            ';
        }
        // echo $output;

        $output.='
            <div class="mt-0">
                <a href="" class="btn btn-light rounded-0 col-12 col-md-12">
                    voir tout
                </a>
            </div>
        ';
    } else {
        $output .= '
            <div class="text-center container pt-5 pb-5 mb-5">
                Aucune information pour cette zone
            </div>
        ';
        // echo $output;
    }

    $output .= '
        </div>
    </div>
    ';

    echo $output;
}

// Nous récupérons les données de recherche par catégorie
if ($action == "categorieGet") {

    $_POST['page'] ?? 1;
    $limite = 5;
    $page = 1;

    if ($_POST['page'] ?? 1 > 1) {
        $start = (($_POST['page'] - 1) * $limite);
        echo 'Page ' . $page  = $_POST['page'];
    } else {
        $start = 0;
    }


    $input = htmlspecialchars($_POST['cat']);

    
    //On selectione toutes les lignes
    $stmt = $objRend->AfficherServiceRenduTousParZoneParCategorie($_SESSION['input'], $_SESSION['address'], $input, $start, $limite);
    $res  = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objRend->AfficherServiceRenduTousParZoneParCategorie($_SESSION['input'], $_SESSION['address'], $input, $start, $limite);
    $total_data = $data_count->fetchColumn();
    
    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a href="./technicien-profile.php?id='.$row['idprestataire'].'&info='.$row['libserv'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
                            <div class="col-10 mb-1 small">'.$row['nomprestataire'].'</div>
                        </span>
                    </div>
                </a>
            ';
        }
        // echo $output;

        $output.='
            <div class="mt-0">
                <a href="" class="btn btn-light rounded-0 col-12 col-md-12">
                    voir tout
                </a>
            </div>
        ';
    } else {
        $output .= '
            <div class="text-center container pt-5 pb-5 mb-5">
                Aucune information pour cette zone
            </div>
        ';
        // echo $output;
    }

    $output .= '
        </div>
    </div>
    ';

    echo $output;
}

// réupération des données avec filtre de données 
if ($action == "prestataireGet") {

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

    $input = htmlspecialchars($_POST['service']);

    //On selectione toutes les lignes
    $statement = $objRend->AfficherServiceRenduParservice("Technicien", $input ,$start, $limite);
    $res = $statement->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objRend->AfficherServiceRenduParservice("Technicien", $input ,$start, $limite);
    $total_data = $data_count->fetchColumn();


    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <button  value="'.$row['idprestataire'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img avatar="'.$row['nomprestataire'].'" class="rounded-circle me-2" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
                            <div class="col-10 mb-1 small">'.$row['nomprestataire'].'</div>
                        </span>
                    </div>
                </button>
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

// Nous récupérons les données de recherche par catégorie
if ($action == "serviceGetAll") {

    $_POST['page'] ?? 1;
    $limite = 5;
    $page = 1;

    if ($_POST['page'] ?? 1 > 1) {
        $start = (($_POST['page'] - 1) * $limite);
        echo 'Page ' . $page  = $_POST['page'];
    } else {
        $start = 0;
    }


    $input = htmlspecialchars($_POST['serv']);

    
    //On selectione toutes les lignes
    $stmt = $objRend->AfficherServiceRenduParCode($input,"technicien", $start, $limite);
    $res  = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objRend->AfficherServiceRenduParCode($input,"technicien", $start, $limite);
    $total_data = $data_count->fetchColumn();
    
    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a href="./technicien-profile.php?id='.$row['idprestataire'].'&info='.$row['libserv'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
                            <div class="col-10 mb-1 small">'.$row['nomprestataire'].'</div>
                        </span>
                    </div>
                </a>
            ';
        }
        // echo $output;

        $output.='
            <div class="mt-0">
                <a href="" class="btn btn-light rounded-0 col-12 col-md-12">
                    voir tout
                </a>
            </div>
        ';
    } else {
        $output .= '
            <div class="text-center container pt-5 pb-5 mb-5">
                Aucune information pour cette zone
            </div>
        ';
        // echo $output;
    }

    $output .= '
        </div>
    </div>
    ';

    echo $output;
}

// ============================================= transaction getRow affichage des valeurs par défaut ==========================================//

// Nous récupérons les données des villes
if($action == "getRowVille"){
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

    // Déclaration de la variable qui gère la transaction par défaut nous définissons la 
    // valeur par une province, la gestion est momentanément statique
    $input = "Kinshasa";

    //On selectione toutes les lignes
    $statement = $objRend->AfficherServiceRenduTousParZone($_SESSION['input'], $input, $start, $limite);
    $res = $statement->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objRend->AfficherServiceRenduTousParZone($_SESSION['input'], $input, $start, $limite);
    $total_data = $data_count->fetchColumn();

    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a  href="./technicien-profile.php?id='.$row['idprestataire'].'&info='.$row['libserv'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
                            <div class="col-10 mb-1 small">'.$row['nomprestataire'].'</div>
                        </span>
                    </div>
                </a>
            ';
        }
        echo $output;
    } else {
        $output .= '
            <div class="container text-center pt-5 pb-5">
                Aucune information pour cette zone
            </div>
        ';
        echo $output;
    }

    $output .= '
        </div>
    </div>
    ';

}

// Nous récupérons les données des communes
if($action == "getRowCommune"){ 
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

   // Déclaration de la variable qui gère la transaction par défaut nous définissons la 
   // valeur par une province, la gestion est momentanément statique
   $input = "Matete";

   //On selectione toutes les lignes
   $statement = $objRend->AfficherServiceRenduTousParZone($_SESSION['input'], $input, $start, $limite);
   $res = $statement->fetchAll();

   //On compte le nombre de ligne
   $data_count = $objRend->AfficherServiceRenduTousParZone($_SESSION['input'], $input, $start, $limite);
   $total_data = $data_count->fetchColumn();

   $output = '
       <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
           <div class="list-group list-group-flush border-bottom scrollarea">
   ';
   if ($total_data > 0) {
       foreach ($res as $row) {
           $output .= '
               <a  href="./technicien-profile.php?id='.$row['idprestataire'].'&info='.$row['libserv'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                   <div class="d-flex w-100 align-items-center ">
                       <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                       <span class="mb-1">
                           <strong>'.$row['nomprestataire'].'</strong>
                           <div class="col-10 mb-1 small">'.$row['nomprestataire'].'</div>
                       </span>
                   </div>
               </a>
           ';
       }
       echo $output;
   } else {
       $output .= '
           <div class="container text-center pt-5 pb-5">
               Aucune information pour cette zone
           </div>
       ';
       echo $output;
   }

   $output .= '
       </div>
   </div>
   ';

}

// Nous récupérons les données des disponibilités
if($action == "getRowDispo"){
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

   // Déclaration de la variable qui gère la transaction par défaut nous définissons la 
   // valeur par une province, la gestion est momentanément statique
   $input = "3";

   //On selectione toutes les lignes
   $statement = $objRend->AfficherServiceRenduTousParZoneParDisponibilite($_SESSION['input'], $_SESSION['address'], $input, $start, $limite);
   $res = $statement->fetchAll();

   //On compte le nombre de ligne
   $data_count =  $objRend->AfficherServiceRenduTousParZoneParDisponibilite($_SESSION['input'], $_SESSION['address'], $input, $start, $limite);
   $total_data = $data_count->fetchColumn();

   $output = '
       <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
           <div class="list-group list-group-flush border-bottom scrollarea">
   ';
   if ($total_data > 0) {
       foreach ($res as $row) {
           $output .= '
               <a  href="./technicien-profile.php?id='.$row['idprestataire'].'&info='.$row['libserv'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                   <div class="d-flex w-100 align-items-center ">
                       <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                       <span class="mb-1">
                           <strong>'.$row['nomprestataire'].'</strong>
                           <div class="col-10 mb-1 small">'.$row['nomprestataire'].'</div>
                       </span>
                   </div>
               </a>
           ';
       }
       echo $output;
   } else {
       $output .= '
           <div class="container text-center pt-5 pb-5">
               Aucune information pour cette zone
           </div>
       ';
       echo $output;
   }

   $output .= '
       </div>
   </div>
   ';

}

// Nous récupérons les données des notes
if($action == "getRowNote"){
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

    // Déclaration de la variable qui gère la transaction par défaut nous définissons la 
    // valeur par une province, la gestion est momentanément statique
    $input = "10";

    //On selectione toutes les lignes
    $statement = $objRend->AfficherServiceRenduTousParZoneParNote($_SESSION['input'], $_SESSION['address'], $input, $start, $limite);
    $res = $statement->fetchAll();

    //On compte le nombre de ligne
    $data_count =  $objRend->AfficherServiceRenduTousParZoneParNote($_SESSION['input'], $_SESSION['address'], $input, $start, $limite);
    $total_data = $data_count->fetchColumn();

    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a  href="./technicien-profile.php?id='.$row['idprestataire'].'&info='.$row['libserv'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
                            <div class="col-10 mb-1 small">'.$row['nomprestataire'].'</div>
                        </span>
                    </div>
                </a>
            ';
        }
        echo $output;
    } else {
        $output .= '
            <div class="container text-center pt-5 pb-5">
                Aucune information pour cette zone
            </div>
        ';
        echo $output;
    }

    $output .= '
        </div>
    </div>
    ';

}

// Nous récupérons les données des villes
if($action == "getRowCat"){
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

    // Déclaration de la variable qui gère la transaction par défaut nous définissons la 
    // valeur par une province, la gestion est momentanément statique
    $input = "Professionnelle";

    //On selectione toutes les lignes
    $statement = $objRend->AfficherServiceRenduTousParZoneParCategorie($_SESSION['input'], $_SESSION['address'], $input, $start, $limite);
    $res = $statement->fetchAll();

    //On compte le nombre de ligne
    $data_count =  $objRend->AfficherServiceRenduTousParZoneParCategorie($_SESSION['input'], $_SESSION['address'], $input, $start, $limite);
    $total_data = $data_count->fetchColumn();

    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a  href="./technicien-profile.php?id='.$row['idprestataire'].'&info='.$row['libserv'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
                            <div class="col-10 mb-1 small">'.$row['nomprestataire'].'</div>
                        </span>
                    </div>
                </a>
            ';
        }
        echo $output;
    } else {
        $output .= '
            <div class="container text-center pt-5 pb-5">
                Aucune information pour cette zone
            </div>
        ';
        echo $output;
    }

    $output .= '
        </div>
    </div>
    ';

}

// Récupération des données des différents profils utilisateurs
if ($action == "getRowPrest") {

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
    $statement = $objRend->AfficherServiceRenduParCompte("Technicien",$start, $limite);
    $res = $statement->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objRend->AfficherServiceRenduParCompte("Technicien",$start, $limite);
    $total_data = $data_count->fetchColumn();


    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <button  value="'.$row['idprestataire'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img avatar="'.$row['nomprestataire'].'" class="rounded-circle me-2" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
                            <div class="col-10 mb-1 small">'.$row['nomprestataire'].'</div>
                        </span>
                    </div>
                </button>
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


// Nous implémentons un script qui permettra de récupérer les informations lorsqu'on saisit 
// l'un des mots clés qui est stocké dans la table keyword, cette logique permettra la récupération
// par mot clé des profils utilisateurs 
if ($action == 'rechercheParSuggestion') {
    # code...
    $_POST['page'] ?? 1;
    $limite = 5;
    $page = 1;

    if ($_POST['page'] ?? 1 > 1) {
        $start = (($_POST['page'] - 1) * $limite);
        $page  = $_POST['page'];
    } else {
        $start = 0;
    }

    // récupération de la valeur saisie dans la variable input
    $input = htmlspecialchars($_POST['input']);

    //On selectione toutes les lignes
    $stmt = $objRend->AfficherProfileParDomaine($input, $start, $limite);
    $res  = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objRend->AfficherProfileParDomaine($input, $start, $limite);
    $total_data = $data_count->fetchColumn();
    
    $output = '<div class="row">';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <div class="col-md-6 mb-3">
                    <div class="card profile-card border-0">
                        <div class="card-body text-start">
                            <div class="profile-img">
                                <img src="../../assets/index.png" width="80" alt="Photo de profil" class="rounded-circle">
                                <span class="badge bg-danger d-block w-75">
                                    PRO
                                    <i class="fa fa-plus-circle"></i>
                                    <i class="fa fa-plus-circle"></i>
                                </span>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title fw-bold text-capitalize mt-3">'. $row['nomprestataire'] .'</h5>
                                    <p class="text-muted small">'. $row['description'] .'</p>
                                </div>

                                <div class="rating-container">
                                    <div class="main-circle">
                                        <span class="rating">'. number_format($row['note'],1) .'</span>
                                        <div class="star-circle">
                                            <span class="star">★</span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex mb-3 pb-3 border-bottom">
                                <div class="online-status text-start">
                                    <span class="status-dot"></span>
                                    <span class="status-text">Disponible</span>
                                </div>
                            
                                
                            </div>

                            <p class="card-text small" style="text-align: justify;">
                               '. $row['presentation'] .'
                            </p>
                            <div class="text-start" style="overflow-y: scroll; height:9em;scrollbar-color:rgb(100,100,100) rgb(45,45,45); scrollbar-width: thin;">
                                <div class="col d-flex align-items-start small">
                                    
                                    <span class="bg-light p-2 me-1 rounded-circle"><img src="../../assets/icones/map.png" width="20" alt=""></span> 
                                    <div>
                                        <p>'. $row['zone_intervention'] .'</p>
                                    </div>
                                </div>

                                <p class="small">
                                    <span class="bg-light p-2 rounded-circle"><img src="../../assets/icones/badge.png" width="20" alt=""></span> 
                                    <i class="fas fa-dollar-sign"></i> Prix discutable
                                </p>
                                
                                <p class="small">
                                    <span class="bg-light p-2 rounded-circle"><img src="../../assets/icones/trophy.png" width="20" alt=""></span> 
                                    8 projets réalisés</p>
                            </div>
                            
                            <div class="text-center">
                                <a href="../vue/profile.php?id='. $row['idprestataire'] .'&text='. sha1($row['nomprestataire']) .'&=info='. $row['nomprestataire'] .'" class="btn btn-dark mt-3">Voir le profil complet</a>
                            </div>
                        </div>
                    </div>

                    <hr class="w-100 d-md-none">
                </div>
            ';
        }
        // echo $output;

        $output.='
        </div>
        
            <div class="mt-0 text-center mt-5">
                <a href="" class="btn btn-light rounded-0 rounded-5 pt-3 pb-3">
                    Afficher plus
                </a>
            </div>
        ';
    } else {
        $output .= '
            <div class="text-center container pt-5 pb-5 mb-5">
                Aucune information pour cette requête
            </div>
        ';
        // echo $output;
    }

    $output .= '';

    echo $output;
}

// Nous récupérons des profiles par défaut
if ($action == 'rechercheProfileAll') {
    # code...
    $_POST['page'] ?? 1;
    $limite = 5;
    $page = 1;

    if ($_POST['page'] ?? 1 > 1) {
        $start = (($_POST['page'] - 1) * $limite);
        $page  = $_POST['page'];
    } else {
        $start = 0;
    }

    // récupération de la valeur saisie dans la variable input
    // $input = htmlspecialchars($_POST['input']);

    //On selectione toutes les lignes
    $stmt = $objRend->AfficherRendre($start, $limite);
    $res  = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objRend->AfficherRendre($start, $limite);
    $total_data = $data_count->fetchColumn();
    
    $output = '<div class="row">';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <div class="col-md-6 mb-3">
                    <div class="card profile-card  border-0">
                        <div class="card-body text-start">
                           <div class="d-flex">
                                <div class="profile-img">
                                    <img src="../../assets/index.png" width="60" height="60" alt="Photo de profil" class="rounded-circle">
                                    <span class="badge bg-danger d-block w-75">
                                        PRO
                                        <i class="fa fa-plus-circle"></i>
                                        <i class="fa fa-plus-circle"></i>
                                    </span>
                                </div>
                            
                                <div class="d-flex justify-content-between">
                                    <div class="me-5">
                                        <h5 class="card-title fw-bold text-capitalize mt-3">'. $row['nomprestataire'] .'</h5>
                                        <p class="text-muted small">'. $row['description'] .'</p>

                                        <div class="d-flex mb-0 pb-0 border-bottom">
                                            <div class="online-status text-start">
                                                <span class="status-dot"></span>
                                                <span class="status-text">Disponible</span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="rating-container">
                                        <div class="main-circle">
                                            <span class="rating">'. number_format($row['note'],1) .'</span>
                                            <div class="star-circle">
                                                <span class="star">★</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           </div>



                            <p class="card-text small" style="text-align: justify;">
                               ';
                               
                               $presentation = $row['presentation']; 

                                // Définir la longueur minimum de caractères à afficher
                                $longueur_min = 50;

                                // Si le texte est plus long que 50 caractères, le tronquer
                                if (strlen($presentation) > $longueur_min) {
                                    // Afficher les 50 premiers caractères suivis de "..."
                                    $affichage = substr($presentation, 0, $longueur_min) . '...';
                                    // Ajouter un bouton ou lien "Voir plus" pour afficher tout le texte
                                    $output .= '<p>' . $affichage . ' <a href="#" class="voir-plus" data-presentation="' . $presentation . '">Voir plus</a></p>';
                                } else {
                                    // Si le texte est déjà plus court que 50 caractères, l'afficher normalement
                                    $output .=  '<p>' . $presentation . '</p>';
                                }
                               
                               $output .='
                            </p>
                            <div class="text-start" style="overflow-y: scroll; height:9em;scrollbar-color:rgb(100,100,100) rgb(45,45,45); scrollbar-width: thin;">
                                <div class="col d-flex align-items-start small">
                                    
                                    <span class="bg-light p-2 me-1 rounded-circle"><img src="../../assets/icones/map.png" width="20" alt=""></span> 
                                    <div>
                                        <p>'. $row['zone_intervention'] .'</p>
                                    </div>
                                </div>

                                <p class="small">
                                    <span class="bg-light p-2 rounded-circle"><img src="../../assets/icones/badge.png" width="20" alt=""></span> 
                                    <i class="fas fa-dollar-sign"></i> Prix discutable
                                </p>
                                
                                <p class="small">
                                    <span class="bg-light p-2 rounded-circle"><img src="../../assets/icones/trophy.png" width="20" alt=""></span> 
                                    8 projets réalisés</p>
                            </div>
                            
                            <div class="text-center">
                                <a href="../vue/profile.php?id='. $row['idprestataire'] .'&text='. sha1($row['nomprestataire']) .'&=info='. $row['nomprestataire'] .'" class="btn btn-dark mt-3">Voir le profil complet</a>
                            </div>
                        </div>
                    </div>

                    <hr class="w-100 d-md-none">
                </div>
            ';
        }
        // echo $output;

        $output.='
        </div>
        
        ';
    } else {
        $output .= '
            <div class="text-center container pt-5 pb-5 mb-5">
                Aucune information pour cette requête
            </div>
        ';
        // echo $output;
    }

    $total_links = ceil($total_data / $limite);

    $output .= '
        </table>

        <hr>
        
        <br>
        <div class="text-center ">
            <ul class="pagination justify-content-center">
        ';

    $previous_link = '';
    $next_link = '';

    // Bouton "Précédent"
    $previous_id = $page - 1;
    $previous_link = '
        <li class="page-item' . ($page <= 1 ? ' disabled' : '') . '">
            <a href="javascript:void(0)" data-page_number="' . $previous_id . '" class="page-link">
                Previous
            </a>
        </li>';

    // Bouton "Suivant"
    $next_id = $page + 1;
    $next_link = '
        <li class="page-item' . ($page >= $total_links ? ' disabled' : '') . '">
            <a href="javascript:void(0)" data-page_number="' . $next_id . '" class="page-link">Next</a>
        </li>
    ';

    $output .= $previous_link . $next_link;

    $output .= '
            </ul>
        </div>   
        ';
    echo $output;

    // echo $output;
}