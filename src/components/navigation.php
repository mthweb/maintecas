
<div class="pt-5 mb-0">
        <!-- partial:index.partial.html -->
        <nav class="navbar pb-3 navbar-dark fixed-top fw-bold" aria-label="First navbar example" style="background-color: rgba(0, 0, 0, 0.5);">
            
            <div class="container-fluid">
                <a class="navbar-brand" href="../../index.php">Maintecas</a>

                <div style=" display: flex;justify-content: space-between;align-items: center; padding: 10px 20px;">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <img avatar="<?= $_SESSION['nomusager'].' '. $_SESSION['prenomusager'];?>" class="me-3 rounded-circle" width="35" height="35" alt="">

                    <!-- <div class="circle">
                        M
                    </div> -->
                </div>

            
                <div class="collapse navbar-collapse bg-white shadow-sm rounded container-fluid" id="navbarsExample01">
                    <ul class="navbar-nav me-auto mb-2 pt-3 sha">
                        <li><h6 class="dropdown-header">Mon compte</h6></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-lock text-dark"></i> Mes infos de connexion</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-phone text-dark"></i> Mes coordonnées</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-bell text-dark"></i> Mes alertes email</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-file text-dark"></i> Mes factures</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-credit-card text-dark"></i> Ma carte bancaire</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><h6 class="dropdown-header">Mes projets</h6></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-briefcase text-dark"></i> Gérer mon projet</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-plus-circle text-dark"></i> Créer un nouveau projet</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-heart text-dark"></i> Mes profils favoris</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><h6 class="dropdown-header">Aide & Support</h6></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-question-circle text-dark"></i> Questions fréquentes</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-envelope text-dark"></i> Nous contacter</a></li>
                    </ul>

                    <div class="mt-3 mb-3 border-bottom">
                        
                    </div>

                    <div class="pb-3">
                        <a href="../../modules/deconnexion.php" class="btn btn-light text-danger bg-transparent border-0 dropdown-item">
                            <i class="fa fa-sign-out text-danger"></i>
                            Se déconnecter
                        </a>
                    </div>
                </div>

              
            </div>
        </nav>
        <!-- partial -->
    </div>