<div class="container">
    <a href="#" class="text-dark mb-5">
        <!-- <img src="../../assets/arrow.png" width="25" alt=""> -->
        <i class="fa fa-chevron-left"></i>
    </a>
    <h2 class="mt-3">Afficher</h2>
    <p><strong>Vous recherchez quel type de techniciens ?</strong></p>

    <form id="categorieFiltre" method="post"  style="overflow-y: scroll; height:9em;scrollbar-color:rgb(100,100,100) rgb(45,45,45); scrollbar-width: thin;">
        <?php
            include_once('../controllers/categorieController.php');
            include_once('../controllers/cnx.php');

            $objCat = new categorieControleur();

            $stmt =  $objCat->selectionneCategorieTous();

            while ($donnees = $stmt->fetch()) {    
        ?>
            <div class="radio-option bg-light pt-3 pb-3 container rounded mb-3">
                <label for=""><?= $donnees['libcat'] ?></label>
                <input type="radio" name="technicien" id="" value="<?= $donnees['libcat'] ?>" class="float-end" checked>
            </div>
        <?php
            }
        ?>

        <div class="radio-option bg-light pt-3 pb-3 container rounded mb-3">
            <label for="tous">Tout le monde</label>
            <input type="radio" name="technicien" id="tous" class="float-end">
        </div>

        <!-- contrainte -->
        <input type="hidden" name="action" value="filtreCategorie">

    </form>

  
    <div class="text-center">
        <button class="btn btn-dark rounded-5 col-md-5 mt-3 ">OK</button>
    </div>
</div>