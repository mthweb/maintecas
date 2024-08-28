<div class="container">

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Créer un compte usager</h1>
                    </div>
                    <form class="user" method="post" id="inscriptionUsager">

                        <!-- message section -->
                        <div class="message-usager alert"></div>
                        <!-- /message section -->

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" name="prenom" class="form-control rounded-5 pt-3 pb-3 form-control-user" id="exampleFirstName"
                                    placeholder="Prénom">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <input type="text" name="nom" class="form-control rounded-5 pt-3 pb-3 form-control-user" id="exampleLastName"
                                    placeholder="Nom">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <input type="email" name="email" class="form-control rounded-5 pt-3 pb-3 form-control-user" id="exampleInputEmail"
                                placeholder="Addresse email">
                        </div>

                        <div class="form-group mb-3">
                            <input type="tel" name="telephone" class="form-control rounded-5 pt-3 pb-3 form-control-user" id="exampleInputEmail"
                                placeholder="téléphone">
                        </div>
                       
                        
                        <button type="submit" class="btn btn-dark rounded-5 pt-3 pb-3 col-12 col-md-12 btn-user btn-block">
                            créer le compte
                        </button>

                        <hr>

                        <input type="hidden" name="action" value="inscription">

                        <a href="login.html" class="btn btn-danger mb-3 rounded-5 pt-3 pb-3 col-12 col-md-12 btn-user btn-block">
                            <i class="fa fa-google fa-fw"></i> Register with Google
                        </a>

                        <a href="index.html" class="btn btn-primary mb-3 rounded-5 pt-3 pb-3 col-12 col-md-12 btn-user btn-block">
                            <i class="fa fa-facebook fa-fw"></i> Register with Facebook
                        </a>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small btn-link text-decoration-none" href="forgot-password.html">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="small btn-link text-decoration-none" href="login.html">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>