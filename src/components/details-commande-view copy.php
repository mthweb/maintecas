<div class="tab pt-5" id="tab-1">
    <div class="mb-3">
        <h1 class="h3 fw-bold">Quel est votre commande ?</h1>
        <hr>
    </div>

    <div class="mb-3 small text-muted">
        Décrivez nous en quelques lignes votre besoin
    </div>

    <div class="mb-3">
        <textarea name="" id="" rows="6" class="form-control rounded-1 h-25 bg-light border-0"></textarea>
    </div>

    <div class="mb-3">
        <div class="bg-dark p-5 w-25 mx-auto"></div>
    </div>
            
    <!-- label -->
    <div class="mb-3 text-center">
        <h3 class="h5 fw-bold">Confirmer l’adresse du chantier</h3>
    </div>
    <!-- /label -->

    <!-- champ adresse -->
    <div class="input-group mb-3">  
        <!-- <span class="input-group-text fa fa-map-marker fa-x pt-3 bg-white"></span> -->
        <input id="address" type="search" name="address" required autocomplete="off" placeholder="Saisissez votre adresse ou récupérer votre position" class="adress form-control border-white bg-light">
        
        <button type="button" id="location-button" class="btn rounded-end-1 text-dark bg-light border-white border-start-0">
            <!-- <i class="fa fa-crosshairs"></i> -->
            <img src="../../assets/icones/crosshair-black.png" width="35" alt="">
        </button>
        
        <input type="hidden" id="selected_address" name="selected_address">

        <div id="suggestions" class="bg-white text-dark z-1"></div>
    </div>
    <!-- /champ adresse -->

    <!-- row -->
    <div class="row">
        <!-- colonne 1 -->
        <div class="col-6 col-md-6 mb-3">
            <input type="text" name="" id="" placeholder="joe" class="form-control bg-light border-dark border-2">
        </div>
        <!-- /colonne 1 -->

        <!-- colonne 2 -->
        <div class="col-6 col-md-6 mb-3">
            <input type="text" name="" id="" placeholder="kabongo" class="form-control bg-light">
        </div>
        <!-- /colonne 2 -->

        <!-- colonne 1 -->
        <div class="col-3 col-md-1 mb-3">
            <input type="text" name="" id="" placeholder="joe" class="form-control bg-light">
        </div>
        <!-- /colonne 1 -->

        <!-- colonne 2 -->
        <div class="col-9 col-md-11 mb-3">
            <input type="text" name="" id="" placeholder="kabongo" class="form-control bg-light border-dark border-2">
        </div>
        <!-- /colonne 2 -->
    </div>
    <!-- /row -->

    <!-- bouton envoyer votre commande -->
    <div class="mt-3 mb-3 text-center">
        <button type="submit" class="btn btn-primary fw-bold pt-3 pb-3 rounded-5">
            Envoyez votre commande 
        </button>
    </div>
    <!-- /bouton envoyer votre commande -->
        
</div>