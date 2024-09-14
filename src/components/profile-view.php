<?php 
    // include_once('../content/head.php');
    // récupération des données du compte prestataire, pour vérifier
    // si et seulement si il a un compte prestataire, si oui on l'
    // affiche comme sous compte, pour ce faire on importe le controller
    include_once('../controllers/cnx.php');
    include_once('../controllers/prestataireController.php');
    include_once('../controllers/selectionnerController.php');
    include_once('../controllers/rendreController.php');

    $objCnx  = new cnx();
    $objPres = new prestataireControleur();
    $objSel  = new selectionnerControleur();
    $objRen  = new rendreControleur();

    // Nous récupérons l'Id qui a été renvoyée par le script, cet id
    // permettra et rendra plus simple la récupération des informations
    // du client
    $id_get = htmlentities($_GET['id']);

    // récupération des informations du prestataire sélectionné
    // nous allons appelé le controller du prestataire pour avoir
    // toutes les données sauvegardées par celui-ci lors de la
    // configuration
    $stmt = $objPres->selectionnePrestataire("idprestataire",$id_get);

    // nous récupérons également les modes de paiements qu'utilise 
    // le profile sélectionné
    $stmt_mp = $objSel->AfficherSelectionParCompte($id_get);

    // Nous récupérons tous les services que rend le profil sélectionné
    $stmt_service = $objRen->selectionneRendu('employe',$id_get);
?>



<div class="profile-container pt-5 mere" style="background-image: url('../../assets/images/Image-maintecas.png'); height: 15em; background-size: cover; font-family: cursive;">
        <?php
            $data = $stmt_service->fetch();
                $id_prestataire       = $data['idprestataire'];
                $nom_prestataire      = $data['nomprestataire'];
                $presentation         = $data['presentation'];
                // $disponibilite        = $data['libdispo'];
                $description          = $data['description'];
                $zone_intervention    = $data['zone_intervention'];
                $note                 = $data['note'];
                $service              = $data['libserv'];
        ?>
        
        <!-- Profile Header -->
        <div class="profile-header mt-5 pt-2 text-center text-md-start container">
            <img src="../../assets/index.png" alt="Profile Picture" width="150"  class="mt-5 pt-0 shadow rounded-circle">
            
            <!-- row -->
            <div class="row">
                <!-- colonne 1 -->
                <div class="col-12 col-md-6">
                    <h5 class="mt-2 d-block d-md-flex">
                        <span class="display-6 me-5 text-md-start text-center"><?= $nom_prestataire ?></span>
                        <div class="pt-2">
                            <span class="badge bg-danger">PRO</span>
                            <span class="badge text-danger">154 MOIS</span>
                        </div>
                    </h5>
                    <p class="fw-bold"><?= $description ?></p>
                    <p class="fw-bold mb-3"><?= $service ?></p>                   

                    <div class="mt-3 mb-3">
                        <span>
                            <strong><?= number_format($note,1) ?></strong> 
                            
                            <?php
                                for ($i=0; $i < 5; $i++) { 
                                    echo '<i class="fa fa-star bg-success text-white me-1 p-1 small rounded"></i>';
                                }
                            ?>

                            - 10 Evaluations
                        </span>
                    </div>

                    <p class="small">
                        <span class="bg-light p-2 rounded-circle"><img src="../../assets/icones/map.png" width="20" alt=""></span> 
                        <?= $zone_intervention ?>
                    </p>
                </div>
                <!-- /colonne 1 -->

                <!-- colonne 2 -->
                <div class="col-12 col-md-6 text-md-end">
                    <!-- row -->
                    <div class="row pt-3 pb-3 mt-2 mb-2">
                        <div class="col">
                            <span class="fw-bold d-block">123 K</span>
                            <span class="small fw-light">vues</span>
                        </div>

                        <div class="col">
                            <span class="fw-bold d-block">123 K</span>
                            <span class="small fw-light">j'aimes</span>
                        </div>

                        <div class="col">
                            <span class="fw-bold d-block">123 K</span>
                            <span class="small fw-light">sur 100 000</span>
                        </div>
                    </div>
                    <!-- /row -->

                    <!-- statut -->
                    <!-- <div class="status-container2 container">
                        <div class="status-circle2"></div>
                        <div class="status-text2 ">
                            <strong>Disponible</strong> – <em>connecté il y a 36 minutes</em>
                        </div>
                    </div> -->

                    <div class="d-flex mb-3 pb-3 text-center float-md-end">
                        <div class="online-status text-start">
                            <span class="status-dot bg-dark"></span>
                            <span class="text-dark fw-light">Disponible <em>connecté il y a 36 minutes</em> </span>
                        </div>
                    
                        
                    </div>

                    <!-- commandes -->
                    <div class="d-flex justify-content-end container mt-5 mb-5">
                        <button class="btn btn-light rounded-5 col-3 col-md-2 me-2 pt-3 pb-3">
                            <i class="fa fa-heart-o fa-x"></i>
                        </button>

                        <div class="dropdown">
                            <button class="btn btn-primary rounded-5 dropdown-toggle pt-3 pb-3" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Commander un service
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><h6 class="dropdown-header">Selectionner votre besoin</h6></li>
                                <li><a class="dropdown-item" href="details-commande.php?id=<?= $id_prestataire ?>&text=<?= sha1($id_prestataire) ?>&info=<?= $nom_prestataire ?>">Demander un service</a></li>
                                <li><a class="dropdown-item" href="details-commande.php">Demander un dévis</a></li>
                                <!-- <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                            </ul>
                        </div>
                    </div>
                    <!-- /commandes -->
                     
                </div>
                <!-- /colonne 2 -->
            </div>
            <!-- /row -->
              
        <br>
                              
        </div>

             <!-- navigation -->
        <nav class="container bg-white">
            <div class="nav nav-tabs active bg-transparent nav-underline mb-0" id="nav-tab" role="tablist">
                <div class="nav-scroller bg-transparent">
                    <nav class="nav nav-underline bg-transparent" aria-label="Secondary navigation">
                        
                        <button class="nav-link me-3 active border-top-0 border-start-0 border-end-0 bg-transparent" aria-current="page" id="nav-presentation-tab" data-bs-toggle="tab" data-bs-target="#nav-presentation" type="button" role="tab" aria-controls="nav-presentation" aria-selected="true">
                            Présentation
                        </button>

                        <button class="nav-link me-3 border-top-0 border-start-0 border-end-0 bg-transparent" id="nav-evaluation-tab" data-bs-toggle="tab" data-bs-target="#nav-evaluation" type="button" role="tab" aria-controls="nav-evaluation" aria-selected="false">
                            Evaluation
                        </button>

                        <button class="nav-link me-3 border-top-0 border-start-0 border-end-0 bg-transparent" id="nav-reference-tab" data-bs-toggle="tab" data-bs-target="#nav-reference" type="button" role="tab" aria-controls="nav-reference" aria-selected="false">
                            Référence
                        </button>

                        <button class="nav-link me-3 border-top-0 border-start-0 border-end-0 bg-transparent" id="nav-recommandations-tab" data-bs-toggle="tab" data-bs-target="#nav-recommandations" type="button" role="tab" aria-controls="nav-recommandations" aria-selected="false">
                            Recommandations
                        </button>
                        
                        <button class="nav-link me-3 border-top-0 border-start-0 border-end-0 bg-transparent" href="#" id="nav-formations-tab" data-bs-toggle="tab" data-bs-target="#nav-formations" type="button" role="tab" aria-controls="nav-formations" aria-selected="false">
                            Formations
                        </button>

                        <button class="nav-link me-3 border-top-0 border-start-0 border-end-0 bg-transparent" id="nav-interventions-tab" data-bs-toggle="tab" data-bs-target="#nav-interventions" type="button" role="tab" aria-controls="nav-interventions" aria-selected="false">
                            Interventions
                        </button>
                        
                    
                        <!-- <button class="nav-link border-top-0 border-start-0 border-end-0 bg-transparent" href="#">
                            Link
                        </button>
                       
                        <button class="nav-link border-top-0 border-start-0 border-end-0 bg-transparent" href="#">
                            Link
                        </button>
                        
                        <button class="nav-link border-top-0 border-start-0 border-end-0 bg-transparent" href="#">
                            Link
                        </button> -->
                    </nav>
                </div>
            </div>
        </nav>
        <!-- navigation -->
     
       

        <!-- row -->
        <div class="row">
            <!-- colonne 1 -->
            <div class="col-12 col-md-8  bg-light">
                <!-- panel section -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- presentation -->
                    <div class="tab-pane fade show active text-start pt-5 pb-5" id="nav-presentation" role="tabpanel" aria-labelledby="nav-presentation-tab">
                        <!-- container -->
                        <div class="container-fluid text-muted">
                            <?= $presentation ?>
                        </div>
                        <!-- /container -->
                    </div>
                    <!-- /presentation -->

                    <!-- evaluation -->
                    <div class="tab-pane text-start bg-light pt-5 pb-5 fade" id="nav-evaluation" role="tabpanel" aria-labelledby="nav-evaluation-tab">
                        <!-- container -->
                        <div class="container-fluid text-muted">
                            <?= $presentation ?>
                        </div>
                        <!-- /container -->
                    </div>            
                    <!-- /evaluation -->

                    <!-- Référence -->
                    <div class="tab-pane fade text-start bg-light pt-5 pb-5" id="nav-reference" role="tabpanel" aria-labelledby="nav-reference-tab">
                        Référence
                    </div>            
                    <!-- /Référence -->

                    <!-- Recommandations -->
                    <div class="tab-pane fade text-start bg-light pt-5 pb-5" id="nav-recommandations" role="tabpanel" aria-labelledby="nav-recommandations-tab">
                        recommandations
                    </div>            
                    <!-- /Recommandations -->

                    <!-- Formations -->
                    <div class="tab-pane fade text-start bg-light pt-5 pb-5" id="nav-formations" role="tabpanel" aria-labelledby="nav-formations-tab">
                        Formation
                    </div>            
                    <!-- /Formations -->

                    <!-- interventions -->
                    <div class="tab-pane fade text-start bg-light pt-5 pb-5" id="nav-interventions" role="tabpanel" aria-labelledby="nav-interventions-tab">
                        Intervention
                    </div>            
                    <!-- /interventions -->

                </div>
                <!-- /partial -->                   
            </div>
            <!-- /colonne 1 -->

            <!-- colonne 2 -->
            <div class="col-12 col-md-4 pt-5 pb-5 bg-light">
                <!-- card -->
                <div class="card text-center rounded-3 pt-3 pb-3 mb-4 border-0 shadow container">
                    <h5 class="fw-bold">Indices d'activité</h5>
                    <span class="d-block small text-muted">sur 30 derniers jours</span>

                    <div class="card-body">
                        <!-- Conteneur des statistiques -->
                        <div class="stat-container">
                            <!-- Attractivité -->
                            <div class="stat-item">
                                <div class="stat-circle attractivite">
                                    <span>73</span>
                                </div>
                                <p class="stat-description">Attractivité</p>
                            </div>
                            <!-- Réactivité -->
                            <div class="stat-item">
                                <div class="stat-circle reactivite">
                                    <span>—</span>
                                </div>
                                <p class="stat-description">Réactivité</p>
                            </div>
                            <!-- Disponibilité -->
                            <div class="stat-item">
                                <div class="stat-circle disponibilite">
                                    <span>91</span>
                                </div>
                                <p class="stat-description">Disponibilité</p>
                            </div>
                        </div>

                        <!-- Bouton Demander un devis -->
                        <button class="btn btn-primary rounded-5 pt-3 pb-3 col-12">Demander un devis</button>
                    </div>
                </div>
                <!-- /card -->

                <!-- Statistiques -->
                <div class="profile-card">
                    <div class="profile-header">Statistiques</div>
                    <div class="profile-subtext">depuis la création du compte</div>
                    <div class="profile-info">
                        <p>Projets réalisés <span class="float-end">43 projets</span></p>
                        <p>Projets terminés <span class="float-end">97%</span></p>
                        <p>Tarif horaire moyen <span class="float-end">50 €</span></p>
                        <p>Dernière connexion <span class="float-end">23 heures</span></p>
                        <p>Membre depuis <span class="float-end">Jan. 2022</span></p>
                        <p>Profil vu <span class="float-end">3 562 fois</span></p>
                    </div>
                </div>

                <!-- Vérifications -->
                <div class="profile-card">
                    <div class="profile-header">Vérifications</div>
                    <div class="profile-info">
                        <p>Pièce d'identité <span >(Validée <img src="https://upload.wikimedia.org/wikipedia/en/c/c3/Flag_of_France.svg" alt="FR" width="16px">)</span> 
                            <i class="verify-icon fa fa-check-circle float-end"></i></p>
                        <p>Adresse email 
                            <i class="verify-icon fa fa-check-circle float-end"></i></p>
                        <p>N° de téléphone <span>(+3365...)</span> 
                            <i class="verify-icon fa fa-check-circle float-end"></i></p>
                        <p>Compte Facebook 
                            <i class="non-verified-icon fa fa-times-circle float-end"></i></p>
                        <p>Compte LinkedIn 
                            <i class="verify-icon fa fa-check-circle float-end"></i></p>
                    </div>
                    <p class="profile-subtext">Vérifiez toujours l'identité du prestataire avant de commencer un projet.</p>
                </div>

                <!-- Partager ce profil -->
                <div class="profile-card text-center">
                    <div class="profile-header">Partagez ce profil</div>
                    <div class="social-icons pt-3">
                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="email"><i class="fa fa-envelope"></i></a>
                    </div>
                </div>

                <!-- Signaler un profil -->
                <div class="btn btn-outline-link border-secondary col-12 col-md-12">🚩 Signaler ce profil</div>

            </div>
            <!-- /colonne 2 -->
        </div>
        <!-- /row -->
        </div>

        

        <!-- Profile Footer -->
        <!-- <div class="profile-footer pt-5 ">
            <span>Bénéficiez du service de Michée Mayenikini</span>
            <div class="close-icon fa-x">&times;</div>


            <!-- Buttons Section --
            <div class="text-center text-md-center  mt-3">
                <button class="btn btn-primary d-block col-12 col-md-6 mb-3 rounded-5 mx-auto">Commander un service</button>
                <button class="btn btn-light d-block col-12 col-md-6 mb-3 rounded-5 mx-auto">Demander un Devis</button>
            </div>


        </div> -->
    </div>
    <?php
        // }
    ?>