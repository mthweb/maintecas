<style>
     .container {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 30px;
        }

        .login-container {
            background-color: #1a1a1a;
            padding: 30px;
            border-radius: 5px;
            max-width: 400px;
            width: 100%;
            margin-right: 20px;
        }

        .login-container h3 {
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .form-group label {
            font-weight: normal;
        }

        .form-control {
            background-color: #000;
            border: 1px solid #444;
            color: #fff;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .btn-primary {
            background-color: #fff;
            color: #000;
            border: none;
            width: 100%;
            margin-top: 15px;
        }

        .form-text.text-danger {
            color: #ff4c4c;
        }

        .link {
            color: #fff;
            text-decoration: underline;
            font-size: 0.9rem;
            display: block;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .sidebar {
            max-width: 300px;
            width: 100%;
            padding-left: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar a:hover {
            text-decoration: underline;
        }

        .captcha-container {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #000;
            border: 1px solid #444;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
                padding: 20px;
            }
            .login-container, .sidebar {
                max-width: 100%;
                margin-bottom: 20px;
            }
        }

</style>

<div class="container mt-5">
        <div class="row">
            <!-- Login Form -->
            <div class="col-md-6">
                <div class="login-container">
                    <h3>SE CONNECTER</h3>
                    <form>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" placeholder="E-mail">
                            <small class="form-text text-danger">Champ requis</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" placeholder="Mot de passe">
                        </div>
                        <div class="form-group">
                            <a href="#" class="link">Mot de passe oublié</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Se Connecter</button>
                    </form>
                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-md-6 sidebar">
                <ul class="list-unstyled">
                    <li><a href="#">Activez votre Starlink</a></li>
                    <li><a href="#">Commander un Starlink</a></li>
                    <li><a href="#">Consultez notre centre d'assistance</a></li>
                    <li><a href="#">Consultez nos customer stories</a></li>
                </ul>
            </div>
        </div>
    </div>