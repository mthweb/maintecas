<?php
// la variable action sera utilisé pour la gestion des opérations 
// qui auront lieu pour la gestion des différents modules, le 
// traitement d'une information sera gérée par les actions qui
// seront au préalable défini par le moyen d'envoi des données
// $action = $_REQUEST['action'];

// nous posons un test pour vérifier si la variable action n'est
// pas vide, si oui, on récupère les modèles et les controllers 
// qui nous permettent de manipuler la base de données
// if (!empty($action)) {

    // on inclut les mutateurs pour la gestion des données étant
    // donné que l'approche utilisé est l'orienté objet
    include_once('../controllers/usagerController.php');


    // on importe notre classe connexion
    include_once('../controllers/cnx.php');

    // on instancie les classes
    $objUsa  = new usagerController();

    // nous créons également un objet pour fermer notre connexion à la bdd
    $objCnx    = new cnx();

// }

// if ($action == "connexion") {
    // récupération des champs
    $info = htmlspecialchars($_POST['username']);
    // $info = 'usager001@maintecas.com';
    // $info = '24300000';
    // $pass = htmlspecialchars($_POST['password']);

    // récupération des méthodes de l'objet $objUsa
    $stmt = $objUsa->verifierExistenceCompte($info);

    // nous vérifions la nature de l'information envoyée 
    // par l'utilisateur 


    if ($stmt->rowCount() > 0) {
        
        if (filter_var($info,FILTER_VALIDATE_EMAIL)) {
            $stmt_get_otp = $objUsa->selectionneUsager("emailusager",$info);

            $donnees_get_otp = $stmt_get_otp->fetch();

            // print_r($donnees_get_otp);

            $valeur_otp = $donnees_get_otp['otp_compte'];

            if ($valeur_otp) {
                session_start();
                $_SESSION['user_session'] = $info;
                // déclaration de la session pour récupérer les
                // infos de l'utilisateur
                $_SESSION['nomusager']    = $donnees_get_otp['nomusager'];
                $_SESSION['prenomusager'] = $donnees_get_otp['prenomusager'];
                $_SESSION['telusager']    = $donnees_get_otp['telusager'];
                $_SESSION['emailusager']  = $donnees_get_otp['emailusager'];
                $_SESSION['otp_compte']   = $donnees_get_otp['otp_compte'];
                $_SESSION['key_compte']   = $donnees_get_otp['idusager'];

                $session_active = $_SESSION['user_session'];

                // nous allons de là gérer deux rédirection qui se fera sur les variables sessions
                // input et adress ce qui permettra de renvoyer l'utilisateur vers sa demande
                if (!empty($_SESSION['input']) && !empty($_SESSION['address'])) {
                    // rédirection vers la page de résultat de recherche
                    header("location:../src/vue/technicien.php?session=".sha1($session_active)."&info=".md5($session_active));
                }else{
                    // rédirection à la page d'accueille après non soumission du formulaire
                    header("location:../../index.php?session=".sha1($session_active)."&info=".md5($session_active));
                }
                
              
            }

        }else{
            $stmt_get_otp = $objUsa->selectionneUsager("telusager",$info);

            $donnees_get_otp = $stmt_get_otp->fetch();

            $valeur_otp = $donnees_get_otp['otp_compte'];

            if ($valeur_otp) {
                session_start();
                $_SESSION['user'] = $info;

                // déclaration de la session pour récupérer les
                // infos de l'utilisateur
                $_SESSION['nomusager']    = $donnees_get_otp['nomusager'];
                $_SESSION['prenomusager'] = $donnees_get_otp['prenomusager'];
                $_SESSION['telusager']    = $donnees_get_otp['telusager'];
                $_SESSION['emailusager']  = $donnees_get_otp['emailusager'];


                $session_active = $_SESSION['user_session'];

                echo 'connecté';
                
                // rédirection 
                header("location:../../index.php?session=".sha1($session_active)."&info=".md5($session_active));
            }
        }

        
       
    }
// }