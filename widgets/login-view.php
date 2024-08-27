<div class="container">
<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <!-- <h1 class="h4 text-gray-900 mb-4">Heureux de te revoir</h1> -->
                            </div>
                            <form action="src/traitement/mt-connexion.php" class="user" method="post" enctype="multipart/form-data">
                               
                                <?php
                                    // echo $_SESSION['telephone'];
                                    // echo $_SESSION['authentification'];

                                    if (isset($_SESSION['authentification'])) {
                                        ?>
                                            <div class="form-group mb-3">
                                                <input type="text" name="username" value="<?= $_SESSION['authentification']?>" class="form-control rounded-5 pt-3 pb-3 form-control-user"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Entrer l'adresse email ou votre téléphone...">
                                            </div>

                                        <?php
                                    }else{
                                        ?>
                                            <div class="form-group mb-3">
                                                <input type="text" name="username" class="form-control rounded-5 pt-3 pb-3 form-control-user"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Entrer l'adresse email ou votre téléphone...">
                                            </div>

                                        <?php
                                    }
                                ?>

                                
                                <!-- <div class="form-group mb-3">
                                    <input type="password" name="password" class="form-control rounded-5 pt-3 pb-3 form-control-user"
                                        id="exampleInputPassword" placeholder="Password">
                                </div> -->
                                <div class="form-group mb-3 text-muted">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-dark col-12 col-md-12 rounded-5 pt-3 pb-3 btn-user btn-block">
                                    Login
                                </button>
                                <hr>
                                <a href="index.html" class="btn btn-danger col-12 col-md-12 mb-3 rounded-5 pt-3 pb-3 btn-user btn-block">
                                    <i class="fa fa-google fa-fw"></i> Login with Google
                                </a>
                                <a href="index.html" class="btn btn-primary col-12 col-md-12 mb-3 rounded-5 pt-3 pb-3 btn-user btn-block">
                                    <i class="fa fa-facebook fa-fw"></i> Login with Facebook
                                </a>

                                <!-- contraine -->
                                <input type="hidden" name="action" value="connexion">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small btn-link text-decoration-none" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small btn-link text-decoration-none" href="register.html">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- Outer Row -->
</div>