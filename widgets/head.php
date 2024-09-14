<?php
    session_start();

    if(empty($_SESSION['input']) && empty($_SESSION['address'])){
        // header('location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="maintecas web, ce logiciel qui vous permet de vendre vos compétences et vos services">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <title>maintecas web</title>

    <!-- bootstrap classes-->
    <link rel="stylesheet" href="styles/css/bootstrap-grid.css">
    <link rel="stylesheet" href="styles/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="styles/css/bootstrap-utilities.css">
    <link rel="stylesheet" href="styles/css/bootstrap.css">
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/fonts/font-awesome.css">
    <link rel="stylesheet" href="styles/menu-slide.css">
    <link rel="stylesheet" href="styles/card-slider/style.css">

    <!-- alertify -->
    <link href="styles/alertify/css/alertify.css" rel="stylesheet" type="text/css">
    <link href="styles/alertify/css/alertify.min.css" rel="stylesheet" type="text/css">

    <!-- responsive menu code -->
    <link rel="stylesheet" href="styles/responsive-menu/style.css">

    <!-- kamenga style -->
    <link rel="stylesheet" href="styles/kamengaStyle/couleur.css">

    <!-- slide tab -->
    <link rel="stylesheet" href="styles/offcanvas/style.css">

    <!-- card slider -->
    <link rel="stylesheet" href="styles/card/css/style.css">
    <link rel="stylesheet" href="styles/card/css/swiper-bundle.min.css">

    <!-- avatar -->
    <link rel="stylesheet" href="styles/avatar/style.css">

    <!-- fade -->
    <link rel="stylesheet" href="styles/fadeEffet/style.css">

    <!-- modale -->
    <link rel="stylesheet" href="styles/modale/style.css">

    <!-- menu slide -->
    <link rel="stylesheet" href="../styles/menu-slide.css">

    <!-- menu responsive header -->
    <!-- <link rel="stylesheet" href="styles/menu/style.css"> -->


    <!-- référencement -->
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large"> 
    <meta property='og:locale' content="fr_FR, en_EN">

    <meta property="og:description"   content="maintecas web, ce logiciel qui vous permet de vendre vos compétences et vos services">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta property="og:site_name" content="maintecas">
    <meta property="og:image" content="https://australdrc.com/maintecas/assets/images/logo_upscaled.png">
    <meta property="og:image:secure_url" content="https://australdrc.com/maintecas/assets/images/logo_upscaled.png">
    <meta property="og:image:width" content="320">
    <meta property="og:image:height" content="320">
    <meta property="og:image:type" content="image/png"> 

    <style>
        @font-face {
            font-family: "verdana";
            src: url('../styles/roboto/RobotoCondensed-VariableFont_wght.ttf');
            src: url('../styles/lerexend/Lexend-VariableFont_wght.ttf');
        } 
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Style simple pour les suggestions */
        #suggestions {
            /* border: 1px solid #ccc; */
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            background: white;
            width: 100%;
        }
        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }
        .suggestion-item:hover {
            background-color: #eee;
        }


        .suggestions-services {
            max-height: 150px;
            overflow-y: auto;
            background-color: #fff;
            z-index: 1000;
        }

        .suggestions-services div {
            padding: 10px;
            cursor: pointer;
        }

        .suggestions-services div:hover {
            background-color: #f0f0f0;
        }

        .divider{
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
        }

        .divider::before, .divider::after{
            content: '';
            flex-grow: 1;
            height: 1px;
            /* background-color: #000; */
            /* border-bottom: 1px solid #000; */
        }

        .divider::before{
            margin-right: 10px;
        }

        .divider::after{
            margin-left: 10px;
        }

        .divider span{
            font-weight: bold;
            font-size:1.2rem;
        }

        /*  */
        .adress::placeholder, .input-custo::placeholder{
            color:white;
            opacity: 1;
        }

        .title-container {
            width: 100%; /* Assure que le conteneur prend toute la largeur disponible */
            /* padding: 20px; Ajoute du padding autour du texte */
            box-sizing: border-box; /* Inclut le padding dans la largeur totale */
        }

        .title-container .h1 {
            font-size: 24px; /* Taille de la police pour le titre */
            line-height: 1.5; /* Hauteur de ligne pour gérer l'espacement entre les lignes */
            font-weight: bold; /* Gras pour le texte */
            color: #ffffff; /* Couleur du texte */
        }



        header {
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 15px 20px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        header.scrolled {
            background-color: #4CAF50;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: #fff;
            /* font-size: 1.8rem; */
            font-weight: bold;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .hamburger span {
            height: 3px;
            width: 25px;
            background: #fff;
            margin-bottom: 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        #menu-toggle {
            display: none;
        }

        #menu-toggle:checked + .hamburger span:nth-child(1) {
            transform: rotate(45deg);
            top: 8px;
            position: relative;
        }

        #menu-toggle:checked + .hamburger span:nth-child(2) {
            opacity: 0;
        }

        #menu-toggle:checked + .hamburger span:nth-child(3) {
            transform: rotate(-45deg);
            top: -8px;
            position: relative;
        }

        .menu {
            list-style: none;
            display: flex;
            justify-content: space-between;
        }

        .menu li {
            margin-left: 25px;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
            padding: 5px 10px;
            transition: color 0.3s ease;
        }

        .menu a:hover {
            color: #ffeb3b;
        }

        .close-menu {
            display: none;
            font-size: 2rem;
            color: #fff;
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }

            .menu {
                position: fixed;
                top: 0;
                bottom: 0;
                right: -100%;
                height: 100vh;
                width: 250px;
                background-color: rgba(0, 0, 0, 0.9); /* Fond noir translucide */
                flex-direction: column;
                justify-content: flex-start; /* Alignement des éléments au début */
                align-items: center;
                transition: right 0.3s ease;
                padding-top: 50px; /* Ajustez cette valeur pour remonter les éléments */
            }

            #menu-toggle:checked ~ .menu {
                right: 0;
            }

            .menu li {
                margin: 20px 0;
            }

            .close-menu {
                display: block;
            }
        }

        .content {
            padding: 100px 20px;
            text-align: center;
            background-color: #f0f0f0;
            min-height: 100vh;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 900;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

    .blocked{
        opacity: 0.1;
        pointer-events: none;
    }



    </style>
</head>
<body style="background-color: black; color:white;">
