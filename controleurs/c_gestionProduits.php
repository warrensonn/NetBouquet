<?php
$action = $_REQUEST['action'];

switch($action) {

case 'voirCategories':
	$lesCategories = $pdo->getLesCategories();
	include("vues/v_categories.php");
  	break;
	
case 'Modifier' :		//Permet d’accéder au modification d’un produit, que lorsque l’on est connecté en tant qu’administrateur
	$idProduit=$_REQUEST['produit'];
	$unProduit=$pdo->getProduit($idProduit);
	include("vues/v_modifProduit.admin.php");
	break;

case 'MiseAJour' :		//Une fois accéder a la vue modifier, ceci va nous permettre de mettre à jour les caractéristique d’un produit, que lorsque l’on est connecté en tant qu’administrateur
	$idProduit = $_REQUEST['id'];
	$description = $_POST['description'];
	$prix = $_POST['prix'];

	//Fait appel a une fonction dans la classe PDO

	$statut=$pdo->modifiValeur($idProduit, $description, $prix);
	$unProduit=$pdo->getProduit($idProduit);

	$id = $unProduit['id'];
	$description = $unProduit['description'];
	$prix = $unProduit['prix'];

	$message = 'Modification réussite, voici les nouvelles caractéristique du produit numéro ' . $id . ' :';
	$message2 = 'Nom -> ' . $description . ' et Prix -> ' . $prix . '€';
	include "vues/v_message.php";

	$lesCategories = $pdo->getLesCategories();
	include "vues/v_categories.php";
	break;
	


case 'Supprimer' :		//Permet de supprimer un objet en onction de son ID, en tant qu’administrateur seulement
	$idProduit=$_REQUEST['produit'];
	$pdo->supprimer($idProduit);

	// $statut = $pdo->articleExiste($idProduit);
	$message = 'Suppression réussie';
	include 'vues/v_message.php';

	$lesCategories = $pdo->getLesCategories();
	include 'vues/v_categories.php';
	break;
	
case 'Ajouter' :	//Permet d’accéder à l aveu qui permet d’ajouter un produit dans la base de donnée et ainsi dans le catalogue
	include("vues/v_ajout.admin.php");
	break;
	
case 'AjouterProduit' :		//Permet d’ajouter un produit a la base de donnée et ainsi dans le catalogue
	// $id=$_REQUEST['id'];
	$categorie=$_REQUEST['categorie'];
	$description=$_REQUEST['description'];
	$image=$_REQUEST['image'];
	$prix=$_REQUEST['prix'];

	$ajouter = $pdo->ajouter($categorie, $description, $prix, $image);

	if($ajouter) {
		$message = "L'article n'a pas pu être ajouté";
		include "vues/v_message.php";
	} else {
		$message = "L'article a bien été ajouté";
		include "vues/v_message.php";		
	}
	include 'vues/v_ajout.admin.php';	
	break;
}
?>