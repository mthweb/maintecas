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
    <!-- navigation -->
    <nav class="container-fluid alert-dark">
        <div class="nav nav-tabs active bg-transparent nav-underline mb-3" id="nav-tab" role="tablist">
            <div class="nav-scroller bg-transparent">
                <nav class="nav nav-underline bg-transparent pt-3" aria-label="Secondary navigation">
                        
                    <button class="nav-link btn-dark rounded-5 p-2 bg-dark active" aria-current="page" id="nav-tout-tab" data-bs-toggle="tab" data-bs-target="#nav-tout" type="button" role="tab" aria-controls="nav-tout" aria-selected="true">
                        Technicien
                    </button>

                    <button class="nav-link btn-dark rounded-5 p-2 bg-dark" id="nav-ville-tab" data-bs-toggle="tab" data-bs-target="#nav-ville" type="button" role="tab" aria-controls="nav-ville" aria-selected="false">
                        <i class="fa fa-globe"></i> Zone intervention
                    </button>

                    <button class="nav-link btn-dark rounded-5 p-2 bg-dark" id="nav-categorie-tab" data-bs-toggle="tab" data-bs-target="#nav-categorie" type="button" role="tab" aria-controls="nav-categorie" aria-selected="false">
                        Catégorie
                    </button>

                    <!-- <button class="nav-link btn-dark rounded-5 p-2 bg-dark" id="nav-commune-tab" data-bs-toggle="tab" data-bs-target="#nav-commune" type="button" role="tab" aria-controls="nav-commune" aria-selected="false">
                        Commune
                    </button> -->

                    <button class="nav-link btn-dark rounded-5 p-2 bg-dark" id="nav-disponibilite-tab" data-bs-toggle="tab" data-bs-target="#nav-disponibilite" type="button" role="tab" aria-controls="nav-disponibilite" aria-selected="false">
                        Disponibilité
                    </button>
                        
                    <button class="nav-link btn-dark rounded-5 p-2 bg-dark" href="#" id="nav-note-tab" data-bs-toggle="tab" data-bs-target="#nav-note" type="button" role="tab" aria-controls="nav-note" aria-selected="false">
                        <i class="fa fa-star"></i> Note 
                    </button>

                                        
                    <!-- <button class="nav-link btn-dark rounded-5 p-2 bg-dark" href="#">
                        Link
                    </button>
                       
                    <button class="nav-link btn-dark rounded-5 p-2 bg-dark" href="#">
                        Link
                    </button>
                        
                    <button class="nav-link btn-dark rounded-5 p-2 bg-dark" href="#">
                        Link
                    </button> -->
                </nav>
            </div>
        </div>
    </nav>
    <!-- navigation -->
     
    <!-- panel section -->
    <div class="tab-content" id="nav-tabContent">
        <!-- technicien -->
        <div class="tab-pane fade show active pt-0 pb-0" id="nav-tout" role="tabpanel" aria-labelledby="nav-tout-tab">
            <!-- slide -->
            <div class="container swiper">
                    
                <div class="mt-3 pt-3 mb-5 text-center">
                    <h5 class="fw-bold h3 mb-3">Choisissez votre technicien</h5>
                </div>

                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">
                            
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
                                        $id_prestataire = $fetch_res_tech['idprestataire'];
                                        $nom_prestataire= $fetch_res_tech['nomprestataire'];
                                        $service_rendu  = $fetch_res_tech['libserv'];
                                        $type_compte    = $fetch_res_tech['libtypecompte'];  
                                        $presentation   = $fetch_res_tech['presentation'];
                                        
                            ?>
                            <!-- card 1 -->
                            <div class="card bg-light swiper-slide border-0">
                                <!-- card -->
                                <div class="card col-8 mx-auto text-center justify-content-center">
                                    <!-- card body -->
                                    <div class="card-body text-center">
                                        <!-- avatar -->
                                        <div class="mb-5">
                                            <img src="../../assets/index.png" class="rounded-circle shadow-sm border-primary" width="70" height="70" alt="">
                                        </div>
                                        <!-- /avatar -->
                                                
                                        <!-- user name -->
                                        <div class="mb-3">
                                            <h5 class="fw-bold"><?=$nom_prestataire?></h5>
                                            <span class="d-block"><?=$service_rendu?></span>
                                            <span class="d-block small text-muted"><?=$type_compte?></span>
                                        </div>
                                        <!-- /user name -->

                                        <!-- presentation -->
                                        <div class="mb-3">
                                            <?=$presentation?>
                                        </div>
                                        <!-- /presentation -->

                                        <!-- état -->
                                        <div class="mb-3">
                                           
                                        </div>
                                        <!-- /état -->

                                        <!-- button -->
                                        <div class="mt-3 mb-3">
                                            <a href="./technicien-profile.php?id=<?=$id_prestataire?>&info=<?=sha1($service_rendu)?>" class="btn btn-primary rounded-5">
                                                Contacter
                                            </a>
                                        </div>
                                        <!-- /button -->

                                    </div>
                                    <!-- /card body -->
                                </div>
                                <!-- /card -->

                                <!-- autres info -->
                                <div class="mb-3 text-center">
                                    <?php
                                        for ($i=0; $i < 5 ; $i++) { 
                                            echo '<i class="fa fa-star text-warning"></i>';
                                        }
                                    ?>
                                    (1)
                                </div>
                                <!-- /autres info -->

                                <!-- Lire les avis clients -->
                                <div class="mb-5 text-center">
                                    <a href="">Lire les avis clients</a>
                                </div>
                                <!-- /Lire les avis clients -->
                            </div>
                            <!-- /card 1 -->

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
        <!-- /technicien -->

        <!-- villes -->
        <div class="tab-pane fade pt-0 pb-3" id="nav-ville" role="tabpanel" aria-labelledby="nav-ville-tab">
                
            <div class="d-flex justify-content-between container align-items-center mb-3">
                <div class="fw-bold">
                    <i class="fa fa-filter"></i> Afficher par
                </div>

                <div class="col-6 col-md-2 mb-0">
                    <select name="" class="form-select rounded-5" id="ville">
                        <option value="">-- Sélectionner --</option>
                        <option value="Kinshasa">Kinshasa</option>
                        <option value="Lubumbashi">Lubumbashi</option>
                        <option value="Kisangani">Kisangani</option>
                        <option value="Mbuji-Mayi">Mbuji-Mayi</option>
                        <option value="Kananga">Kananga</option>
                        <option value="Goma">Goma</option>
                        <option value="Bukavu">Bukavu</option>
                        <option value="Kolwezi">Kolwezi</option>
                        <option value="Tshopo">Tshopo</option>
                        <option value="Haut-Uele">Haut-Uele</option>
                        <option value="Ituri">Ituri</option>
                        <option value="Tshopo">Tshopo</option>
                        <option value="Haut-Lomami">Haut-Lomami</option>
                        <option value="Tanganyika">Tanganyika</option>
                        <option value="Haut-Katanga">Haut-Katanga</option>
                        <option value="Kasaï">Kasaï</option>
                        <option value="Kasaï-Central">Kasaï-Central</option>
                        <option value="Kasaï-Oriental">Kasaï-Oriental</option>
                        <option value="Sankuru">Sankuru</option>
                        <option value="Sud-Kivu">Sud-Kivu</option>
                        <option value="Nord-Kivu">Nord-Kivu</option>
                        <option value="Maniema">Maniema</option>
                        <option value="Maï-Ndombe">Maï-Ndombe</option>
                        <option value="Kwilu">Kwilu</option>
                        <option value="Kwanga">Kwanga</option>
                        <option value="Équateur">Équateur</option>
                    </select>
                </div>
            </div>

            <!-- load data ville -->
            <div class="">
                <div id="result_ville"></div>
            </div>
            <!-- /load ville -->
        </div>            
        <!-- /viles -->

        <!-- commune -->
        <div class="tab-pane fade pt-0 pb-3" id="nav-commune" role="tabpanel" aria-labelledby="nav-commune-tab">
            <div class="d-flex justify-content-between container align-items-center mb-3">
                <div class="fw-bold">
                    <i class="fa fa-filter"></i> Afficher par
                </div>

                <div class="col-6 col-md-2 mb-0">
                    <select id="commune" name="commune" class="form-select rounded-5">
                        <!-- <option value="">-- Sélectionner --</option> -->
                        <option value="Kinshasa">Kinshasa</option>
                        <option value="Bandalungwa">Bandalungwa</option>
                        <option value="Barumbu">Barumbu</option>
                        <option value="Bumbu">Bumbu</option>
                        <option value="Gombe">Gombe</option>
                        <option value="Kasa-Vubu">Kasa-Vubu</option>
                        <option value="Kintambo">Kintambo</option>
                        <option value="Kinsuka">Kinsuka</option>
                        <option value="Lemba">Lemba</option>
                        <option value="Limete">Limete</option>
                        <option value="Lingwala">Lingwala</option>
                        <option value="Makala">Makala</option>
                        <option value="Masina">Masina</option>
                        <option value="Ngaliema">Ngaliema</option>
                        <option value="Ngiri-Ngiri">Ngiri-Ngiri</option>
                        <option value="Nsele">Nsele</option>
                        <option value="Selembao">Selembao</option>
                        <option value="Tshangu">Tshangu</option>
                    </select>
                </div>
            </div>

                                            
            <!-- load data commune -->
            <div class="">
                <div id="result_commune"></div>
            </div>
            <!-- /load commune -->
        </div>            
        <!-- /commune -->

        <!-- disponibilité -->
        <div class="tab-pane fade pt-1 pb-3" id="nav-disponibilite" role="tabpanel" aria-labelledby="nav-disponibilite-tab">
                  
            <div class="nav-scroller bg-transparent">
                <div class="d-flex justify-content-between container align-items-center mb-3">
                    <div class="fw-bold">
                        <i class="fa fa-filter"></i> Afficher par
                    </div>

                    <div class="col-6 col-md-2 mb-0">
                        <select id="dispo" name="dispo" class="form-select rounded-5">
                            <!-- <option value="">-- Sélectionner --</option> -->
                            <?php
                                // Nous récupérons les données des disponibilités pour interroger la base 
                                // de données afin de nous produire les données demandées
                                $stmt_dispo = $objDisp->AfficherDispoTous();
                                while ($donnees_dispo = $stmt_dispo->fetch()) {     
                                    $iddispo  = $donnees_dispo['iddispo'];                    
                                    $libdispo = $donnees_dispo['libdispo'];                      
                                ?>
                                    <option value="<?= $iddispo?>"><?= $libdispo?></option>
                            <?php
                              }
                            ?>
                        </select>
                    </div>
                </div>
            </div>              
          
            <!-- load data entreprise -->
            <div class="">
                <div id="result_dispo"></div>
            </div>
            <!-- /load data entreprise -->
        </div>            
        <!-- /disponibilité -->

        <!-- note -->
        <div class="tab-pane fade pt-0 pb-3" id="nav-note" role="tabpanel" aria-labelledby="nav-note-tab">
                
            <div class="nav-scroller bg-transparent">
                <div class="d-flex justify-content-between container align-items-center mb-3">
                    <div class="fw-bold">
                        <i class="fa fa-filter"></i> Afficher par
                    </div>

                    <div class="col-6 col-md-2 mb-0">
                        <select id="note" name="note" class="form-select rounded-5">
                            <!-- <option value="">-- Sélectionner --</option> -->
                            <option value="10">5 étoiles</option>
                            <option value="8">4 étoiles</option>
                            <option value="6">3 étoiles</option>
                            <option value="4">2 étoiles</option>
                            <option value="2">1 étoiles</option>
                        </select>
                    </div>
                </div>
            </div>              


            <!-- load data entreprise -->
            <div class="">
                <div id="result_note"></div>
            </div>
            <!-- /load data entreprise -->
        </div>            
        <!-- /note -->

        <!-- catégorie -->
        <div class="tab-pane fade pt-0 pb-3" id="nav-categorie" role="tabpanel" aria-labelledby="nav-categorie-tab">
                
            <div class="nav-scroller bg-transparent">
                <div class="d-flex justify-content-between container align-items-center mb-3">
                    <div class="fw-bold">
                        <i class="fa fa-filter"></i> Afficher par
                    </div>

                    <div class="col-6 col-md-2 mb-0">
                        <select id="categorie" name="categorie_" class="form-select rounded-5">
                            <!-- <option value="">-- Sélectionner --</option> -->
                            <?php
                                // Nous récupérons les données des disponibilités pour interroger la base 
                                // de données afin de nous produire les données demandées
                                $stmt_cat = $objCat->selectionneCategorieTous();
                                while ($donnees_cat = $stmt_cat->fetch()) {     
                                    $codcat = $donnees_cat['codcat'];                    
                                    $libcat = $donnees_cat['libcat'];                      
                                ?>
                                    <option value="<?= $libcat?>"><?= $libcat?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>              

            <!-- load data entreprise -->
            <div class="">
                <div id="result_categorie"></div>
            </div>
            <!-- /load data entreprise -->
        </div>            
        <!-- /catégorie -->
        </div>
        <!-- /partial -->
    </div>
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
