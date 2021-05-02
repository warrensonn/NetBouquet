<?php 
/**
 * Index du projet NetBouquet
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   NetBouquet
 * @author    Bevilacqua Warren <bevilacqua.warren@gmail.com>
 * @version   GIT: <0>
 */

session_start();
require_once 'util/fonctions.inc.php';
require_once 'util/class.pdoLafleur.inc.php';
include 'vues/v_entete.php';

if(!isset($_REQUEST['uc']))
     $uc = 'accueil';
else
	$uc = $_REQUEST['uc'];

$pdo = PdoLafleur::getPdoLafleur();	 
switch($uc)
{
	case 'accueil':
		include 'vues/v_entreprise.php';
		break;
	case 'voirProduits' :
		include 'controleurs/c_voirProduits.php';
		break;
	case 'gererPanier' :
		include 'controleurs/c_gestionPanier.php';
		break;  
	case 'seconnecter' :
		include 'controleurs/c_connexion.php';
		break;  
	case 'gestionProduits':
		include 'controleurs/c_gestionProduits.php';
		break;
	case 'historiqueCommandes':
		include 'controleurs/c_commandes.php';
		break;
	case 'deconnexion' :
		include 'controleurs/c_deconnexion.php';
		break;	 
}
?>

