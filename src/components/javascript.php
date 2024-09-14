
    <script src="../../styles/cdn/jquery-3.5.1.slim.min.js"></script>
    <script src="../../styles/cdn/popper.min.js"></script>
    <script src="../../styles/cdn/bootstrap.min.js"></script>

    <!-- <div class="index-btn-wrapper justify-content-between mb-5">
        <div class="index-btn  rounded-5" onclick="run(2, 1);">Précédent</div>
        <div class="index-btn  rounded-5" onclick="run(2, 3);">Suivant</div>
    </div> -->

    <!-- import js bootstrap -->
    <script src="../../styles/js/bootstrap.bundle.js"></script>
    <!-- <script src="styles/js/bootstrap.js"></script> -->

    <!-- jquery -->
    <script src="../../styles/jquery-3.6.3.min.map"></script>
    <script src="../../styles/jquery/jquery-1.11.0.min.js"></script>
    
    <!-- alertify -->  
    <script src="../../styles/alertify/alertify.js"></script>
    <script src="../../styles/alertify/alertify.min.js"></script>

    <script src="../../styles/offcanvas/script.js"></script>

    <!-- card -->
    <script src="../../styles/card/js/script.js"></script>
    <script src="../../styles/card/js/swiper-bundle.min.js"></script>

    <!-- offcanvas -->
    <script src="../../styles/offcanvas/script.js"></script>

    <!-- menu slider -->
    <script src="../../styles/menu-slider/script.js"></script>
        
    <!-- avatar -->
    <script src="../../styles/avatar/script.js"></script>

    <!-- step -->
    <script src="../../styles/step/script.js"></script>

    <!-- script serveur -->
    <script src="../script/script-recherche.js"></script>
    <script src="../script/script-collection.js"></script>
    <script src="../script/script-intervention.js"></script>

    <!-- navigation -->
    <script src="../script/script-navigation.js"></script>

    
    <!-- Script de intl-tel-input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <script>

        

    $(document).ready(function () {
        $('#input-text').on('keyup', function () {
            let query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: '../traitement/mt-moteur.php',
                    type: 'GET',
                    data: { query: query, action:"getKey" },
                    success: function (data) {
                        let suggestions = JSON.parse(data);
                        let suggestionBox = $('#suggestions-services');
                        suggestionBox.empty();
                        suggestionBox.removeClass('d-none')
                        suggestions.forEach(function (suggestion) {
                            suggestionBox.append('<div>' + suggestion.word + '</div>');
                        });

                        // Lorsque l'utilisateur clique sur une suggestion
                        suggestionBox.on('click', 'div', function () {
                            $('#input-text').val($(this).text());
                            suggestionBox.empty();
                        });
                    }
                });
            } else {
                $('#suggestions-services').empty();
            }
        });
    });   

    $(document).ready(function() {
            let debounceTimeout;

            $('#address').on('input', function() {
                clearTimeout(debounceTimeout);
                var query = $(this).val();
                if (query.length > 2) {
                    debounceTimeout = setTimeout(function() {
                        $.ajax({
                            url: 'https://nominatim.openstreetmap.org/search',
                            data: {
                                q: query,
                                format: 'json',
                                addressdetails: 1,
                                limit: 5
                            },
                            success: function(data) {
                                $('#suggestions').empty();
                                $.each(data, function(i, item) {
                                    $('#suggestions').append('<div class="suggestion-item" data-display-name="'+item.display_name+'">'+item.display_name+'</div>');
                                });
                                $('#suggestions').addClass('mt-5')

                            },
                            error: function() {
                                $('#suggestions').empty();
                            }
                        });
                    }, 300); // Délai de 300 ms pour réduire le nombre de requêtes
                } else {
                    $('#suggestions').empty();
                }
            });

            $(document).on('click', '.suggestion-item', function() {
                var displayName = $(this).data('display-name');
                $('#address').val(displayName);
                $('#selected_address').val(displayName);
                $('#suggestions').empty();
            });

            $(document).click(function(event) {
                if (!$(event.target).closest('#suggestions, #address').length) {
                    $('#suggestions').empty();
                }
            });

            $('#location-button').click(function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                } else {
                    alert("La géolocalisation n'est pas prise en charge par ce navigateur.");
                }
            });

            function showPosition(position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                $.ajax({
                    url: 'https://nominatim.openstreetmap.org/reverse',
                    data: {
                        lat: lat,
                        lon: lon,
                        format: 'json'
                    },
                    success: function(data) {
                        if (data && data.display_name) {
                            $('#address').val(data.display_name);
                            $('#selected_address').val(data.display_name);
                        }
                    },
                    error: function() {
                        alert("Erreur lors de la récupération de l'adresse.");
                    }
                });
            }

            function showError(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert("L'utilisateur a refusé la demande de géolocalisation.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert("Les informations de localisation sont indisponibles.");
                        break;
                    case error.TIMEOUT:
                        alert("La demande de localisation a expiré.");
                        break;
                    case error.UNKNOWN_ERROR:
                        alert("Une erreur inconnue s'est produite.");
                        break;
                }
            }
        });


    // $(document).ready(function() {

    // var input = document.querySelector("#phone");
    // var iti = window.intlTelInput(input, {
    //     initialCountry: "auto",
    //     preferredCountries: ["cd", "fr", "us"], // Pays favoris
    //     geoIpLookup: function(success, failure) {
    //       $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
    //         var countryCode = (resp && resp.country) ? resp.country : "us";
    //         success(countryCode);
    //       });
    //     },
    //     utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    //   });

    //   // Afficher le code du pays sélectionné dans le champ de saisie
    //   input.addEventListener("countrychange", function() {
    //     var selectedCountryData = iti.getSelectedCountryData();
    //     // Met le code téléphonique dans le champ input, ex: +243
    //     $("#phone").val("+" + selectedCountryData.dialCode);
    //   });
    // });

    $(document).ready(function() {
      var input = document.querySelector("#phone");

      var iti = window.intlTelInput(input, {
        initialCountry: "auto", // Initialiser avec le pays détecté automatiquement
        preferredCountries: ["cd", "fr", "us"], // Optionnel : pays favoris
        geoIpLookup: function(success, failure) {
          $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country.toLowerCase() : "us";
            success(countryCode);
          });
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // Utilitaire pour la validation et le formatage
      });

      // Afficher le code du pays sélectionné dans le champ de saisie
      input.addEventListener("countrychange", function() {
        var selectedCountryData = iti.getSelectedCountryData();
        // Mettre à jour le champ avec le code téléphonique du pays sélectionné
        $("#phone").val("+" + selectedCountryData.dialCode);
      });
    });


    // GESTION DE LA PRISE DES IMAGES
    // Fonction de prévisualisation de l'image
    $('#fileInput').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                $('#imagePreview').attr('src', event.target.result);
                $('.preview').show();
            }
            reader.readAsDataURL(file);
        }
    });

    // Ouverture de la caméra pour prendre une photo
    $('#openCamera').click(function() {
        const video = document.getElementById('camera');
        const constraints = { video: true };

        navigator.mediaDevices.getUserMedia(constraints)
            .then(function(stream) {
                video.srcObject = stream;
                $('#takePhoto').show();
            })
            .catch(function(err) {
                console.log("Erreur d'accès à la caméra : " + err);
            });
    });

    // Capturer la photo
    $('#takePhoto').click(function() {
        const video = document.getElementById('camera');
        const canvas = document.getElementById('take-photo');
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        const dataURL = canvas.toDataURL('image/png');
        $('#imagePreview').attr('src', dataURL);
        $('.preview').show();
        $('#camera').hide();
    });

    
    $('#uploadImage').click(function() {
        const fileInput = $('#fileInput')[0];
        const file = fileInput.files[0];
        const canvas = document.getElementById('take-photo');
        const imageData = canvas.toDataURL('image/png'); // Image capturée

        let formData = new FormData();
        if (file) {
            // Image importée
            formData.append('image', file);
        } else {
            // Image capturée
            formData.append('imageData', imageData);
        }

        $.ajax({
            url: 'upload_image.php', // Le script PHP pour gérer l'upload
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Image téléversée avec succès !');
            },
            error: function() {
                alert('Erreur lors du téléversement de l\'image.');
            }
        });
    });


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

    $(document).ready(function() {
        // Gérer le clic sur le lien "Voir plus"
        $('.voir-plus').on('click', function(e) {
            e.preventDefault();
            alert('hello')
            var texteComplet = $(this).data('presentation'); // Récupérer le texte complet depuis l'attribut data
            $(this).parent().html(texteComplet); // Remplacer le contenu de la balise <p> avec le texte complet
        });
    });


    



    (function () {
    'use strict'

    document.querySelector('#navbarSideCollapse').addEventListener('click', function () {
        document.querySelector('.offcanvas-collapse').classList.toggle('open')
        })
    })()


    </script>
</body>
</html>