<?php 
/*! \mainpage Projet NetBouquet
 *
 * \section desc Boutique de fleurs en ligne suivant le modèle MVC utilisant PHP Version 7
 * 
 * Classe d'accès aux données / Fonctions / Vues / Controleurs détaillés dans cette documentation
 *
 * @category  PPE
 * @package   NetBouquet
 * @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
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

