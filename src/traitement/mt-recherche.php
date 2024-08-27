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

