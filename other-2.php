<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aucun prestataire trouvé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
        }
        .error-container {
            text-align: center;
            padding: 50px;
        }
        .error-image {
            max-width: 200px;
            margin-bottom: 20px;
        }
        .error-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .error-message {
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 50px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container error-container">
    <!-- Image d'erreur -->
    <img src="https://example.com/path/to/your/robot-image.png" alt="Robot erreur" class="error-image">

    <!-- Titre d'erreur -->
    <h1 class="error-title">Aucun prestataire trouvé</h1>

    <!-- Message d'erreur -->
    <p class="error-message">
        Il n’y a pas de prestataires qui correspondent à vos filtres actuels.<br>
        Essayez d’en supprimer certains pour obtenir de meilleurs résultats.
    </p>

    <!-- Bouton -->
    <a href="#" class="btn btn-primary">Voir tous les prestataires</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
