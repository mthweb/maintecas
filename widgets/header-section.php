<!-- header section -->
<div class="bg-black pb-5 text-white" style="background-color: dark;">

    <!-- navigation -->
    <?php include_once('widgets/navigation.php') ?>
    <!-- /navigation -->

    <?php
        if (isset($_POST[''])) {
            // Nous implémentons une logique pour permettre de gérer la connexion au compte
            // maintecas pour usager si aucune session n'est détectée alors l'usager sera renvoyée
            // vers la boîte de connexion avant de passer sa commande
            if (empty($_SESSION['token'])) {
                // rédirection vers la page de connexion
                header('location:../login.php');
            }else{
                header('location:target/technicien.php');
            }
        }

    ?>


    <!-- row -->
    <div class="row pt-0 mx-auto">
        <!-- espace -->
        <div class="mb-5 mt-3"></div>


        <!-- colonne 1 -->
        <div class="col-12 col-md-12 mt-lg-5 pt-lg-5 col-lg-6 ">
            <!-- section titre, paragraphe -->
            <div class=" mt-lg-5 fade-in text-start text-md-start">
                <h5 class="h1 fw-bold mb-3 ">
                    Trouvez le meilleur technicien
                    à proximité de chez vous
                </h5>

                <!-- <p class="fw-light small">
                    Commandez un service, et le technicien
                    atterrit chez vous.
                </p> -->
            </div>
            <!-- /section titre, paragraphe -->


            <!-- formulaire -->
            <div class="pt-5">
                <form action="src/vue/technicien.php" method="post">
                    <!-- form lieu -->
                    <label class="mb-3">Trouve un technicien en un clic</label>
                    <div class="input-group mb-3">  
                        <!-- <span class="input-group-text fa fa-map-marker fa-x pt-3 bg-white"></span> -->
                        <input id="address" type="search" name="address" required autocomplete="off" placeholder="Saisissez votre adresse ou récupérer votre position" class="adress form-control rounded rounded-end-0 border-white bg-transparent text-white border-end-0">
                        <button type="button" id="location-button" class="btn rounded-end-1 text-dark bg-transparent border-white border-start-0">
                            <!-- <i class="fa fa-crosshairs"></i> -->
                            <img src="assets/icones/crosshair.png" width="35" alt="">
                        </button>
                        <input type="hidden" id="selected_address" name="selected_address">
                        <div id="suggestions" class="bg-white text-dark z-1"></div>
                    </div>
                    <!-- form lieu -->

                    <!-- form besoin -->
                    <div class="input-group mb-3">
                        <!-- <span class="input-group-text fa fa-envelope pt-3 bg-white"></span> -->
                        <input type="text" id="input-text" required class="form-control bg-light pt-2 pb-2" name="input" placeholder="Saisissez votre besoin ou choisissez un technicien">
                        <button type="submit" name="request" class="input-group-text btn btn-light z-0 fa fa-send-o pt-1"></button>
                    </div>
                    <!-- form besoin -->

                    <div id="suggestions-services" class="suggestions-services container d-none text-dark mb-3"></div>

                    <!-- contrainte -->
                    <input type="hidden" name="action" value="trouve">

                    <div class="container text-center my-4">
                       <div class="row">
                        <div class="col text-white">
                            <hr>
                        </div>

                        <div class="col-auto">
                            <strong>ou</strong>
                        </div>

                        <div class="col">
                            <hr>
                        </div>
                       </div>    
                    </div>

                    <?php
                        if (isset($_SESSION['key_compte']) && !empty($_SESSION['key_compte'])) {
                    ?>
                    <!-- button -->
                    <div class="mb-3 text-center">
                        <a href="src/vue/selection.php" class="btn btn-light text-muted">
                            Voir les techniciens
                        </a>
                    </div>
                    <!-- /button -->

                    <?php
                        }else{
                    ?>
                    <!-- button -->
                    <div class="mb-3 text-center">
                        <a href="src/vue/selection.php" class="btn btn-light text-muted disabled">
                            Voir les techniciens
                        </a>
                    </div>
                    <!-- /button -->

                    <?php
                        }
                    ?>
                </form>
            </div>
            <!-- /formulaire -->

            <!-- espace -->
            <div class="mb-5"></div>

        </div>
        <!-- /colonne 1 -->

        <!-- colonne 2 -->
        <div class="col-12 col-md-12 col-lg-6">
            <!-- image -->
            <div class="">
                <img src="assets/images/maintecas-img-001.jpg" class="w-100 h-100 fade-in rounded-3" alt="">
            </div>
            <!-- /image -->

        </div>
        <!-- /colonne 2 -->
    </div>
    <!-- /row -->
</div>
<!-- /header section -->