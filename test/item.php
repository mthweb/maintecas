<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Freelance</title>
    <!-- Lien vers Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-profile {
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            padding: 15px;
            max-width: 400px;
        }
        .card-profile img {
            border-radius: 50%;
            width: 60px;
            height: 60px;
            object-fit: cover;
        }
        .pro-badge {
            background-color: #f0ad4e;
            color: white;
            padding: 3px 8px;
            font-size: 12px;
            border-radius: 15px;
        }
        .rating-circle {
            background-color: #28a745;
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }
        .text-success {
            color: #28a745 !important;
        }
        .icon {
            color: #6c757d;
        }
        .projects-link {
            color: #6610f2;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card-profile border shadow-sm p-3 mb-5 bg-white rounded">
        <div class="d-flex align-items-center">
            <img src="https://via.placeholder.com/60" alt="Avatar">
            <div class="ml-3">
                <h5 class="mb-0">CodingHero</h5>
                <small class="text-muted">Développeur WordPress</small>
                <div class="text-success">• Disponible</div>
            </div>
            <div class="ml-auto">
                <div class="rating-circle">5,0</div>
            </div>
        </div>
        <div class="mt-3">
            <span class="badge badge-light mr-2">🏆</span> 2ème place "Codeur Préféré des Clients" aux Codeur Awards 2024 <br>
            <span class="badge badge-light mr-2">🏆</span> 3ème place "Meilleur Prestataire" aux Codeur Awards 2024 <br>
            En tant que développeur Full Stack, je suis ravi de vous offrir mes services depuis le Maroc. Je suis Amine BK, né à Ca...
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <span class="icon"><i class="fas fa-euro-sign"></i> 30 € / heure</span>
            </div>
            <div>
                <a href="#" class="projects-link"><i class="fas fa-briefcase"></i> 174 projets réalisés</a>
            </div>
        </div>
    </div>
</div>

<!-- Lien vers les icônes de FontAwesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!-- Lien vers le script Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
