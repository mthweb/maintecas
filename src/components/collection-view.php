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
<!-- naivigation -->
<?php include_once('navigation.php') ?>
<!-- naivigation -->
         
<!-- navbar retour-->
<div class="d-flex mt-4 pb-3 mb-1 bg-secondary shadow-sm">
    <!-- <a href="#" class="btn text-white border-0 mt-3 me-3">
        <!-- <i class="fa fa-chevron-left me-2"></i> -->
        <!-- <img src="../assets/arrow.png" width="30" alt=""> --
        <span class="fw-bold h5 "></span>
    </a> -->

    <div class="text-center text-md-start mt-4 container text-white">
        <h5 class="fw-bold">Tous les prestataires</h5>
    </div>

    <!-- label -->
    <div class="text-center pt-4"></div>
    <!-- /label -->

    <!-- /label -->
    <div class=""></div>
    <!-- /label -->
</div>
<!-- /navbar retour -->



<!-- content secondary -->
<main class="mt-3 pb-5" >
    <!-- container -->
    <div class="mt-1 mb-0 pt-2 z-5">
        <!-- titre -->
        <div class="container mb-3 d-flex justify-content-between">
            <h5 class="fw-bold">Quel profil recherchez- <br>vous ?</h5>
            <div>
                <div id="swiper-button-prev" class="rounded-5 border-dark btn btn-outline-dark"><i class="fa fa-chevron-left"></i></div>
                <div id="swiper-button-next" class="rounded-5 border-dark btn btn-outline-dark"><i class="fa fa-chevron-right"></i></div>
            </div>
        </div>
        <!-- /titre -->

        <!-- vue -->
        <div class="swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    <?php
                        // appel de la méthode
                        $stmt_service = $objServ->selectionneServiceTous();

                        
                        
                        // Nous récupérons tous les services de l'application
                        // A cela nous allons appreté une page qui va permettre d'afficher
                        // tous les techniciens, les ouvriers et les entreprises qui sont 
                        // concerné par le service
                        while($data_service = $stmt_service->fetch()){
                            // nous récupérons les données dans des variables en vue de permettre
                            // une mise à jour des infos simple
                            $codservice = $data_service['codserv'];
                            $libservice = $data_service['libserv'];

                            // print_r($data_service);
                    ?>     
                        <div class="card border-0 swiper-slide">
                            <div class="card-title text-white rounded-3 pt-5 pb-5" style="background-image: url('../../assets/images/millenium-image-card.png'); background-size: cover; background-position: center;">
                                <div class="container">
                                    <h3><?= $libservice ?></h3>
                                </div>
                            </div>
                    
                            <div class="card-body bg-light pb-5">
                                <p>
                                    Une variété de service, tout au même endroit.
                                </p>
                                
                                <a href="service.php?id=<?= $codservice ?>&text=<?= sha1($codservice) ?>&info=<?= $libservice ?>" class="btn btn-dark">
                                    voir plus
                                </a>
                            </div>
                        </div>
                    <?php
                        }

                        // $objCnx->closeConnection();
                    ?>                   
                </div>
            </div>

            <!-- <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div> -->
            <!-- <div class="swiper-pagination"></div> -->
        </div>

        <!-- <div class="container mt-3 text-end mb-3">
            <a href="" class="btn btn-dark">
                voir tous
            </a>
        </div> -->
    </div>
<!-- /container -->
</main>
<!-- /content secondary -->

<!-- content -->
<main class="container">

    <!-- field -->
    <div class="input-group mb-5">
        <!-- <span class="input-group-text fa fa-envelope pt-3 bg-white"></span> -->
        <input type="search" id="input-text" required class="form-control profile_search pt-2 pb-2" name="input" placeholder="Saisissez votre besoin ou choisissez un technicien">
        <!-- <button type="submit" name="request" class="input-group-text btn btn-light z-0 fa fa-send-o pt-1"></button> -->
        
        <div id="suggestions-services" class="suggestions-services container-fluid bg-light d-none text-dark mb-3"></div>
        <!-- contrainte -->
        <input type="hidden" name="action" value="trouve">
    </div>
    <!-- form besoin -->

    <!-- filtre -->
    <div class="container mb-3 d-flex justify-content-between">
        <h5 class="fw-bold"><span class="text-uppercase">à</span> proximité</h5>

        <div>
            <a href="" class="btn btn-dark rounded-circle"><i class="fa fa-flash p-1 small"></i></a>
            <a href="" class="btn btn-dark rounded-circle"><i class="fa fa-search small"></i></a>

            <button id="filterBtn" type="button" class="btn btn-light filter-btn rounded-circle">
                <img src="../../assets/icones/parametre.png" alt="" width="15" srcset="">
            </button>
            

            <!-- Filters Content -->
            <div class="filters-container p-3 border">
                <div class="row">
                    <div class="col-md-3">
                        <h6>Filtrer par évaluation</h6>
                        <div>
                            <input type="radio" id="all" name="evaluation" checked>
                            <label for="all">Tous</label>
                        </div>
                        <div>
                            <input type="radio" id="best" name="evaluation">
                            <label for="best">Les mieux notés</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <h6>Filtrer par tarif horaire</h6>
                        <div><input type="checkbox"> Moins de 30 €</div>
                        <div><input type="checkbox"> De 30 € à 50 €</div>
                        <div><input type="checkbox" checked> De 50 € à 100 €</div>
                        <div><input type="checkbox"> Plus de 100 €</div>
                    </div>

                    <div class="col-md-3">
                        <h6>Filtrer par projets réalisés</h6>
                        <div><input type="checkbox"> Plus de 20 projets</div>
                        <div><input type="checkbox"> De 10 à 20 projets</div>
                        <div><input type="checkbox"> De 5 à 10 projets</div>
                        <div><input type="checkbox"> Moins de 5 projets</div>
                    </div>

                    <div class="col-md-3">
                        <h6>Filtrer par ancienneté</h6>
                        <div><input type="checkbox"> Plus de 5 ans</div>
                        <div><input type="checkbox"> De 1 à 5 ans</div>
                        <div><input type="checkbox"> Moins d’un an</div>
                        <h6>Critères supplémentaires</h6>
                        <div><input type="checkbox"> Identité vérifiée</div>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary">Appliquer</button>
                    <button class="btn btn-secondary">Effacer</button>
                </div>
            </div>
            <!-- Filters Content -->

        </div>
    </div>
    <!-- /filtre -->

    <!-- vue -->
    <div class="pt-5 pb-5">
        <!-- row -->
        <div class="row">
            <!-- colonne 1 -->
            <div class="col-12 col-md-3">
                <div class="card bg-light border-0 rounded">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Filtrer par catégorie</h5>
                        <ul class="list-unstyled category-filter">
                            application filtre en cours...
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /colonne 1 -->

            <!-- colonne 2 -->
            <div class="col-12 col-md-9">
                <div id="dynamic_content_suggession"></div>
            </div>
            <!-- /colonne 2 -->
            
        </div>
        <!-- /row -->
    
    </div>
    <!-- /vue -->

</main>
<!-- /content -->

<!-- content -->
<main class="bg-light pt-5 pb-5">
    <!-- titre -->
    <div class="mt-5 mb-5">
        <h5 class="fw-bold h2 text-center">
            Plus de 100 000 Techniciens disponibles pour réaliser vos projets
        </h5>
    </div>

    <!-- button -->
    <div class="text-center">
        <a href="" class="btn btn-dark">
            Commander un service
        </a>
    </div>
</main>
<!-- /content -->


<!-- card -->
<script src="../../styles/card/js/script.js"></script>
<script src="../../styles/card/js/swiper-bundle.min.js"></script>

<script>

    document.getElementById('filterBtn').addEventListener('click', function() {
      this.classList.toggle('active');
    });


    var swiper = new Swiper(".slide-content", {
        slidesPerView: 3,
        spaceBetween: 25,
        loop: true,
        centerSlide: 'true',
        fade: 'true',
        grabCursor: 'true',
        pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
        },
        navigation: {
        nextEl: "#swiper-button-next",
        prevEl: "#swiper-button-prev",
        },

        breakpoints:{
            0: {
                slidesPerView: 1,
            },
            520: {
                slidesPerView: 2,
            },
            950: {
                slidesPerView: 3,
            },
        },
    });
</script>