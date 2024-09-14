<?php
    // récupération des données passées en paramètre dans l'URL
    $id                           = htmlspecialchars($_GET['id']);
    $info                         = htmlspecialchars($_GET['info']);
    $_SESSION['service_en_cours'] = htmlspecialchars($_GET['info']);

?>
<!-- navbar retour-->
<div class="pt-3 pb-3 mb-1 bg-primary text-white shadow-sm">
    <span class="container display-6">Prestataire <?= $info ?></span>
</div>
<!-- /navbar retour -->

<!-- container-fluid -->
<div class="container-fluid shadow">
    <!-- load data -->
    <div id="result_profiles_services"></div>
    <!-- /load data -->
</div>
<!-- /container-fluid --> 