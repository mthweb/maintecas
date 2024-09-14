<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date et heure de l'intervention</title>

    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS pour le design spécifique -->
    <style>
        .custom-datetime {
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 30px;
            padding: 5px 15px;
            width: fit-content;
        }

        .custom-datetime button {
            background: none;
            border: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            color: #000;
            cursor: pointer;
            outline: none;
        }

        .custom-datetime img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .custom-datetime input[type="datetime-local"] {
            border: none;
            outline: none;
            background: none;
            width: 100%;
            cursor: pointer;
            color: #000;
        }

        .custom-datetime input[type="datetime-local"]:focus {
            outline: none;
            box-shadow: none;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <label for="intervention-time" class="form-label">A quand l’intervention ?</label>
            <div class="custom-datetime">
                <button id="now-button">
                    <img src="https://img.icons8.com/material-rounded/24/000000/clock.png" alt="clock-icon">
                    Maintenant
                </button>
                <input type="datetime-local" id="intervention-time">
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script pour gérer le bouton "Maintenant" -->
<script>
    $(document).ready(function () {
        // Fonction pour obtenir la date et l'heure actuelles au format adapté à l'input datetime-local
        function getCurrentDateTime() {
            const now = new Date();
            const year = now.getFullYear();
            const month = ('0' + (now.getMonth() + 1)).slice(-2); // Mois au format MM
            const day = ('0' + now.getDate()).slice(-2); // Jour au format DD
            const hours = ('0' + now.getHours()).slice(-2); // Heures au format HH
            const minutes = ('0' + now.getMinutes()).slice(-2); // Minutes au format MM
            return `${year}-${month}-${day}T${hours}:${minutes}`;
        }

        // Quand on clique sur "Maintenant", on remplit le champ avec la date et l'heure actuelles
        $('#now-button').on('click', function (e) {
            e.preventDefault();
            $('#intervention-time').val(getCurrentDateTime());
        });
    });
</script>

</body>
</html>
