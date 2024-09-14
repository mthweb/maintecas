<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Géolocalisation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .province-list {
            max-height: 300px;
            overflow-y: auto;
            margin-top: 10px;
        }

        .province-item {
            padding: 10px;
            cursor: pointer;
        }

        .province-item:hover {
            background-color: #f0f0f0;
        }

        #selected-province {
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Sélectionnez une province</h2>
        <input type="text" class="form-control" id="search-input" placeholder="Rechercher une province...">
        <div id="province-list" class="province-list border rounded">
            <!-- La liste des provinces sera insérée ici -->
        </div>

        <div id="selected-province" class="text-success">
            <!-- La province sélectionnée sera affichée ici -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Charger la liste des provinces dès que la page est prête
            loadProvinces();

            // Fonction pour charger les provinces via AJAX
            function loadProvinces() {
                $.ajax({
                    url: 'http://api.geonames.org/childrenJSON', // Endpoint de l'API Geonames
                    method: 'GET',
                    data: {
                        geonameId: 203312, // GeonameID pour la RDC
                        username: 'demo'  // Remplacer par votre propre nom d'utilisateur Geonames
                    },
                    success: function (response) {
                        // Vérifier que les données sont présentes
                        if (response && response.geonames) {
                            var provinces = response.geonames;
                            $('#province-list').empty(); // Vider la liste avant de la remplir
                            provinces.forEach(function (province) {
                                $('#province-list').append('<div class="province-item">' + province.name + '</div>');
                            });
                        }
                    },
                    error: function () {
                        alert("Erreur lors du chargement des provinces.");
                    }
                });
            }

            // Lorsque l'utilisateur clique sur une province, on affiche la province sélectionnée
            $(document).on('click', '.province-item', function () {
                var selectedProvince = $(this).text();
                $('#selected-province').text('Province sélectionnée : ' + selectedProvince);
            });

            // Filtrer les provinces en fonction de la recherche
            $('#search-input').on('keyup', function () {
                var value = $(this).val().toLowerCase();
                $('#province-list .province-item').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
</html>
