<?php
    // récupération de l'ID du prestataire sélectionné
    $prestataire = htmlspecialchars($_GET['id']);


    // Import des controllers 
    include_once('../controllers/cnx.php');
    include_once('../controllers/prestataireController.php');


    // Création d'objets 
    $objCnx  = new cnx();
    $objPrest= new prestataireControleur();
?>
<!-- corps -->
<div class="container-fluid pt-5">
    <!-- <form action="" method="post" class="rounded-4"> -->
        
        <!-- <div class="text-center">
            <span class="step" id="step-1">1</span>
            <span class="step" id="step-2">2</span>
            <span class="step" id="step-3">3</span>
            <span class="step" id="step-4">4</span>
        </div> -->

        
        
        <!-- tab panel 1 ce panel contient les détails sur la commande -->
        <div class="tab" id="tab-1">

            <form action="" method="post" id="setIntervention" enctype="multipart/form-data">                
                <!-- row -->
                <div class="row">
                    
                    <!-- colonne 1 -->
                    <div class="col-11 col-md-5 mx-auto shadow rounded-4 pt-5 pb-5">
                        <!-- container -->
                        <div class="container">
                            <div class="mb-3">
                                <h1 class="h3 fw-bold">Quel est votre commande ?</h1>
                                <hr>
                            </div>

                            <div class="message-intervention alert alert-dark text-center"></div>

                            <div class="mb-3 text-muted">
                                Décrivez nous en quelques lignes votre besoin
                            </div>

                            <div class="mb-3">
                                <textarea name="details" id="" rows="6" class="form-control rounded-1 h-25 bg-light border-0">Salut! décris ton besoin ici. 😊</textarea>
                            </div>

                            <!-- <div class="mb-3">
                                <div class="preview">
                                    <h5>Prévisualisation :</h5>
                                    <img id="imagePreview" src="" alt="Prévisualisation">
                                </div>

                                <!-- Prendre une photo --
                                <div class="mb-3 text-center mx-auto">
                                    <button class="btn btn-primary mt-3" id="openCamera">Prendre une photo</button>
                                    <video id="camera" width="100%" height="auto" autoplay></video>
                                    <button class="btn btn-success mt-3" id="takePhoto" style="display:none;">Capturer</button>
                                </div>

                                <canvas id="take-photo" width="500" height="400"></canvas>

                            </div> -->


                            <!-- label -->
                            <div class="mb-3 text-center">
                                <h3 class="h5 fw-bold">Confirmer l’adresse du chantier</h3>
                            </div>
                            <!-- /label -->

                            <!-- champ adresse -->
                            <div class="input-group mb-3">  
                                <!-- <span class="input-group-text fa fa-map-marker fa-x pt-3 bg-white"></span> -->
                                <input id="address" type="search" name="lieu_inter"  autocomplete="off" placeholder="Saisissez votre adresse ou récupérer votre position" class="adress form-control border-white bg-light">
                                
                                <button type="button" id="location-button" class="btn rounded-end-1 text-dark bg-light border-white border-start-0">
                                    <!-- <i class="fa fa-crosshairs"></i> -->
                                    <img src="../../assets/icones/crosshair-black.png" width="30" alt="">
                                </button>
                                
                                <input type="hidden" id="selected_address" name="selected_address">

                                <div id="suggestions" class="bg-white text-dark z-1"></div>
                            </div>
                            <!-- /champ adresse -->


                            <!-- row -->
                            <div class="row">

                                <?php
                                    if (isset($_SESSION['prenomusager']) || isset($_SESSION['nomusager']) || isset($_SESSION['telusager'])) {
                        
                                ?>

                                    <!-- colonne 1 -->
                                    <div class="col-6 col-md-6 mb-3">
                                        <input type="text" name="" id="" placeholder="joe"  value="<?= $_SESSION['prenomusager']  ?>" class="input pt-2 pb-2 form-control bg-light border-dark border-2">
                                    </div>
                                    <!-- /colonne 1 -->

                                    <!-- colonne 2 -->
                                    <div class="col-6 col-md-6 mb-3">
                                        <input type="text" name="" id="" placeholder="kabongo"  value="<?= $_SESSION['nomusager']  ?>" class="input pt-2 pb-2 form-control bg-light">
                                    </div>
                                    <!-- /colonne 2 -->

                                    <!-- colonne 1 -->
                                    <div class=" mb-3">
                                        <input type="tel" id="phone" name="compteUsager" value="<?= $_SESSION['telusager']  ?>" class="form-control pt-2 pb-2 border-dark border-2" placeholder="Numéro de téléphone">
                                    </div>

                                <?php
                                    }else{
                                ?>

                                    <!-- colonne 1 -->
                                    <div class="col-6 col-md-6 mb-3">
                                        <input type="text" name="" id="" placeholder="joe"  class="input pt-2 pb-2 form-control bg-light border-dark border-2">
                                    </div>
                                    <!-- /colonne 1 -->

                                    <!-- colonne 2 -->
                                    <div class="col-6 col-md-6 mb-3">
                                        <input type="text" name="" id="" placeholder="kabongo" class="input pt-2 pb-2 form-control bg-light">
                                    </div>
                                    <!-- /colonne 2 -->

                                    <!-- colonne 1 -->
                                    <div class=" mb-3">
                                        <input type="tel" id="phone" name="compteUsager" class="form-control pt-2 pb-2 border-dark border-2" placeholder="Numéro de téléphone">
                                    </div>

                                <?php
                                    }
                                ?>
                               
                                <!-- /colonne 1 -->

                                <div class="mt-3 mb-5">
                                    <div class="row">
                                        <div class="col">
                                            <label for="intervention-time" class="form-label">A quand l’intervention ?</label>
                                        </div>
                                            
                                        <div class="col">
                                            <div class="custom-datetime">
                                                <button id="now-button">
                                                    <img src="https://img.icons8.com/material-rounded/24/000000/clock.png" alt="clock-icon">
                                                    Maintenant
                                                </button>
                                                <input type="datetime-local" name="dateIntervention" class="form-control" id="intervention-time">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /row -->

                            <!-- hidden value -->
                            <input type="hidden" name="prestataire" value="<?= $prestataire ?>">
                            <input type="hidden" name="compteUsager" value="<?= $retval = (!empty($_SESSION['key_compte'])) ? $_SESSION['key_compte'] : '' ; ?>">
                            <input type="hidden" name="cout_inter" value="<?= '10' ?>">

                            <!-- contrainte -->
                            <input type="hidden" name="action" value="definirIntervention">

                            <!-- bouton envoyer votre commande -->
                            <div class="mt-3 mb-3 text-center">
                                <button type="submit" class="btn btn-primary fw-bold pt-3 pb-3 rounded-5">
                                    Envoyez votre commande 
                                </button>
                            </div>
                            <!-- /bouton envoyer votre commande -->
                        </div>
                        <!-- /container -->
                    </div>
                    <!-- /colonne 1 -->
                </div>
                <!-- /row -->
            </form>           
            
            <div class="col-12 col-md-9">
                <div class="index-btn-wrapper  container-fluid mb-5 justify-content-end">
                    <div class="index-btn rounded-5" onclick="run(1, 2);">Suivant</div>
                </div>
            </div>

    
        </div>
        <!-- /tabl panel 1 ce panel contient les détails sur la commande -->

        <!-- tab panel 2 ce panel contient le formulaire de choix du technicien/ourier-->
        <div class="tab" id="tab-2">

            <div class="text-center col-11 col-md-5 mx-auto shadow rounded-4 pt-5 pb-5 mb-5">

                <div class="container rounded-3 bg-light text-center col-8 col-md-8 pt-3 pb-3">
                    Félicitations ! 
                    votre commande est enregistrée avec succès, choisissez maintenant votre technicien
                </div>

                <div class="mt-5 pt-3 mb-5 text-center">
                    <h5>Vous avez choisi le prestataire</h5>
                </div>

                <?php
                    // Nous récupérons les informations du prestataire sélectionné
                    $stmt_prest = $objPrest->selectionnePrestataire("idprestataire",$prestataire);

                    // Nous allons parcourir les informations au moyen de la boucle while
                    while ($donnes_prest = $stmt_prest->fetch()) {
                        // récupération des informations
                        $nom_prestataire = $donnes_prest['nomprestataire'];
                        $description     = $donnes_prest['description'];
                        $telephone       = $donnes_prest['telprestataire'];
                ?>
                    <img src="../../assets/index.png" width="90" height="90" class="rounded-circle shadow-sm" alt="">
                    <!-- name section -->
                    <div class="mt-3 mb-5">
                        <h5 class="fw-bold"><?= $nom_prestataire ?></h5>
                        <span class="d-block"><?= $description ?></span>
                        <span class="d-block"><?= $telephone ?></span>
                    </div>
                    <!-- /name section -->
                <?php
                    }
                ?>

                
                <div class="index-btn-wrapper container-fluid justify-content-between pt-3 mt-3 mb-0">
                    <div class="index-btn  rounded-5" onclick="run(2, 1);">Précédent</div>
                    <div class="index-btn  rounded-5" onclick="run(2, 3);">Suivant</div>
                </div>
            </div>
                    
        </div>
         <!-- /tab panel 2 ce panel contient le formulaire de choix du technicien/ourier-->

        <!-- tab panel 3 ce panel contient la sélection des modes de paiement -->
        <div class="tab" id="tab-3">
            <div class="text-center col-11 col-md-5 mx-auto shadow rounded-4 pt-5 pb-5 mb-5">
                <div class="container rounded-3 bg-light text-center col-8 col-md-8 pt-3 pb-3">
                    Félicitations ! 
                    votre commande est encours de traitement, les frais de placement est de 10% de votre commande.
                </div>

                <div class="container pt-3 pb-3">
                    <h5 class="fw-bold">
                        Vous devez payez les frais, pour recevoir les coordonnées des ouvriers et les voir 
                        atterrir chez vous
                    </h5>

                    <p class="small text-muted">
                        La plateforme maintecas utilise maxicash comme passerelle de paiement, utilisez vos 
                        modes de paiements habituels, M-pesa, Orange money, rakkacash, visa.
                    </p>

                    <!-- paiement api -->
                    <form action="https://api-testbed.maxicashapp.com/PayEntryPost" method="POST">
                        <input type="hidden" name="PayType" value="MaxiCash">
                        <input type="hidden" name="Amount" value="<?= ('10'.'00')  ?>">
                        <input type="hidden" name="Currency" value="USD">
                        <input type="hidden" name="Telephone" value="<?=($_SESSION['telusager'])  ?>">
                        <input type="hidden" name="Email" value="<?=($_SESSION['emailusager'])?>">                                       
                        <input type="hidden" name="MerchantID" value="c1a7768d1d0a4146b51e3ad307f5a3c4">
                        <input type="hidden" name="MerchantPassword" value="e4b83c9d3086434c9c21e200b2ad7fe1">
                        <input type="hidden" name="Language" value="Fr">
                        <input type="hidden" name="Reference" value="<?=('983837') ?>">
                        
                        <input type="hidden" name="accepturl" value="https://australdrc.com/maintecas/successed.php?email=<?=($mail_client) ?>&montant=<?=($total_cmd) ?>&commande=<?=($num_cmd) ?>&mode=<?=('MaxiCash') ?>=a=1">
                        
                        <input type="hidden" name="cancelurl" value="https://australdrc.com/maintecas/action.php?email=<?=($mail_client) ?>&montant=<?=($total_cmd) ?>&a=2">
                            
                        <input type="hidden" name="declineurl" value="https://australdrc.com/maintecas/action.php?email=<?=($mail_client) ?>&montant=<?=($total_cmd) ?>">
                        
                        <input type="hidden" name="notifyurl" value="hhttps://australdrc.com/maintecas/action.php?email=<?=($mail_client) ?>&montant=<?=($total_cmd) ?>&a=4">
                            
                        <div class="text-center mb-5">
                            <button type="submit"  class="btn btn-primary rounded-0">confirmer le paiement</button>
                        </div>
                    </form>
                    <!-- /paiement api -->





                </div>

                <div class="index-btn-wrapper container-fluid justify-content-between mb-0">
                    <div class="index-btn rounded-5" onclick="run(3, 2);">Précédent</div>
                    <div class="index-btn rounded-5" onclick="run(3, 4);">Suivant</div>
                </div>
            </div>


           <div class="alert-msg"></div>
        
            
        </div>
        <!-- /tab panel 3 ce panel contient la sélection des modes de paiement -->
              
        <div class="tab" id="tab-4">
            <div class="text-center col-11 col-md-5 mx-auto shadow rounded-4 pt-5 pb-5 mb-5">
                <div class="index-btn-wrapper container-fluid justify-content-between mb-5">
                    <div class="index-btn rounded-5" onclick="run(4, 3);">Précédent</div>
                    <button class="index-btn bg-primary rounded-5" name="send" type="submit">Valider</button>
                </div>
            </div>
        </div>
       
    <!-- </form> -->
</div>


<!-- slider -->
<script src="../styles/slider/js/script.js"></script>
<script src="../styles/slider/js/swiper-bundle.min.js"></script>
<script>
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
      SuivantEl: ".swiper-button-Suivant",
      prevEl: ".swiper-button-prev",
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