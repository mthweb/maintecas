<?php
// la variable action sera utilisé pour la gestion des opérations 
// qui auront lieu pour la gestion des différents modules, le 
// traitement d'une information sera gérée par les actions qui
// seront au préalable défini par le moyen d'envoi des données
$action = $_REQUEST['action'];

// On initialise une variable $method et on l'affecte
// la veleur de la super globase $_SERVER["REQUEST_METHOD"]
// afin qu'il puisse gérer les méthodes entrées par les utilisateurs 
$method = $_REQUEST['method'];



if (!empty($action)) {

    // on inclut les mutateurs pour la gestion des données étant
    // donné que l'approche utilisé est l'orienté objet
    include_once('../controllers/usagerController.php');
    include_once('../models/usagerModel.php');

    // on importe notre classe connexion
    include_once('../controllers/cnx.php');

    // on instancie les objets
    $objUsa    = new usagerController();
    $objSetUsa = new usagerModel();
}

// on crée un script qui permettra l'envoi des données saisies par l'utilsateurs
if ($action == "inscription" && $method=="POST" && !empty($_POST)) {
    // déclaration des variables et assignations des valeurs
    $nomusager    = htmlspecialchars(strip_tags($_POST['nomusager']));
    $prenomusager = htmlspecialchars(strip_tags($_POST['prenomusager']));
    $telusager    = htmlspecialchars(strip_tags($_POST['telusager'])); 
    $emailusager  = htmlspecialchars(strip_tags('')); 

    // On pose un test pour vérifier si les valeurs saisies sont null, si 
    // on programme un message
    if ($nomusager == NULL || $prenomusager == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Aucune valeur n\'a été trouvée'
        ];
    }

    // on fait appel à nos mutateurs pour définir les valeurs à insérer
    // dans la table mt_usager, pour se faire nous allons utiliser l'
    // objet $objSetUsa pour les différents mutateuts
    $objSetUsa->setnomusager($nomusager);
    $objSetUsa->setprenomusager($prenomusager);
    $objSetUsa->settelephoneusager($telusager);
    $objSetUsa->setemailusager($emailusager);

    // une fois les données de l'usager chargée dans les mutateurs il ne
    // reste plus qu'à exécuter la requête pour effectuer l'insertion 
    // proprement dite dans la table mt_usager avec l'objet $objUsa
    $objUsa->creerUsager($objSetUsa);

    // on pose ainsi un test pour savoir ssi l'insertion à bel et bien 
    // eu lieu, si c'est le cas on renvoi un message positif si non 
    // on envoi un message d'erreur.
    if ($objUsa) {
        $res = [
            'status' => 201,
            'message' => "votre compte a été crée avec succès"
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 500,
            'message' => "Le processus de création du compte pose problème veuillez reprendre ultérieurement"
        ];
        echo json_encode($res);
        return false;
    }

}