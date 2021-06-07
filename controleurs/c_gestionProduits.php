<?php
/** Gestion des produits par les administrateurs
 *  -------
 *  @file
 *  @brief Permet aux administrateurs d'ajouter, de modifier et de supprimer des produits
 * 
 *  @category  PPE
 *  @package   NetBouquet
 *  @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 *  @version   GIT: <0>
 */

$action = $_REQUEST['action'];

switch($action) {

	case 'Modifier' :		//Permet d’accéder au modification d’un produit, que lorsque l’on est connecté en tant qu’administrateur
		$idProduit=$_REQUEST['produit'];
		$unProduit=$pdo->getProduit($idProduit);
		include 'vues/v_modifProduit.admin.php';
		break;

	case 'MiseAJour' :		// Une fois à la vue 'v_modifProduit.admin.php, l'administrateur peut mettre à jour les caractéristiques d’un produit
		$idProduit = $_REQUEST['id'];
		$description = $_POST['description'];
		$prix = $_POST['prix'];

		$msgErreurs = modifierProduit($description, $prix);

		if (!empty($msgErreurs)) {
			include 'vues/v_erreurs.php';
		} else {
			$statut=$pdo->modifiValeur($idProduit, $description, $prix);	// Modifie les caractéristiques du produit
			$unProduit=$pdo->getProduit($idProduit);

			$message = 'Modification réussite, voici les nouvelles caractéristique du produit numéro ' . $idProduit . ' :';
			$message2 = 'Nom -> ' . $description . ' et Prix -> ' . $prix . '€';
			include 'vues/v_message.php';
		}
		
		$lesCategories = $pdo->getLesCategories();
		include 'vues/v_categories.php';
		break;
	
	case 'Supprimer' :		//Permet de supprimer un objet en onction de son ID, en tant qu’administrateur seulement
		$idProduit=$_REQUEST['produit'];
		$pdo->supprimer($idProduit);

		$message = 'Suppression réussie';
		include 'vues/v_message.php';

		$lesCategories = $pdo->getLesCategories();
		include 'vues/v_categories.php';
		break;
	
	case 'Ajouter' :	//Permet d’accéder à l aveu qui permet d’ajouter un produit dans la base de donnée et ainsi dans le catalogue
		include 'vues/v_ajout.admin.php';
		break;
	
	case 'AjouterProduit' :		//Permet d’ajouter un produit a la base de donnée et ainsi dans le catalogue
		$categorie=$_REQUEST['categorie'];
		$description=$_REQUEST['description'];
		$image=$_REQUEST['image'];
		$prix=$_REQUEST['prix'];

		$ajouter = $pdo->ajouter($categorie, $description, $prix, $image);

		if($ajouter) {
			$message = "L'article n'a pas pu être ajouté";
			include 'vues/v_message.php';
		} else {
			$message = "L'article a bien été ajouté";
			include 'vues/v_message.php';
		}
		include 'vues/v_ajout.admin.php';
		break;

}
?>