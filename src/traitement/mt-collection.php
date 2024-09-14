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
    include_once('../controllers/prestataireController.php');    
    include_once('../controllers/keywordController.php');    
    include_once('../controllers/categorieController.php');    

    // on importe notre classe connexion
    include_once('../controllers/cnx.php');

    // on instancie les objets
    $objKey    = new keywordControleur();
    $objRend   = new rendreControleur();
    $objEff    = new effectuerController();
    $objPrest  = new prestataireControleur();
    $objKeyword= new keywordControleur();
    $objCat    = new categorieControleur();

}

// Nous récupérons les données de tous les prestataires
if ($action == "getProfileTous") {

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
    $stmt = $objPrest->AfficherPrestataire($start,$limite);
    $res = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objPrest->CompterPrestataire();
    $total_data = $data_count->fetchColumn();
    
    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a href="./details-collection.php?id='.$row['idprestataire'].'&info='.$row['idprestataire'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
                        </span>
                    </div>
                </a>
            ';
        }
        // echo $output;

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
                        <span class="sr-only"></span>
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
}

// Nous récupérons les différents domaines
if ($action == "getDomaine") {

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
    $stmt = $objKeyword->AfficherKeyword($start,$limite);
    $res = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objKeyword->CompterKeyword();
    $total_data = $data_count->fetchColumn();
    
    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a href="#id='.$row['key'].'&info='.sha1($row['id']).'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <strong>'.$row['word'].'</strong>
                    </div>
                </a>
            ';
        }

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
                Aucune information pour cette requête
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

// Nous récupérons les données de catégorie en générale
if ($action == "getCategorieAll") {

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
    $stmt = $objCat->selectionneCategorieTous();
    $res  = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objCat->CompterCategorie();
    $total_data = $data_count->fetchColumn();
    
    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a  href="./vue-cat.php?id='.$row['codcat'].'&info='.$row['libcat'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <span class="mb-1">
                            <strong>'.$row['libcat'].'</strong>
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
                Aucune information pour cette requête
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

// Nous récupérons les données des prestataires par note
if ($action == "getNoteSel") {

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
    $stmt = $objPrest->AfficherParNote('7',$start, $limite);
    $res  = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objPrest->AfficherParNote('7',$start, $limite);
    $total_data = $data_count->fetchColumn();

    
    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a href="./details-collection.php?id='.$row['idprestataire'].'&info='.$row['idprestataire'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
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
                Aucune information pour cette requête
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

// Nous récupérons les données de profiles par services
if ($action == "getProfileService") {

    $_POST['page'] ?? 1;
    $limite = 5;
    $page = 1;

    if ($_POST['page'] ?? 1 > 1) {
        $start = (($_POST['page'] - 1) * $limite);
        $page  = $_POST['page'];
    } else {
        $start = 0;
    }

    // $input = htmlspecialchars($_POST['service']);

    //On selectione toutes les lignes
    $statement = $objRend->AfficherServiceRenduParservice("Technicien", $_SESSION['service_en_cours'] ,$start, $limite);
    $res = $statement->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objRend->AfficherServiceRenduParservice("Technicien", $_SESSION['service_en_cours'] ,$start, $limite);
    $total_data = $data_count->fetchColumn();


    $output = '
        <div class="row pt-5">    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <div class="col-md-4 mx-auto mb-3">
                    <div class="card profile-card  border-0">
                        <div class="card-body text-start">
                           <div class="">
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
        $output .= '
            <div class="mt-0">
                <a href="" class="btn btn-light rounded-0 col-12 col-md-12">
                    voir tout
                </a>
            </div>
        ';
    } else {
        $output .= '
            <div class="text-center container pt-5 pb-2 mb-5">
                Aucune information pour cette requête
            </div>
        ';
        // echo $output;
    }

    $output .='
    </div>
    ';

    echo $output;
}

// Nous récupérons les données des prestataires par note
if ($action == "getPrestataireCategorie") {

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
    $stmt = $objPrest->AfficherPrestataireParCategorie($_SESSION['catego_en_cours'],$start, $limite);
    $res  = $stmt->fetchAll();

    //On compte le nombre de ligne
    $data_count = $objPrest->AfficherPrestataireParCategorie($_SESSION['catego_en_cours'],$start, $limite);
    $total_data = $data_count->fetchColumn();

    
    $output = '
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <div class="list-group list-group-flush border-bottom scrollarea">
    
    ';
    if ($total_data > 0) {
        foreach ($res as $row) {
            $output .= '
                <a href="./details-collection.php?id='.$row['idprestataire'].'&info='.$row['idprestataire'].'" class="modale-open-profile list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong>'.$row['nomprestataire'].'</strong>
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
                Aucune information pour cette requête
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

// =====================================================================================
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

