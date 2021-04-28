<?php
session_start();
require_once("util/fonctions.inc.php");
require_once("util/class.pdoLafleur.inc.php");
include("vues/v_entete.php") ;
include("vues/v_bandeau.php") ;

if(!isset($_REQUEST['uc']))
     $uc = 'accueil';
else
	$uc = $_REQUEST['uc'];

$pdo = PdoLafleur::getPdoLafleur();	 
switch($uc)
{
	case 'accueil':
		include("vues/v_accueil.php");
		break;
	case 'voirProduits' :
		include("controleurs/c_voirProduits.php");
		break;
	case 'gererPanier' :
		include("controleurs/c_gestionPanier.php");
		break;  
	case 'seconnecter' :
		// include("controleurs/c_gestionProduits.php");
		include("controleurs/c_connexion.php");
		break;  
	case 'deconnexion' :
		include("controleurs/c_deconnexion.php");
		break;	 
}
include("vues/v_pied.php") ;
?>

