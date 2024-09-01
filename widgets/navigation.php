
<div class="pt-5 mb-0">
        <!-- partial:index.partial.html -->
        <nav class="navbar navbar-dark fixed-top fw-bold" aria-label="First navbar example" style="background-color: rgba(0, 0, 0, 0.5);">
            
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Maintecas</a>

                <div class="">

                <?php
                    if (isset($_SESSION['user_session'])) {
                        ?>
                            <a href="#compteInfo" data-bs-toggle="modal" class="btn btn-light btn-sm rounded-5">
                                <?= $_SESSION['prenomusager'].' '.$_SESSION['nomusager'] ?> <i class="fa fa-chevron-down"></i>
                            </a>
                        <?php
                    }else{
                        ?>
                            <a href="login.php" class="btn btn-transparent btn-sm text-white rounded-5">
                                Connexion
                            </a>

                            <a href="inscription.php" class="btn btn-light btn-sm rounded-5">
                                S'inscrire
                            </a>
                        <?php
                    }
                ?>
                    
                </div>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse bg-black" id="navbarsExample01">
                    <ul class="navbar-nav me-auto mb-2">
                        <!-- vue -->
                        <div class="container-fluid bg-transparent pt-4 pb-5">
                            <nav class="">
                                <div class="nav nav-tabs mb-3 border-bottom-0" id="nav-tab" role="tablist">
                                    <button class="nav-link active border-start-0 border-top-0  rounded-0 bg-transparent text-uppercase" id="nav-particulier-tab" data-bs-toggle="tab" data-bs-target="#nav-particulier" type="button" role="tab" aria-controls="nav-particulier" aria-selected="true">
                                        Particuliers
                                    </button>

                                    <button class="nav-link bg-transparent text-uppercase border-top-0 border-bottom-0 rounded-0" onclick="location.href='../../maintecas-BtoB jesus-christ/index.php'" id="nav-entreprise-tab" data-bs-toggle="tab" data-bs-target="#nav-entreprise" type="button" role="tab" aria-controls="nav-entreprise" aria-selected="false">
                                        Entreprises
                                    </button>
                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active text-uppercase" id="nav-particulier" role="tabpanel" aria-labelledby="nav-particulier-tab">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Trouver un technicien</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Devenir un technicien</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Aide</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="fa fa-globe"></i> FR-FR
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Se connecter
                                        </a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">A propos</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                                            <li><a class="dropdown-item" href="#">A propos</a><hr class=""></li>
                                            <li><a class="dropdown-item" href="#">Nos services</a></li>
                                            <li><a class="dropdown-item" href="#">Fonctionnement de maintecas </a></li>
                                            <li><a class="dropdown-item" href="#">Impact</a></li>
                                            <li><a class="dropdown-item" href="#">Diversité, équité et inclusion</a></li>
                                            <li><a class="dropdown-item" href="#">Développement durable</a></li>
                                            <li><a class="dropdown-item" href="#">Relation avec les investisseurs</a></li>
                                            <li><a class="dropdown-item" href="#">Offres d’emploi</a></li>
                                        </ul>
                                    </li>

                                </div>

                              

                                <div class="tab-pane fade text-uppercase" id="nav-entreprise" role="tabpanel" aria-labelledby="nav-entreprise-tab">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Trouver une entreprise</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Travailler avec notre plateforme</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Gérer vos interventions sur terrains</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Aide</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="fa fa-globe"></i> FR-FR
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Se connecter
                                        </a>
                                    </li>

                                    <li class="nav-item dropdown ">
                                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">A propos</a>
                                        <ul class="dropdown-menu bg-transparent" aria-labelledby="dropdown01">
                                            <li><a class="dropdown-item" href="#">A propos</a><hr class=""></li>
                                            <li><a class="dropdown-item" href="#">Nos services</a></li>
                                            <li><a class="dropdown-item" href="#">Fonctionnement de maintecas </a></li>
                                            <li><a class="dropdown-item" href="#">Impact</a></li>
                                            <li><a class="dropdown-item" href="#">Diversité, équité et inclusion</a></li>
                                            <li><a class="dropdown-item" href="#">Développement durable</a></li>
                                            <li><a class="dropdown-item" href="#">Relation avec les investisseurs</a></li>
                                            <li><a class="dropdown-item" href="#">Offres d’emploi</a></li>
                                        </ul>
                                    </li>
                                </div>
                            </div>
                        </div>
                        <!-- /vue -->

                        <!-- <li class="nav-item">
                            <a class="nav-link" href="professionnel.php">Professionnel</a>
                        </li>
                    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">A propos</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown01">
                                <li><a class="dropdown-item" href="apropos.php">A propos</a><hr class=""></li>
                                <li><a class="dropdown-item" href="services.php">Nos services</a></li>
                                <li><a class="dropdown-item" href="fonctionnement.php">Fonctionnement de maintecas </a></li>
                                <li><a class="dropdown-item" href="impact.php">Impact</a></li>
                                <li><a class="dropdown-item" href="inclusion">Diversité, équité et inclusion</a></li>
                                <li><a class="dropdown-item" href="developpement.php">Développement durable</a></li>
                                <li><a class="dropdown-item" href="relation.php">Relation avec les investisseurs</a></li>
                                <li><a class="dropdown-item" href="emploi.php">Offres d’emploi</a></li>
                            </ul>
                        </li> -->
                    </ul>

                    <div class="alert alert-secondary bg-secondary text-white alert-dismissible fade show"  role="alert">
                        
                        <!-- notification -->
                        <div class="" style="font-family: roboto condensed;">
                            <!-- container -->
                            <div class=" text-center pt-3">
                                <!-- titre -->
                                <div class="mb-3">
                                    <h5>Maintecas fonctionne Mieux avec l'application</h5>
                                    <p class="small">
                                        Ouvrez l’application Maintecas pour accéder aux fonctionnalités.
                                    </p>
                                </div>
                                <!-- titre -->

                                <!-- lien -->
                                <div class="mb-3 d-flex justify-content-center">
                                    <a href="" class="btn btn-primary btn-sm bg-secondary me-2">Pas maintenant</a>
                                    <a href="" class="btn btn-dark btn-sm">Passer à l'application</a>
                                </div>
                                <!-- /lien -->                            
                            </div>
                            <!-- /container -->                        
                        </div>
                        <!-- /notification -->
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </nav>
        <!-- partial -->
    </div>