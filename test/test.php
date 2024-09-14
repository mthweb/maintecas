<?php
include_once('../controllers/cnx.php');
include_once('../controllers/prestataireController.php');
include_once('../controllers/selectionnerController.php');
include_once('../controllers/rendreController.php');

$objCnx  = new cnx();
$objPres = new prestataireControleur();
$objSel  = new selectionnerControleur();
$objRen  = new rendreControleur();

$stmt_service = $objRen->selectionneRendu('employe',$id_get);
$data = $stmt->fetch();

print_r($data);