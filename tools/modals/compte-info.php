<div class="modal fade" id="compteInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-dark">
                <!-- avatar section -->
                <div class="d-flex border-bottom mb-3 pb-4">
                    <img avatar="<?= $_SESSION['nomusager'].' '. $_SESSION['prenomusager'];?>" class="me-3 rounded-circle" width="50" height="50" alt="">
                    <div>
                        <?= $_SESSION['nomusager'].' '. $_SESSION['prenomusager'];?>
                        <span class="d-block small"><?= $_SESSION['emailusager'];?></span>
                        <span class="small"><?= $_SESSION['telusager'];?></span>
                    </div>
                </div>
                <!-- /avatar section -->

                <!-- fonctionnalité compte -->
                <div>
                    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
                        
                        <div class="list-group list-group-flush border-bottom scrollarea">
                            
                            <a href="contact.php" class="list-group-item list-group-item-action py-3 lh-tight">
                                <div class="d-flex w-100 align-items-center">
                                    <i class="fa fa-envelope me-2"></i>
                                    <strong class="">Messagerie</strong>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action py-3 lh-tight">
                                <div class="d-flex w-100 align-items-center">
                                    <i class="fa fa-user me-2"></i>
                                    <strong class="">Compte</strong>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action py-3 lh-tight">
                                <div class="d-flex w-100 align-items-center">
                                    <i class="fa fa-cog me-2"></i>
                                    <strong class="">Paramètres</strong>
                                </div>
                            </a>

                            <a href="modules/deconnexion.php" class="list-group-item list-group-item-action py-3 lh-tight">
                                <div class="d-flex w-100 align-items-center">
                                    <i class="fa fa-sign-out me-2"></i>
                                    <strong class="">Déconnexion</strong>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /fonctionnalité compte -->

            </div>
            
            <div class="modal-footer">
                
            </div>

        </div>
    </div>
</div>