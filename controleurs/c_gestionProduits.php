<?php
$action = $_REQUEST['action'];

switch($action) {
	
case 'verifconnexion' :	//verificonnexion fait appel a login et mot de passe ainsi qu’a la fonction situé dans la classe PDO pour vérifier si ces deux champs corresponde avec la base de donnée
	$login = $_REQUEST['login'];
	$password = $_REQUEST['password'];
	$statut = $pdo->verifConnexion($login, $password);
	
	//Si la valeur de statut est correct alors on initialise le $_SESSION et on le redirige vers la page d’accueil sinon une erreur de login ou de mot de passe apparait

	if($statut) {
		$_SESSION['login']=$login;
		header('Location: index.php');
	} else {
		echo 'erreur de login ou mot de passe';
	}
	break;
	
case 'connexion' :		//fait appel a la vue connexion, soit le formulaire qui permet d’inscrire le login et mot de passe permettant de se connecté
	include("vues/v_admin.php");
	break;

case 'voirCategories':
	$lesCategories = $pdo->getLesCategories();
	include("vues/v_categories.php");
  	break;
	
case 'Modifier' :		//Permet d’accéder au modification d’un produit, que lorsque l’on est connecté en tant qu’administrateur
	$idProduit=$_REQUEST['produit'];
	$unProduit=$pdo->getProduit($idProduit);
	include("vues/v_modifProduit.php");
	break;

case 'MiseAJour' :		//Une fois accéder a la vue modifier, ceci va nous permettre de mettre à jour les caractéristique d’un produit, que lorsque l’on est connecté en tant qu’administrateur
	$idProduit=$_REQUEST['id'];
	$description=$_POST['description'];
	$prix=$_POST['prix'];

	//Fait appel a une fonction dans la classe PDO

	$statut=$pdo->modifiValeur($idProduit, $description, $prix);

	//Si la valeur retourné est correcte alors la modification à réussie sinon cela a échoué

	if($statut) {
		echo 'Modification réussite';
	} else {
		echo 'Modification échoué';
	}
	break;
	
case 'Supprimer' :		//Permet de supprimer un objet en onction de son ID, en tant qu’administrateur seulement
	$idProduit=$_REQUEST['produit'];
	$statut=$pdo->supprimer($idProduit);

	if($statut) {
		echo 'Suppression réussite';
	} else {
		echo 'Suppression échoué';
	}
	break;
	
case 'Ajouter' :	//Permet d’accéder à l aveu qui permet d’ajouter un produit dans la base de donnée et ainsi dans le catalogue
	include("vues/v_ajout.php");
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
	include 'vues/v_ajout.php';	
	break;
}
?>