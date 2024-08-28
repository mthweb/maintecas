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

    <!-- menu slider -->
    <link rel="stylesheet" href="../../styles/menu-slider/styles.css">

    <style>
       * {
            font-family: Arial, Helvetica, sans-serif;
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
    </style>

</head>
<body>