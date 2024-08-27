<!-- header section -->
<div class="bg-dark pb-5 text-white" style="background-color: dark;">

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
    <div class="container row pt-5 mx-auto">
        <!-- espace -->
        <div class="mb-5 mt-3"></div>


        <!-- colonne 1 -->
        <div class="col-12 col-md-6">
            <!-- section titre, paragraphe -->
            <div class="container mt-5 fade-in">
                <h5 class="h1 fw-bold mb-3">
                    Trouvez le meilleur technicien <br>
                    À proximité de chez vous <br>
                </h5>

                <p>
                    Commandez un service, et le technicien
                    atterrit chez vous.
                </p>
            </div>
            <!-- /section titre, paragraphe -->


            <!-- formulaire -->
            <div class="container pt-5">
                <form action="src/vue/technicien.php" method="post">
                    <!-- form lieu -->
                    <div class="input-group mb-3">  
                        <!-- <span class="input-group-text fa fa-map-marker fa-x pt-3 bg-white"></span> -->
                        <input id="address" type="search" name="address" required autocomplete="off" placeholder="Entrer votre position" class="form-control form-control-lg rounded rounded-end-0 border-0">
                        <button type="button" id="location-button" class="btn bg-white rounded-end-1 text-dark">
                            <i class="fa fa-bullseye"></i>
                        </button>
                        <input type="hidden" id="selected_address" name="selected_address">
                        <div id="suggestions" class="bg-white text-dark z-1"></div>
                    </div>
                    <!-- form lieu -->

                    <!-- form lieu -->
                    <div class="input-group mb-3">
                        <!-- <span class="input-group-text fa fa-envelope pt-3 bg-white"></span> -->
                        <input type="text" id="input-text" required class="form-control form-control-lg" name="input" placeholder="Saisissez votre besoin">
                        <button type="submit" name="request" class="input-group-text btn btn-light z-0 fa fa-send pt-1"></button>
                    </div>
                    <!-- form lieu -->

                    <div id="suggestions-services" class="suggestions-services container d-none text-dark mb-3"></div>

                    <!-- contrainte -->
                    <input type="hidden" name="action" value="trouve">

                    <!-- button -->
                    <div class="mb-3">
                        <a href="src/vue/collection.php" class="btn btn-light btn-lg text-muted">
                            Voir les techniciens
                        </a>
                    </div>
                    <!-- /button -->
                </form>
            </div>
            <!-- /formulaire -->

            <!-- espace -->
            <div class="mb-5"></div>

        </div>
        <!-- /colonne 1 -->

        <!-- colonne 2 -->
        <div class="col-12 col-md-6">
            <!-- image -->
            <div class="container">
                <img src="assets/Ride-with-Uber.webp" class="w-100 h-100 fade-in" alt="">
            </div>
            <!-- /image -->

        </div>
        <!-- /colonne 2 -->
    </div>
    <!-- /row -->
</div>
<!-- /header section -->