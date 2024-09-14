<?php
session_start();

// echo $_SESSION['input'];
// echo $_SESSION['address'];

// if(empty($_SESSION['input']) && empty($_SESSION['address'])){
//     header('location:../index.php');
// }

// import des controllers, afin de faciliter la manipulation des données
// de nos différentes classes
include_once('../controllers/cnx.php');

include_once('../controllers/keywordController.php');    
include_once('../controllers/rendreController.php');    
include_once('../controllers/effectuerController.php');    
include_once('../controllers/disponibiliteController.php');    
include_once('../controllers/serviceController.php');    
include_once('../controllers/categorieController.php');    
include_once('../controllers/interventionController.php');



// on instancie les classes (création des objets)
$objKey    = new keywordControleur();
$objRend   = new rendreControleur();
$objEff    = new effectuerController();
$objDisp   = new disponibiliteControleur();
$objServ   = new serviceControleur();
$objCat    = new categorieControleur();
$objIner   = new interventionControleur();

// initialisation
$input="";
$address;

if (isset($_POST['input']) && isset($_POST['address'])) {
    // déclaration d'une variable session qui permettra de stocker le contenu
    // de l'information recherchée
    $_SESSION['input']   = htmlspecialchars($_POST['input']);
    $_SESSION['address'] = htmlspecialchars($_POST['address']);

    // récupérons le besoin de l'utilisateur
    // $input = htmlspecialchars($_POST['input']);
    $input   = (!empty($_POST['input'])) ? htmlspecialchars($_POST['input']) : $_SESSION['input'];
    $address = (!empty($_POST['address'])) ? htmlspecialchars($_POST['address']) : $_SESSION['address'];
}



// Nous appelons la méthide rechercherMot, celle-ci permet de rechercher
// des mots clés via ces mots clés, nous aurons accès au service concerné
// par ce dernier
$stmt = $objKey->rechercherMot($input);

// Initialisation de la variable qui nous permet de stocker le mot clé 
// à partir de ce mot clé, nous recherchons les données qui sont collecté
// dans la grille du mot clé
$getKey = "";

// Nous parcours le résultat de notre boucle en vue de récupérer le mot clé
// ciblé pour permettre l'interrogation des autres requêtes exploitées le 
// long du script
$res = $stmt->fetch();

$getKey = (!empty($res['key'])) ? htmlspecialchars($res['key']) : '';

// Déclaration des variables pour limite l'affichage des informations
// ces variables permettent la gestion de l'affichage des informations
$start = "0";
$limite= '0';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>maintecas web</title>

    <!-- bootstrap classes-->
    <link rel="stylesheet" href="../../styles/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../../styles/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../../styles/css/bootstrap-utilities.css">
    <link rel="stylesheet" href="../../styles/css/bootstrap.css">
    <link rel="stylesheet" href="../../styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../styles/fonts/font-awesome.css">
    <link rel="stylesheet" href="../../styles/menu-slide.css">

    <!-- avatar  -->
    <link rel="stylesheet" href="../../styles/avatar/style.css">

    <!-- slide tab -->
    <link rel="stylesheet" href="../../styles/offcanvas/style.css">

    <!-- card slider -->
    <link rel="stylesheet" href="../../styles/card/css/style.css">
    <link rel="stylesheet" href="../../styles/card/css/swiper-bundle.min.css">

     <!-- step -->
     <link rel="stylesheet" href="../../styles/step/style.css">

    <!-- menu slider -->
    <link rel="stylesheet" href="../../styles/menu-slider/styles.css">

    <!-- CSS de intl-tel-input -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>

    <!-- Lien vers Font Awesome -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> -->

    <!-- police d'ecriture -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
       * {
            font-family: 'Poppins', sans-serif;
        }

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

        .profile-story {
            position: relative;
            width: 110px;
            height: 110px;
            padding: 5px;
            border-radius: 50%;
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid white;
            object-fit: cover;
        }



        .modal-dialog-bottom {
            position: absolute;
            bottom: 0;
            margin: 0;
            width: 100%;
            max-width: none;
        }

        .modal-content {
            border-radius: 0;
        }

        .online-status {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #4CAF50;
        }

        .status-dot {
            width: 10px;
            height: 10px;
            background-color: #4CAF50;
            border-radius: 50%;
            margin-right: 5px;
        }


        .rating-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-circle {
            width: 60px;
            height: 60px;
            background-color: #4CAF50;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .rating {
            color: white;
            font-size: 1.2em;
            font-weight: bold;
        }

        .star-circle {
            width: 20px;
            height: 20px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            bottom: -5px;
            right: -5px;
            border: 1px solid #4CAF50;
        }

        .star {
            color: #4CAF50;
            font-size: 0.8em;
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


        .circle {
            width: 30px;
            height: 30px;
            background-color: #3498db; /* Couleur du cercle */
            border-radius: 50%; /* Fait en sorte que la forme soit un cercle */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 18px;
            font-family: Arial, sans-serif;
        }


        file-header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .profile-footer {
            background-color: #000;
            color: #fff;
            padding: 15px;
            text-align: center;
            position: relative;
        }

        .profile-footer .close-icon {
            position: absolute;
            right: 15px;
            top: 15px;
            cursor: pointer;
        }

        .status-container2 {
            display: flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            max-width: 300px;
        }

        .status-circle2 {
            width: 10px;
            height: 10px;
            border: 2px solid black;
            border-radius: 50%;
            margin-right: 10px;
        }

        .status-text2 {
            font-size: 14px;
        }

        .status-text2 strong {
            font-weight: bold;
        }

        .status-text2 em {
            font-style: italic;
        }

        .modal-bottom .modal-dialog {
            position: fixed;
            bottom: 0;
            margin: 0;
            width: 100%;
            transition: all 0.3s ease-in-out;
        }

        .modal.fade .modal-dialog {
            transform: translateY(100%);
        }

        .modal.show .modal-dialog {
            transform: translateY(0);
        }


        .mere{
            font-family: cursive;
        }

        .stat-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 20px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            font-size: 24px;
            font-weight: bold;
        }

        .stat-circle.attractivite {
            background: conic-gradient(#a3d64f 0% 73%, #e0e0e0 73% 100%);
        }

        .stat-circle.reactivite {
            background: conic-gradient(#e0e0e0 0% 100%);
            color: #666;
        }

        .stat-circle.disponibilite {
            background: conic-gradient(#28a745 0% 91%, #e0e0e0 91% 100%);
        }

        .stat-description {
            font-size: 14px;
            color: #666;
        }

        .btn-custom {
            background-color: #1d4ed8;
            color: white;
            border-radius: 30px;
            padding: 10px 30px;
            font-size: 16px;
            border: none;
        }

        .btn-custom:hover {
            background-color: #1563d8;
        }


        .profile-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .profile-subtext {
            font-size: 14px;
            color: #888;
            margin-bottom: 20px;
        }

        .profile-info p {
            margin-bottom: 10px;
            font-size: 14px;
        }

        .profile-info span {
            font-weight: bold;
        }

        .verify-icon {
            color: green;
            margin-left: 5px;
        }

        .non-verified-icon {
            color: red;
            margin-left: 5px;
        }

        .social-icons a {
            margin-right: 10px;
            color: white;
            font-size: 20px;
        }

        .social-icons a.facebook {
            background-color: #3b5998;
            padding: 10px;
            border-radius: 50%;
        }

        .social-icons a.linkedin {
            background-color: #0077b5;
            padding: 10px;
            border-radius: 50%;
        }

        .social-icons a.twitter {
            background-color: #1da1f2;
            padding: 10px;
            border-radius: 50%;
        }

        .social-icons a.email {
            background-color: #ff4500;
            padding: 10px;
            border-radius: 50%;
        }

        .report-profile {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
            text-align: center;
            cursor: pointer;
        }

        .report-profile:hover {
            text-decoration: underline;
        }

        /* Ajustement pour que le champ de saisie ressemble à un champ Bootstrap */
        .iti {
        display: block;
        }

        /* Ajuster la largeur du champ pour qu'il s'adapte à la largeur de l'écran */
        .iti__flag-container {
        padding-left: 10px;
        }

        .intl-tel-input .form-control {
        padding-left: 50px; /* Espace pour le drapeau */
        }


        .upload-container {
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .upload-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .custom-file-input {
            margin-bottom: 20px;
        }
        .preview {
            margin-top: 20px;
            display: none;
        }
        .preview img {
            max-width: 100%;
            border-radius: 10px;
            margin-top: 15px;
        }
        #take-photo {
            display: none;
            margin-top: 20px;
        }

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
            /* width: 100%; */
            cursor: pointer;
            color: #000;
        }

        .custom-datetime input[type="datetime-local"]:focus {
            outline: none;
            box-shadow: none;
        }


        /* Style du bouton dropdown */
        .dropdown-toggle {
            /* background-color: #00A775; */
            color: white;
            border: none;
            font-weight: bold;
        }

        .dropdown-toggle:hover {
            background-color: #007A55;
        }

        /* Style des items du menu */
        .dropdown-item {
            font-size: 16px;
            padding: 10px 20px;
            color: #212529;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        /* Style des sections */
        .dropdown-header {
            font-weight: bold;
            font-size: 14px;
            color: #555555;
        }

        /* Style des icônes */
        .dropdown-item i {
            margin-right: 10px;
            color: #00A775;
        }

        /* Style du divider */
        .dropdown-divider {
            border-color: #dddddd;
        }


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

        .filters-container {
        display: none;
        }

        .filter-btn {
        margin: 10px;
        }

        .filter-btn.active + .filters-container {
        display: block;
        }

        .blocked{
            opacity: 0.5;
            pointer-events: none;
        }

        .modal-bottom {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            margin: 0;
            padding: 0;
        }

        .modal-content {
            border-radius: 10px 10px 0 0;
        }

        .modal-header {
            background-color: #f8f9fa;
            border-bottom: none;
        }

        .btn-close {
            margin: 0;
            padding: 0;
        }

    </style>

</head>
<body>