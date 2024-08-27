
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

    <!-- script serveur -->
    <script src="../script/script-recherche.js"></script>
    <!-- <script src="../script/"></script> -->

    <script>
        var swiper = new Swiper(".slide-content", {
        slidesPerView: 3,
        spaceBetween: 25,
        loop: true,
        centerSlide: 'true',
        fade: 'true',
        grabCursor: 'true',
        pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
        },
        navigation: {
        SuivantEl: ".swiper-button-Suivant",
        prevEl: ".swiper-button-prev",
        },

        breakpoints:{
            0: {
                slidesPerView: 1,
            },
            520: {
                slidesPerView: 2,
            },
            950: {
                slidesPerView: 3,
            },
        },
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