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


    <!-- référencement -->
    <!-- <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large">

    <meta property='og:locale' content="fr_FR, en_EN">

    <meta property="og:description"   content="shortano.com est le site web officiel de l'auteur joe shortano, ce site vous offre les différents livres de shortano, avec possibilité de passer commande des différents livres">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta property="og:site_name" content="shortano">
    <meta property="og:image" content="https://shortano.com/data/images/joelogo.png">
    <meta property="og:image:secure_url" content="https://shortano.com/data/images/joelogo.png">
    <meta property="og:image:width" content="320">
    <meta property="og:image:height" content="320">
    <meta property="og:image:type" content="image/png"> -->

    <style>
        /* @font-face {
            font-family: "verdana;
            /* src: url('../styles/roboto/RobotoCondensed-VariableFont_wght.ttf');
        } */
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

    </style>
</head>
<body style="background-color: black; color:white;">
