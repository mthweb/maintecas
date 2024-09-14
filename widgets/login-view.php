<div class="container d-flex  justify-content-center align-items-center vh-100">
    
    <div class="card p-4 bg-transparent text-white border-0" style="max-width: 400px; width: 100%;">
        <!-- <div class="text-center mb-4">
            <img src="https://www.codeur.com/assets/images/logos/codeur.svg" alt="Codeur.com" class="logo mb-2" style="width: 100px;">
            <p class="text-muted">by Freeland</p>
        </div> -->

        <h3 class="text-start fw-bold mb-5">Se connecter avec</h3>
        
        <div class="d-flex justify-content-around mb-3">
            <a href="#" class="btn btn-outline-light shadow-sm border-0">
                <img src="https://cdn-icons-png.flaticon.com/512/281/281764.png" alt="Google" style="width: 24px;">
            </a>
                
            <a href="#" class="btn btn-outline-light shadow-sm border-0">
                <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" style="width: 24px;">
            </a>
                
            <a href="#" class="btn btn-outline-light shadow-sm border-0">
                <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn" style="width: 24px;">
            </a>
               
        </div>
           
        <div class="container text-center my-4">
            <div class="row">
                <div class="col">
                    <hr>
                </div>

                <div class="col-auto">
                    <strong>ou</strong>
                </div>

                <div class="col">
                    <hr>
                </div>
            </div>    
        </div>

        <form method="post" action="src/traitement/mt-connexion.php" id="">
            <div class="mb-3">
                <label for="username" class="form-label small">Adresse email ou téléphone</label>
                <input type="text" name="username" class="form-control bg-transparent border-white border-2 input-custo text-white" id="username" placeholder="Adresse email ou pseudo">
            </div>
                
            <div class="mb-3 d-none">
                <label for="password" class="form-label small">Mot de passe</label>
                <input type="password" class="form-control bg-transparent border-white border-2 input-custo text-white" id="password" placeholder="Mot de passe">
                <div class="text-end">
                    <a href="#" class="text-white small">Mot de passe oublié ?</a>
                </div>
            </div>
                
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label small" for="remember">Se souvenir de moi</label>
            </div>
                
            <!-- contraine -->
            <input type="hidden" name="action" value="connexion">

            <button type="submit" class="btn btn-primary rounded-5 pt-2 pb-2">Se connecter</button>
        </form>
            
        <div class="text-center mt-3">
            <a href="#" class="text-white small">Pas encore inscrit sur maintecas.com ? S'inscrire</a>
        </div>
    </div>
</div>