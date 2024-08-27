
<!-- import js bootstrap -->
<script src="styles/js/bootstrap.bundle.js"></script>
<!-- <script src="styles/js/bootstrap.js"></script> -->

<!-- jquery -->
<script src="styles/jquery-3.6.3.min.map"></script>
<script src="styles/jquery/jquery-1.11.0.min.js"></script>
   
<!-- alertify -->  
<script src="styles/alertify/alertify.js"></script>
<script src="styles/alertify/alertify.min.js"></script>

<script src="styles/offcanvas/script.js"></script>

<!-- card -->
<script src="styles/card/js/script.js"></script>
<script src="styles/card/js/swiper-bundle.min.js"></script>

<!-- responsive menu script -->
<script src="styles/responsive-menu/script.js"></script>

<!-- avatar -->
<script src="styles/avatar/script.js"></script>

<!-- fade effet -->
<script src="styles/fadeEffet/script.js"></script>

<!-- modale -->
<script src="styles/modale/script.js"></script>

<!-- script serveur -->
<script src="script/script-usager.js"></script>
<script src="script/script-entreprise.js"></script>
<script src="script/script-recherche.js"></script>

<script>
        // $(document).ready(function() {
        //     let debounceTimeout;

        //     $('#address').on('input', function() {
        //         clearTimeout(debounceTimeout);
        //         var query = $(this).val();
        //         if (query.length > 2) {
        //             debounceTimeout = setTimeout(function() {
        //                 $.ajax({
        //                     url: 'https://nominatim.openstreetmap.org/search',
        //                     data: {
        //                         q: query,
        //                         format: 'json',
        //                         addressdetails: 1,
        //                         limit: 5
        //                     },
        //                     success: function(data) {
        //                         $('#suggestions').empty();
        //                         $.each(data, function(i, item) {
        //                             $('#suggestions').append('<div class="suggestion-item " data-display-name="'+item.display_name+'">'+item.display_name+'</div>');
        //                         });
        //                         $('#suggestions').addClass('mt-5')
        //                     },
        //                     error: function() {
        //                         $('#suggestions').empty();
        //                     }
        //                 });
        //             }, 300); // Délai de 300 ms pour réduire le nombre de requêtes
        //         } else {
        //             $('#suggestions').empty();
        //         }
        //     });

        //     $(document).on('click', '.suggestion-item', function() {
        //         var displayName = $(this).data('display-name');
        //         $('#address').val(displayName);
        //         $('#selected_address').val(displayName);
        //         $('#suggestions').empty();
        //     });

        //     $(document).click(function(event) {
        //         if (!$(event.target).closest('#suggestions, #address').length) {
        //             $('#suggestions').empty();
        //         }
        //     });
        // });


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



        $(document).ready(function() {
            let debounceTimeout;

            $('#input').on('input', function() {
                clearTimeout(debounceTimeout);
                var query = $(this).val();
                if (query.length > 2) {
                    debounceTimeout = setTimeout(function() {
                        $.ajax({
                            url: 'scr/traitement/mt-recherche.php',
                            data: { query: query, action:"saisirBesoin" },
                            success: function(data) {
                                var suggestions = JSON.parse(data);
                                $('#suggestions-besoin').empty();
                                $.each(suggestions, function(i, item) {
                                    $('#suggestions-besoin').append('<div class="suggestion-item-besoin">' + item + '</div>');
                                });
                            },
                            error: function() {
                                $('#suggestions-besoin').empty();
                            }
                        });
                    }, 300); // Délai de 300 ms pour réduire le nombre de requêtes
                } else {
                    $('#suggestions-besoin').empty();
                }
            });

            $(document).on('click', '.suggestion-item-besoin', function() {
                var displayName = $(this).text();
                $('#input').val(displayName);
                $('#selected_value').val(displayName);
                $('#suggestions-besoin').empty();
            });

            $(document).click(function(event) {
                if (!$(event.target).closest('#suggestions-besoin, #input').length) {
                    $('#suggestions-besoin').empty();
                }
            });
        });


    $(document).ready(function () {
        $('#input-text').on('keyup', function () {
            let query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: './src/traitement/mt-moteur.php',
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
</script>