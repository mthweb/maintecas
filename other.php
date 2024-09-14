<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Code téléphonique avec drapeaux et préfixe automatique</title>
  
  <!-- CSS de Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS de intl-tel-input -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Script de intl-tel-input -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <label for="phone" class="form-label">Numéro de téléphone</label>
        <input type="tel" id="phone" class="form-control" placeholder="Numéro de téléphone">
      </div>
    </div>
  </div>

  <!-- Script pour initialiser intl-tel-input et afficher le code téléphonique -->
  <script>
    $(document).ready(function() {
      var input = document.querySelector("#phone");
      var iti = window.intlTelInput(input, {
        initialCountry: "auto",
        preferredCountries: ["cd", "fr", "us"], // Pays favoris
        geoIpLookup: function(success, failure) {
          $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country : "us";
            success(countryCode);
          });
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
      });

      // Afficher le code du pays sélectionné dans le champ de saisie
      input.addEventListener("countrychange", function() {
        var selectedCountryData = iti.getSelectedCountryData();
        // Met le code téléphonique dans le champ input, ex: +243
        $("#phone").val("+" + selectedCountryData.dialCode);
      });
    });
  </script>
</body>
</html>
