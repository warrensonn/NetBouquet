<?php
/**
 * Gestion de l'affichage des produits
 *
 * PHP Version 7
 * 
 * Gestion de l'affichage des produits dans l'onglet 'Voir le catalogue de fleurs'
 *
 * @category  PPE
 * @package   NetBouquet
 * @author    Bevilacqua Warren <bevilacqua.warren@gmail.com>
 * @version   GIT: <0>
 */

initPanier();
$action = $_REQUEST['action'];

switch($action)
{
	case 'voirCategories':		// Affiche les catégories pour la sélection et, par défaut, affiche les produits de la catégorie 'composition'
  		$lesCategories = $pdo->getLesCategories(); 		// Récupère les catégories
		include 'vues/v_categories.php';
		
		$lesProduits = $pdo->getToutLesProduits();
		include 'vues/v_listeProduits.php';
  		break;

	case 'voirProduits' :
		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories.php");

		if (isset($_REQUEST['categorie'])) {
			$categorie = $_REQUEST['categorie']; 	// Récupère la catégorie saisi par l'utilisateur
			$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);		// Récupère les produits de cette catégorie
		} else {	// L'utilisateur a choisi 'tous'
			$lesProduits = $pdo->getToutLesProduits();		// Récupère tout les produits
		}

		include 'vues/v_listeProduits.php';
		break;

	case 'ajouterAuPanier' :	// Permet l'ajout de produit dans le panier
		$idProduit=$_REQUEST['produit'];
		$ok = ajouterAuPanier($idProduit);
		if(!$ok)
		{
			$message = "Cet article est déjà dans le panier";
			include 'vues/v_message.php';
		}

		$lesCategories = $pdo->getLesCategories();
		include 'vues/v_categories.php';

		if (isset($_REQUEST['categorie'])) {
			$categorie = $_REQUEST['categorie'];
			$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
			include 'vues/v_listeProduits.php';
		} else {
			$lesProduits = $pdo->getToutLesProduits();
			include 'vues/v_listeProduits.php';
		}
  		
		break;
}
?>

