<div class="container d-flex  justify-content-center align-items-center vh-100">
    
    <div class="card p-4 bg-transparent text-white border-0" style="max-width: 500px; width: 100%;">
        <!-- <div class="text-center mb-4">
            <img src="https://www.codeur.com/assets/images/logos/codeur.svg" alt="Codeur.com" class="logo mb-2" style="width: 100px;">
            <p class="text-muted">by Freeland</p>
        </div> -->

        <h3 class="text-start fw-bold mb-5">Créez votre compte avec</h3>
        
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

        <form id="inscriptionUsager" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="prenom" class="form-label small">Prénom</label>
                    <input type="text" name="prenom" class="form-control bg-transparent border-white border-2 input-custo text-white" id="prenom" placeholder="prénom">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nom" class="form-label small">Nom</label>
                    <input type="text" name="nom" class="form-control bg-transparent border-white border-2 input-custo text-white" id="nom" placeholder="nom">
                </div>
            </div>
                
            <div class="mb-3">
                <label for="email" class="form-label small">Email (Facultatif)</label>
                <input type="email" name="email" class="form-control bg-transparent border-white border-2 input-custo text-white" id="email" placeholder="adresse email">
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label small">Téléphone</label>
                <input type="tel" name="telephone" class="form-control bg-transparent border-white border-2 input-custo text-white" id="telephone" placeholder="téléphone">
            </div>

            <!-- <div class="mb-3">
                <label for="password" class="form-label small">Mot de passe</label>
                <input type="password" class="form-control bg-transparent border-white border-2 input-custo text-white" id="Mot de passe" placeholder="password">
            </div> -->
            
            <!-- contrainte -->
            <input type="hidden" name="action" value="inscription">
                
            <button type="submit" class="btn btn-primary rounded-5 pt-2 pb-2">S'inscrire</button>
        </form>
            
        <div class="text-center mt-3">
            <a href="#" class="text-white small">Se connecter sur maintecas.com ? </a>
        </div>
    </div>
</div>