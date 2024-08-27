<?php


// import des controllers, afin de faciliter la manipulation des données
// de nos différentes classes
include_once('../controllers/cnx.php');

include_once('../controllers/keywordController.php');    
include_once('../controllers/rendreController.php');    
include_once('../controllers/effectuerController.php');    
include_once('../controllers/serviceController.php');    

// on instancie les classes (création des objets)
$objKey    = new keywordControleur();
$objRend   = new rendreControleur();
$objEff    = new effectuerController();
$objServ   = new serviceControleur();

?>

<!-- navbar retour-->
<div class="d-flex pb-3 mb-1 bg-dark shadow-sm">
    <a href="../../index.php" class="btn text-white border-0 mt-3 me-3">
        <i class="fa fa-chevron-left me-2"></i>
        <!-- <img src="../assets/arrow.png" width="30" alt=""> -->
        <span class="fw-bold">Collection maintecas</span>
    </a>

    <!-- label -->
    <div class="text-center pt-4"></div>
    <!-- /label -->

    <!-- /label -->
    <div class=""></div>
    <!-- /label -->
</div>
<!-- /navbar retour -->


<!-- partial:index.partial.html -->
<div class="col-12 col-md-12 nav-scroller bg-body pt-2 pb-2 mb-4">
    <!-- slider service -->
    <div id="horizontal-nav" class="pb-4 container-fluid shadow-sm">
        <div class="btn-prev" role="button" tabindex="0">
            <svg viewBox="0 0 24 24">
            <path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z" fill="hsl(141, 15%, 50%)">
            </path>
        </svg>
    </div>

    <div class="menu-wrap">
        <ul class="menu">
            <?php
                // Nous récupérons tous les services au moyen de la boucle
                $stmt_service = $objServ->AfficherServiceTous();

                while ($fetch_service = $stmt_service->fetch()) {
                    $libelle_service = $fetch_service['libserv'] 
                ?>

                    <li class="list-item">
                        <a href="" class="pill"> <?= $libelle_service ?></a>
                    </li>

                <?php
                }
                ?>      
            </ul>
        </div>
            
        <div class="btn-next" role="button">
            <svg viewBox="0 0 24 24">
                <path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z" fill="hsl(141, 15%, 50%)">
                </path>
            </svg>
        </div>
    </div>
    <!-- /slider service --> 
</div>
<!-- /partial -->

<!-- vue -->
<div class="container-fluid">
    <!-- row -->
    <div class="row">
        <!-- colonne 1 -->
        <div class="col-12 col-md-3 mb-3">
            <!-- card -->
            <div class="card bg-light border-0 rounded-0 pt-2 pb-2 mb-3">
                <div class="card-body">
                    <!-- titre -->
                    <div class="mb-3">
                        <h5 class="fw-bold">Les plus notés</h5>
                    </div>
                    <!-- /titre -->

                    <!-- divider -->
                    <div class="mb-3">
                        <hr>
                    </div>
                    <!-- /divider -->

                    <!-- load data -->
                    <div>

                    </div>
                    <!-- /load data -->
                </div>
            </div>
            <!-- /card -->

            <!-- card -->
            <div class="card bg-light border-0 rounded-0 pt-2 pb-2">
                <div class="card-body">
                    <!-- titre -->
                    <div class="mb-3">
                        <h5 class="fw-bold">Catégories</h5>
                    </div>
                    <!-- /titre -->

                    <!-- divider -->
                    <div class="mb-3">
                        <hr>
                    </div>
                    <!-- /divider -->

                    <!-- load data -->
                    <div>

                    </div>
                    <!-- /load data -->
                </div>
            </div>
            <!-- /card -->
        </div>
        <!-- /colonne 1 -->

        <!-- colonne 2 -->
        <div class="col-12 col-md-6 mb-3">
            <!-- card -->
            <div class="card bg-light border-0 rounded-0 pt-2 pb-2 mb-3">
                <div class="card-body">
                    <!-- load data -->
                    <div>

                    </div>
                    <!-- /load data -->
                </div>
            </div>
            <!-- /card -->

            
        </div>
        <!-- /colonne 2 -->

        <!-- colonne 3 -->
        <div class="col-12 col-md-3 mb-3">
            <!-- card -->
            <div class="card bg-light border-0 rounded-0 pt-2 pb-2">
                <div class="card-body">
                    <!-- titre -->
                    <div class="mb-3">
                        <h5 class="fw-bold">Domaines</h5>
                    </div>
                    <!-- /titre -->

                    <!-- divider -->
                    <div class="mb-3">
                        <hr>
                    </div>
                    <!-- /divider -->

                    <!-- load data -->
                    <div>

                    </div>
                    <!-- /load data -->
                </div>
            </div>
            <!-- /card -->
        </div>
        <!-- /colonne 3 -->


    </div>
    <!-- /row -->
</div>
<!-- /vue -->

<!-- vue -->
<div class="container-fluid mt-5 bg-light pt-4 pb-5">
    <nav>
        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-dispo-tab" data-bs-toggle="tab" data-bs-target="#nav-dispo" type="button" role="tab" aria-controls="nav-dispo" aria-selected="true">
                Disponibilité
            </button>

            <button class="nav-link" id="nav-service-tab" data-bs-toggle="tab" data-bs-target="#nav-service" type="button" role="tab" aria-controls="nav-service" aria-selected="false">
                Services
            </button>

            <button class="nav-link" id="nav-zone-tab" data-bs-toggle="tab" data-bs-target="#nav-zone" type="button" role="tab" aria-controls="nav-zone" aria-selected="false">
                Zone
            </button>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-dispo" role="tabpanel" aria-labelledby="nav-dispo-tab">
            <p><strong>This is some placeholder content the Home tab's associated content.</strong> Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
        </div>

        <div class="tab-pane fade" id="nav-service" role="tabpanel" aria-labelledby="nav-service-tab">
            <p><strong>This is some placeholder content the Profile tab's associated content.</strong> Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
        </div>

        <div class="tab-pane fade" id="nav-zone" role="tabpanel" aria-labelledby="nav-zone-tab">
            <p><strong>This is some placeholder content the Contact tab's associated content.</strong> Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
        </div>
    </div>
</div>
<!-- /vue -->