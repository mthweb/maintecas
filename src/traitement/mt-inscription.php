<?php
// la variable action sera utilisé pour la gestion des opérations 
// qui auront lieu pour la gestion des différents modules, le 
// traitement d'une information sera gérée par les actions qui
// seront au préalable défini par le moyen d'envoi des données
// $action = $_REQUEST['action'];

// nous posons un test pour vérifier si la variable action n'est
// pas vide, si oui, on récupère les modèles et les controllers 
// qui nous permettent de manipuler la base de données
if (!empty($action)) {

    // on inclut les mutateurs pour la gestion des données étant
    // donné que l'approche utilisé est l'orienté objet
    include_once('../controllers/prestataireController.php');
    include_once('../controllers/entrepriseController.php');
    include_once('../controllers/moteurController.php');


    // on importe notre classe connexion
    include_once('../controllers/cnx.php');

    // on instancie les classes
    $objPrest  = new prestataireControleur();
    $objEntre  = new entrepriseControleur();
    $objMoteur = new moteurRechercheControleur();

    // nous créons également un objet pour fermer notre connexion à la bdd
    $objCnx    = new cnx();

}


// if($action =='get_result'){
    // La variable input_besoin permet de récupérer le besoin de l'utilisateur
    // La variable input_zone permet de récupérer la zone mentionnée par l'utilisateur
    // $input_zone   = htmlspecialchars($_POST['zone']);
    // $input_besoin = htmlspecialchars($_POST['besoin']);

    $input_zone   = 'Gombe-mitendi';
    
    $input_besoin = 'data';

    // nous posons un test pour vérifier que les champs ne sont pas vides
    if(!empty($input_zone) && !empty($input_besoin)){
        // nous implémentons une logique selon laquelle, le moteur de recherche récupère
        // La valeur saisie pour ensuite aller vérifer si cette valeur correspond à la 
        // collection stockée par un mot clé,
        // exemple : soit on recherche informaticien nous avons la collection comprenant
        // [TIC,tech,web,développeur,programmation,data,dba,front-end,back-end,fullstack,]
        // Cette collection collectera les données, se mettra automatiquement à jour 
        // c'est-à-dire ajouter des mots automatiquement à la collection
        ?>
            <!-- chargement des données HTML -->
            <div>
                <!-- chargement de tous les profiles -->
                <div>
                    <!-- tout -->
                    <div class="tab-pane fade show active pt-0 pb-3" id="nav-tout" role="tabpanel" aria-labelledby="nav-tout-tab">
                        <!-- techncien & ouvrier -->
                        <div class="container-fluid bg-light pt-0 pb-5">

                            <!-- titre -->
                            <div class="container-fluid pt-5 mb-5">
                                <h3 class="fw-bold">Préstataires</h3>
                            </div>
                            <!-- /titre -->
                        
                            <!-- vue préstataire -->
                            <div class="">
                                <div class="swiper">
                                    <div class="slide-content">
                                        <div class="card-wrapper swiper-wrapper">

                                            <?php

                                                // nous déclarons deux variables, $start pour définir la valeur initiale
                                                // et la variable $limite pour définir la limite des données, nous mettons
                                                // en place une pagination
                                                $start ='0';
                                                $limite='10';


                                                // A partir de l'objet prestataire, nous récupérons ces méthodes 
                                                // en vue de manipuler ces méthodes
                                                $stmt_prest = $objPrest->selectionnePrestataireTousLimite($start,$limite);

                                                while ($row_prest = $stmt_prest->fetch()) {                                             

                                            ?>
                                                <div class="card swiper-slide">
                                                    <!-- card body -->
                                                    <div class="card-body text-center">
                                                        <!-- avatar -->
                                                        <div class="mb-3">
                                                            <img src="../assets/profile_client/index.png" border="2" class="rounded-circle border-primary" width="70" height="70" alt="">
                                                        </div>
                                                        <!-- /avatar -->
                                                                    
                                                        <!-- user name -->
                                                        <div class="mb-3">
                                                            <h5 class="fw-bold small">Nom prestataire</h5>
                                                        </div>
                                                        <!-- /user name -->

                                                        <!-- profession -->
                                                        <div class="mb-2">
                                                            <h5 class="small">Technicien</h5>
                                                        </div>
                                                        <!-- /profession -->

                                                        <!-- button -->
                                                        <div class="mb-3">
                                                            <a href="" class="btn btn-primary rounded-5">
                                                                Contacter
                                                            </a>
                                                        </div>
                                                        <!-- /button -->
                                                    </div>
                                                    <!-- /card body -->
                                                </div>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>

                                    <!-- <div class="swiper-button-next swiper-navBtn"></div>
                                    <div class="swiper-button-prev swiper-navBtn"></div>
                                    <div class="swiper-pagination"></div> -->
                                </div>
                            </div>
                            <!-- /vue préstataire -->

                            <!-- voir plus all btn -->
                            <div class="text-end container-fluid mt-5">
                                <a href="" class="btn btn-primary rounded-5">
                                    voir plus
                                </a>
                            </div>
                            <!-- /voir plus all btn -->
                        </div>
                        <!-- /techncien & ouvrier -->


                        <!-- vue entreprise -->
                        <div class="pt-5 pb-5">
                            <!-- titre -->
                            <div class="container-fluid">
                                <h3 class="fw-bold">Entreprise</h3>
                            </div>
                            <!-- titre -->

                            <!-- load data entreprise -->
                            <div class="">
                                <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
                                    <div class="list-group list-group-flush border-bottom scrollarea">
                                    
                                        <a href="../vue/profile-view.php?id=<?=$data_tech['idprestataire'].'&text='.sha1($data_tech['idprestataire'])?>" class="list-group-item list-group-item-action py-3 lh-tight">
                                            <div class="d-flex w-100 align-items-center ">
                                                <img src="assets/profile_client/index.png" class="rounded-circle me-2" width="50" class="me-2" alt="">
                                                <span class="mb-1">
                                                    <strong>nom entreprise</strong>
                                                    <div class="col-10 mb-1 small">services</div>
                                                </span>
                                            </div>
                                        </a>
                                        
                                        <a href="../vue/profile-view.php?id=<?=$data_tech['idprestataire'].'&text='.sha1($data_tech['idprestataire'])?>" class="list-group-item list-group-item-action py-3 lh-tight">
                                            <div class="d-flex w-100 align-items-center ">
                                                <img src="assets/profile_client/index.png" class="rounded-circle me-2" width="50" class="me-2" alt="">
                                                <span class="mb-1">
                                                    <strong>nom entreprise</strong>
                                                    <div class="col-10 mb-1 small">services</div>
                                                </span>
                                            </div>
                                        </a>

                                        <a href="../vue/profile-view.php?id=<?=$data_tech['idprestataire'].'&text='.sha1($data_tech['idprestataire'])?>" class="list-group-item list-group-item-action py-3 lh-tight">
                                            <div class="d-flex w-100 align-items-center ">
                                                <img src="assets/profile_client/index.png" class="rounded-circle me-2" width="50" class="me-2" alt="">
                                                <span class="mb-1">
                                                    <strong>nom entreprise</strong>
                                                    <div class="col-10 mb-1 small">services</div>
                                                </span>
                                            </div>
                                        </a>

                                        <a href="../vue/profile-view.php?id=<?=$data_tech['idprestataire'].'&text='.sha1($data_tech['idprestataire'])?>" class="list-group-item list-group-item-action py-3 lh-tight">
                                            <div class="d-flex w-100 align-items-center ">
                                                <img src="assets/profile_client/index.png" class="rounded-circle me-2" width="50" class="me-2" alt="">
                                                <span class="mb-1">
                                                    <strong>nom entreprise</strong>
                                                    <div class="col-10 mb-1 small">services</div>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- button voir tout -->
                                    <div class="mt-0">
                                        <a href="" class="btn btn-light rounded-0 col-12 col-md-12">
                                            voir tout
                                        </a>
                                    </div>
                                    <!-- /button voir tout -->
                                </div>
                            </div>
                            <!-- /load data entreprise -->
                        </div>
                        <!-- /vue entreprise -->


                        <!-- suggession -->
                        <div class="container-fluid">
                            <!-- titre -->
                            <div class="">
                                <h3 class="fw-bold">Suggession</h3>
                            </div>
                            <!-- /titre -->

                            <!-- suggestion services similaires -->
                            <div>
                                <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" >
            
                                    <div class="list-group list-group-flush border-bottom scrollarea">
                                        
                                        <a href="#" class="list-group-item list-group-item-action py-3 lh-tight">
                                            <div class="d-flex w-100 align-items-center justify-content-between">
                                            <strong class="mb-1">Rechercher un quado ?</strong>
                                            <small class="text-muted">
                                                <button class="btn btn-light bg-transparent border-0">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </small>
                                            </div>
                                        </a>

                                        <a href="#" class="list-group-item list-group-item-action py-3 lh-tight">
                                            <div class="d-flex w-100 align-items-center justify-content-between">
                                            <strong class="mb-1">Rechercher un mécanicien ?</strong>
                                            <small class="text-muted">
                                                <button class="btn btn-light bg-transparent border-0">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </small>
                                            </div>
                                        </a>
                                        
                                        <a href="#" class="list-group-item list-group-item-action py-3 lh-tight">
                                            <div class="d-flex w-100 align-items-center justify-content-between">
                                            <strong class="mb-1">Rechercher un ingénieur BTP ?</strong>
                                            <small class="text-muted">
                                                <button class="btn btn-light bg-transparent border-0">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </small>
                                            </div>
                                        </a>

                                        <a href="#" class="list-group-item list-group-item-action py-3 lh-tight">
                                            <div class="d-flex w-100 align-items-center justify-content-between">
                                            <strong class="mb-1">Rechercher un chauffeur ?</strong>
                                            <small class="text-muted">
                                                <button class="btn btn-light bg-transparent border-0">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </small>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <!-- /suggestion services similaires -->
                        </div>
                        <!-- /suggession -->
                    </div>
                    <!-- /tout -->
                </div>
                <!-- /chargement de tous les profiles -->
            </div>
            <!-- /chargement des données HTML -->
             
        <?php
    }

    // fermeture de la connexion 
    // $objCnx->closeConnection();
// }

