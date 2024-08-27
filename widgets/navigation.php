<div class="pt-0">
        <!-- partial:index.partial.html -->
        <nav class="navbar navbar-dark bg-dark" aria-label="First navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" style="font-size: 12px;" href="index.php">Maintecas</a>

                <div>

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

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample01">
                    <ul class="navbar-nav me-auto mb-2">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="trouve.php">Trouver un technicien</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="technicien.php">Devenir un technicien</a>
                        </li>
                        <li class="nav-item">
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
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- partial -->
    </div>