<?php
// la variable action sera utilisé pour la gestion des opérations 
// qui auront lieu pour la gestion des différents modules, le 
// traitement d'une information sera gérée par les actions qui
// seront au préalable défini par le moyen d'envoi des données
$action = $_REQUEST['action'];

// nous posons un test pour vérifier si la variable action n'est
// pas vide, si oui, on récupère les modèles et les controllers 
// qui nous permettent de manipuler la base de données
if (!empty($action)) {
    // on inclut les mutateurs pour la gestion des données étant
    // donné que l'approche utilisé est l'orienté objet
    include_once('../controllers/usagerController.php');
    include_once('../models/usagerModel.php');

    // on importe notre classe connexion
    include_once('../controllers/cnx.php');

    // import de la fonction de génération des otps
    include_once('../function/otp.php');

    // on instancie les classes
    $objUsa    = new usagerController();
    $objSetUsa = new usagerModel();

}

if ($action == "inscription") {
    // récupération des champs
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom    = htmlspecialchars($_POST['nom']);
    $teleph = htmlspecialchars($_POST['telephone']);
    $email  = htmlspecialchars($_POST['email']);
    $otp    = htmlspecialchars($otp);
    $token  = sha1(htmlspecialchars($otp));

    if ($prenom == NULL || $nom == NULL || $teleph == NULL || $email == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Aucune valeur n\'a été trouvée'
        ];
    }

    $objSetUsa->setprenomusager($prenom);
    $objSetUsa->setnomusager($nom);
    $objSetUsa->settelephoneusager($teleph);
    $objSetUsa->setemailusager($email);
    $objSetUsa->setOtp($otp);
    $objSetUsa->setToken($token);

    $objUsa->creerUsager($objSetUsa);

    if($objUsa){
        // début de la variable session
        session_start();

        $_SESSION['authentification'] = $email;

        $res = [
            'status' => 200,
            'message' => "votre compte a été crée avec succès"
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 500,
            'message' => "Echec! veuillez reprendre ultérieurement"
        ];
        echo json_encode($res);
        return false;
    }
    

}