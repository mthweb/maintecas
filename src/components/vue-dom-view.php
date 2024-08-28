<?php
    // récupération des données passées en paramètre dans l'URL
    $id                           = htmlspecialchars($_GET['id']);
    $info                         = htmlspecialchars($_GET['info']);
    $_SESSION['service_en_cours'] = htmlspecialchars($_GET['info']);

?>
<!-- navbar retour-->
<div class="d-flex pb-3 mb-1 bg-dark shadow-sm">
    <a href="./collection.php" class="btn text-white border-0 mt-3 me-3">
        <i class="fa fa-chevron-left me-2"></i>
        <!-- <img src="../assets/arrow.png" width="30" alt=""> -->
        <span class="fw-bold"><?= $info ?></span>
    </a>

    <!-- label -->
    <div class="text-center pt-4"></div>
    <!-- /label -->

    <!-- /label -->
    <div class=""></div>
    <!-- /label -->
</div>
<!-- /navbar retour -->

<!-- container-fluid -->
<div class="container-fluid shadow">
    <!-- load data -->
    <div id="result_profiles_services"></div>
    <!-- /load data -->
</div>
<!-- /container-fluid -->