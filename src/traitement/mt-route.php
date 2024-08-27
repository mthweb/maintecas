<?php
// on débute une session
session_start();
// la variable action sera utilisé pour la gestion des opérations 
// qui auront lieu pour la gestion des différents modules, le 
// traitement d'une information sera gérée par les actions qui
// seront au préalable défini par le moyen d'envoi des données
$action = $_REQUEST['action'];


// Nous implémentons une logique pour permettre de gérer la connexion au compte
// maintecas pour usager si aucune session n'est détectée alors l'usager sera renvoyée
// vers la boîte de connexion avant de passer sa commande
if (empty($_SESSION['key_compte'])) {

    // nous allons donc récupérer nos valeurs recherchées dans les sessions pour permettre
    // à ce que l'utilisateur soit rédirigée vers la page de recherche 
    $_SESSION['input']   = htmlspecialchars($_POST['input']);
    $_SESSION['address'] = htmlspecialchars($_POST['address']);

    // rédirection vers la page de connexion
    header('location:../login.php');
}else{
    $_SESSION['input']   = htmlspecialchars($_POST['input']);
    $_SESSION['address'] = htmlspecialchars($_POST['address']);
            
    header('location:../target/technicien-profile.php');
}
  
// }