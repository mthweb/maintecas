<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dropdown Filters</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .filters-container {
      display: none;
    }

    .filter-btn {
      margin: 10px;
    }

    .filter-btn.active + .filters-container {
      display: block;
    }
  </style>
</head>
<body>

  <div class="container mt-3">
    <!-- Dropdown Button -->
    <button id="filterBtn" class="btn btn-outline-primary filter-btn" type="button">Filtres <i class="bi bi-filter"></i></button>

    <!-- Filters Content -->
    <div class="filters-container p-3 border">
      <div class="row">
        <div class="col-md-3">
          <h6>Filtrer par évaluation</h6>
          <div>
            <input type="radio" id="all" name="evaluation" checked>
            <label for="all">Tous</label>
          </div>
          <div>
            <input type="radio" id="best" name="evaluation">
            <label for="best">Les mieux notés</label>
          </div>
        </div>
        <div class="col-md-3">
          <h6>Filtrer par tarif horaire</h6>
          <div><input type="checkbox"> Moins de 30 €</div>
          <div><input type="checkbox"> De 30 € à 50 €</div>
          <div><input type="checkbox" checked> De 50 € à 100 €</div>
          <div><input type="checkbox"> Plus de 100 €</div>
        </div>
        <div class="col-md-3">
          <h6>Filtrer par projets réalisés</h6>
          <div><input type="checkbox"> Plus de 20 projets</div>
          <div><input type="checkbox"> De 10 à 20 projets</div>
          <div><input type="checkbox"> De 5 à 10 projets</div>
          <div><input type="checkbox"> Moins de 5 projets</div>
        </div>
        <div class="col-md-3">
          <h6>Filtrer par ancienneté</h6>
          <div><input type="checkbox"> Plus de 5 ans</div>
          <div><input type="checkbox"> De 1 à 5 ans</div>
          <div><input type="checkbox"> Moins d’un an</div>
          <h6>Critères supplémentaires</h6>
          <div><input type="checkbox"> Identité vérifiée</div>
        </div>
      </div>
      <div class="mt-3">
        <button class="btn btn-primary">Appliquer</button>
        <button class="btn btn-secondary">Effacer</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('filterBtn').addEventListener('click', function() {
      this.classList.toggle('active');
    });
  </script>

</body>
</html>
