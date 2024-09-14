<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: 'Poppins', sans-serif;
        }
     
        .logo {
            width: 100px;
        }

        .card {
            border-radius: 15px;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .text-muted {
            font-size: 0.9em;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn-outline-primary {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }


        .divider{
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
        }

        .divider::before, .divider::after{
            content: '';
            flex-grow: 1;
            height: 1px;
            /* background-color: #000; */
            /* border-bottom: 1px solid #000; */
        }

        .divider::before{
            margin-right: 10px;
        }

        .divider::after{
            margin-left: 10px;
        }

        .divider span{
            font-weight: bold;
            font-size:1.2rem;
        }

    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 border-0" style="max-width: 400px; width: 100%;">
            <!-- <div class="text-center mb-4">
                <img src="https://www.codeur.com/assets/images/logos/codeur.svg" alt="Codeur.com" class="logo mb-2" style="width: 100px;">
                <p class="text-muted">by Freeland</p>
            </div> -->
            <h3 class="text-start fw-bold mb-5">Se connecter avec</h3>
            <div class="d-flex justify-content-around mb-3">
                <a href="#" class="btn btn-outline-primary shadow-sm border-0">
                    <img src="https://cdn-icons-png.flaticon.com/512/281/281764.png" alt="Google" style="width: 24px;">
                </a>
                <a href="#" class="btn btn-outline-primary shadow-sm border-0">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" style="width: 24px;">
                </a>
                <a href="#" class="btn btn-outline-primary shadow-sm border-0">
                    <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn" style="width: 24px;">
                </a>
                <a href="#" class="btn btn-outline-primary shadow-sm border-0">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733609.png" alt="GitHub" style="width: 24px;">
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

            <form>
                <div class="mb-3">
                    <label for="email" class="form-label small">Adresse email ou pseudo</label>
                    <input type="email" class="form-control" id="email" placeholder="Adresse email ou pseudo">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label small">Mot de passe</label>
                    <input type="password" class="form-control" id="password" placeholder="Mot de passe">
                    <div class="text-end">
                        <a href="#" class="text-muted">Mot de passe oublié ?</a>
                    </div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label small" for="remember">Se souvenir de moi</label>
                </div>
                <button type="submit" class="btn btn-primary rounded-5 pt-2 pb-2">Se connecter</button>
            </form>
            <div class="text-center mt-3">
                <a href="#" class="text-muted">Pas encore inscrit sur maintecas.com ? S'inscrire</a>
            </div>
        </div>
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
