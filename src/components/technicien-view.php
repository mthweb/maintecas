<!-- navbar -->
<div class="mb-0 d-flex justify-content-between border-bottom pb-3 bg-dark">
    <a href="../../index.php" class="btn btn-outline-light border-0 mt-3">
        <!-- <img src="../../assets/arrow.png" width="30" alt=""> -->
        <i class="fa fa-chevron-left fa-x"></i>
    </a>

    <!-- label -->
    <div class="text-center pt-3">
        <h5 class="text-center small"></h5>
    </div>
    <!-- /label -->

    <!-- /label -->
    <div class=""></div>
    <!-- /label -->
</div>
<!-- /navbar -->

<!-- result -->
<div class="bg-light pt-0 pb-5">
     <!-- slide -->
     <div class="container swiper">

        <!-- filtre -->
        <div class="container mt-3 pt-5 border-bottom mb-3 d-flex justify-content-between">
            <h5 class="fw-bold h3"><span class="text-uppercase">à</span> proximité</h5>

            <div>
                <a href="" class="btn btn-dark rounded-circle"><i class="fa fa-flash p-1 small"></i></a>
                <a href="" class="btn btn-dark rounded-circle"><i class="fa fa-search small"></i></a>

                <button id="filterBtn" type="button" class="btn btn-light filter-btn rounded-circle" data-bs-toggle="modal" data-bs-target="#modalBottom">
                    <img src="../../assets/icones/parametre.png" alt="" width="15" srcset="">
                </button>
            
            </div>
        </div>
        <!-- /filtre -->
                    
                    <div class="mt-3 pt-3 mb-0 text-center">
                        <h5 class="fw-bold h3 mb-3">Tous les prestataires</h5>
                    </div>
    
                    <div class="slide-content">
                        <div class="row">
                                
                                <?php
                                    // Déclaration des variables pour limite l'affichage des informations
                                    // ces variables permettent la gestion de l'affichage des informations
                                    $start = '0';
                                    $limite = '5';
    
                                    // D'ici nous manipulons les méthodes de la classe effectuer
                                    $stmt_res_tech = $objRend->AfficherServiceRenduTousParZone($getKey,$address,$start, $limite);
    
    
                                    // Nous posons une contrainte pour afficher les données retrouvées
                                    // voici l'alternative s'il y a des entreprises concernées par le service 
                                    // on les affichent
                                    if ($stmt_res_tech->rowCount() > 0) {
                                        ?>
                                        
    
                                    <?php
                                        // Avec la boucle while, nous récupérons les données qui sont concernées
                                        // par cette recherche
                                        while ($fetch_res_tech = $stmt_res_tech->fetch()) {
                                            $id_prestataire    = $fetch_res_tech['idprestataire'];
                                            $nom_prestataire   = $fetch_res_tech['nomprestataire'];
                                            $description       = $fetch_res_tech['description'];
                                            $service_rendu     = $fetch_res_tech['libserv'];
                                            $type_compte       = $fetch_res_tech['libtypecompte'];  
                                            $presentation      = $fetch_res_tech['presentation'];
                                            $note              = $fetch_res_tech['note'];
                                            
                                ?>
                                    <div class="col-md-4 mb-3 mx-auto">
                                        <div class="card profile-card border-0">
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
                                                            <h5 class="card-title fw-bold text-capitalize mt-3"><?= $nom_prestataire ?></h5>
                                                            <p class="text-muted small"><?= $description ?></p>
    
                                                            <div class="d-flex mb-3 pb-0 border-bottom">
                                                                <div class="online-status text-start">
                                                                    <span class="status-dot"></span>
                                                                    <span class="status-text">Disponible</span>
                                                                </div>
                                                            </div>
    
                                                        </div>
    
                                                        <div class="rating-container">
                                                            <div class="main-circle">
                                                                <span class="rating"><?= number_format($note,1) ?></span>
                                                                <div class="star-circle">
                                                                    <span class="star">★</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="text-start" style="overflow-y: scroll; height:9em;scrollbar-color:rgb(100,100,100) rgb(45,45,45); scrollbar-width: thin;">
                                                    <div class="col d-flex align-items-start small">
                                                        
                                                        <span class="bg-light p-2 me-1 rounded-circle"><img src="../../assets/icones/map.png" width="20" alt=""></span> 
                                                        <div>
                                                            <p><?= $description ?></p>
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
                                                    <a href="./profile.php?id=<?= $id_prestataire ?>&text=<?= sha1($id_prestataire) ?>&=info=<?= $nom_prestataire ?>" class="btn btn-dark mt-3">Voir le profil complet</a>
                                                </div>
                                            </div>
                                        </div>
                                                        
                                        <hr class="w-100 d-md-none">
                                    </div>
    
                                <?php
                                        }
                                    }else{
                                        ?>
                                        <div class="text-center mx-auto container pt-5 pb-5">
                                            Aucune information pour cette requête
                                            <i class="fa fa-exclamation-circle d-block fa-2x mt-3"></i>
    
                                            <div class="d-block mt-5">
                                                <a href="./result.php" class="d-block">Découvrez d'autres techniciens</a>
                                            </div>
    
                                        </div>                    
                                        
                                        
    
                                        
                                <?php
                                    } 
                                ?>        
    
                        </div>
                    </div>
    
                    <div class="swiper-pagination"></div>
                                
                    <!-- <div class="swiper-button-prev swiper-navBtn"></div>
                    <div class="swiper-button-Suivant swiper-navBtn"></div> -->
    
                </div>
                <!-- /slide -->
</div>
<!-- /result -->


<!-- recherches similaires -->
<div class="container-fluid">     
    <div class="d-flex flex-column align-items-stretch flex-shrink-0 pb-5">
        <div class="list-group list-group-flush border-bottom scrollarea">
            <?php
                // récupération des profiles similaires, pour proposer d'autres choix complexes 
                // aux utilisateurs, nous partirons de la logique selon laquelle d'autres profiles
                // seront affichés pour aider à faire un choix et le critère d'affichage doit être
                // différent de la zone demandée par l'utilisateur
                // Déclaration des variables pour limite l'affichage des informations
                // ces variables permettent la gestion de l'affichage des informations
                $start = '0';
                $limite = '5';

                // D'ici nous manipulons les méthodes de la classe effectuer
                $stmt_res_tech = $objRend->suggessionProfileParZone($getKey,$address,$start, $limite);


                // Nous posons une contrainte pour afficher les données retrouvées
                // voici l'alternative s'il y a des entreprises concernées par le service 
                // on les affichent
                if ($stmt_res_tech->rowCount() > 0) {
            ?>
                <!-- titre -->
                <div class="mt-5 pt-3 mb-2 text-start">
                    <h5 class="fw-bold h3 mb-3">Profiles à proximité</h5>
                </div>
                <!-- /titre -->

                <?php
                       
                // Avec la boucle while, nous récupérons les données qui sont concernées
                // par cette recherche
                while ($fetch_res_tech = $stmt_res_tech->fetch()) {
                    $id_prestataire = $fetch_res_tech['idprestataire'];
                    $nom_prestataire= $fetch_res_tech['nomprestataire'];
                    $service_rendu  = $fetch_res_tech['libserv'];
                    $type_compte    = $fetch_res_tech['libtypecompte'];
            ?>
                <a href="./technicien-profile.php?id=<?=$id_prestataire.'&text='.sha1($id_prestataire)?>" class="list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center ">
                        <img src="../../assets/index.png" class="rounded-circle me-2 shadow-sm" width="50" height="50" class="me-2" alt="">
                        <span class="mb-1">
                            <strong><?=$nom_prestataire?></strong>
                            <div class="col-10 mb-1 small"><?=$service_rendu?></div>
                        </span>
                    </div>
                </a>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- /recherches similaires -->


<!-- content -->
<main class="bg-light pt-5 pb-5 mb-5">
    <!-- titre -->
    <div class="mt-5 mb-5">
        <h5 class="fw-bold h2 text-center">
            Plus de 100 000 Techniciens disponibles pour réaliser vos projets
        </h5>
    </div>

    <!-- button -->
    <div class="text-center">
        <a href="#" class="btn btn-dark">
            Commander un service
        </a>
    </div>
</main>
<!-- /content -->


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
                <?php
                    // Nous définissons la les valeurs 
                    // cette méthode récupère les différents services de la base de données
                    // en vue de rendre plus fluide le processus de recherche des autres informations
                    $stmt_service = $objServ->AfficherService($start, $limite);
                    while($data_service = $stmt_service->fetch()){
                        $codserv = $data_service['codserv'];
                        $libserv = $data_service['libserv'];
                ?>
                    <form action="./technicien.php?id=<?= sha1("maintecas")?>&text=<?= sha1("app")?>" method="post" id="rechercher">
                        <input type="hidden" name="input" value="<?=$libserv?>" id="">
                        <input type="hidden" name="address" value="<?=$_SESSION['address']?>" id="">
                                    
                        <a class="list-group-item list-group-item-action py-3 lh-tight border-0">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <strong class="mb-1">Rechercher un <?=$libserv?> ?</strong>
                                <small class="text-muted">
                                    <button class="btn btn-light bg-transparent border-0" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </small>
                            </div>
                        </a>
                    </form>
                <?php
                    }
                ?>
                </div>
            </div>
        </div>
        <!-- /suggestion services similaires -->
    </div>
</div>
<!-- /suggession -->


