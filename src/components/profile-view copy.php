<!-- navbar -->
<div class="mb-0 d-flex justify-content-between border-bottom pb-3 fixed-top mb-5 bg-dark">
     <a href="./technicien.php" class="btn btn-outline-light border-0 mt-3">
        <!-- <img src="../assets/arrow.png" width="30" alt=""> -->
        <i class="fa fa-chevron-left"></i>
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

<!-- main content -->
<div class="mt-5 pt-3">
    <?php
        while ($data = $stmt->fetch()) {
            $nom_prestataire      = $data['nomprestataire'];
            $presentation         = $data['presentation'];
            $disponibilite        = $data['libdispo'];
            $_SESSION['audience'] = $data['note'];
    ?>
        <!-- avatar -->
        <div class="bg-light  shadow border-bottom pb-4">
            <div class="text-muted pt-3 border-bottom pb-3 container">
                <!-- <img avatar="<?=$nom_prestataire?>" width="100" height="100" class="rounded-circle me-1 shadow-lg" alt=""> -->
                <img src="../../assets/index.png" width="100" height="100" class="rounded-circle me-1 shadow-lg" alt="">
                            
                <p class="pb-3 mb-0 small lh-sm">
                    <strong class="d-block text-gray-dark pt-3 fs-5"><?= $nom_prestataire?></strong>
                    <?= $presentation?>
                </p>
            </div>

            <!-- disponibilité -->
            <div class="text-muted pt-1 pb-1 container">
                Disponibilité : <?= $disponibilite?>
            </div>
            <!-- /disponibilité -->

            <!-- rate -->
            <div class="mt-3 container mb-3 text-start">
                <?php
                    for ($i=0; $i < 5 ; $i++) { 
                        echo '<i class="fa fa-star text-warning"></i>';
                    }
                ?>
                (1)
            </div>
            <!-- /rate -->
        </div>
        <!-- /avatar -->

        <!-- titre -->
        <div class="container mt-5 mb-3">
            <hr>
            <h5>Services</h5>
            <hr>
        </div>
        <!-- /titre -->

        <!-- slider service -->
        <div id="horizontal-nav" class="container pb-5">
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
                        // while
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

        <!-- link btn -->
        <div class="container pt-4">
            <btn type="button" data-bs-toggle="modal" data-bs-target="#modalCommande" class="btn btn-dark rounded-5">
                Intervention maintenant
            </btn>

            <btn type="button" data-bs-toggle="modal" data-bs-target="#modalCommande" class="btn btn-dark rounded-5">
                Intervention plus tard
            </btn>

            <btn type="button" data-bs-toggle="modal" data-bs-target="#modalAvisCompte" class="btn btn-light border rounded-5">
                Voir les avis
            </btn>
        </div>
        <!-- /link btn -->


    <?php
        }
    ?>
</div>
<!-- /main content -->