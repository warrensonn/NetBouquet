<?php
/**
 * Vue Entête
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   NetBouquet
 * @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com>
 * @version   GIT: <0>
 */
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<div id="bandeau">
	<img src="images/lafleur.gif"	alt="Lafleur" title="Lafleur"/>
</div>

<!-- TITRE ET MENUS -->
<html lang="fr">
<head>
<title>Application NetBouquet</title>
<meta http-equiv="Content-Language" content="fr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="util/cssGeneral.css" rel="stylesheet" type="text/css">
<?php

if(isset($_SESSION['login']))
{
	if ($_SESSION['type'] == 'administrateur') 
	{
		echo 'Bonjour administrateur ' . $_SESSION['login'] . ', bienvenue dans l interface de modification :';
	} else {
		echo 'Bonjour client ' . $_SESSION['login'] . ', bienvenue dans votre boutique :';
		if (isset($_SESSION['inscription'])) {
			$message = "Votre compte a bien été créé, vous êtes maintenant connecté";
			include 'vues/v_message.php';
			unset($_SESSION['inscription']);
		}
	}
}
?>
<!--  Menu haut-->
<ul id="menu">
	<li style="background-color:#3febdc"><a href="index.php?uc=accueil"> Accueil </a></li>
	<li style="background-color:#3febdc"><a href="index.php?uc=voirProduits&action=voirCategories"> Voir le catalogue de fleurs </a></li> <?php
	
	if (isset($_SESSION['type'])) {
		if ($_SESSION['type']=='client') { ?>		
			<li style="background-color:#3febdc" ><a href="index.php?uc=gererPanier&action=voirPanier"> Voir mon panier </a></li> 
			<li style="background-color:#3febdc" ><a href="index.php?uc=historiqueCommandes&action=historiqueCommandes"> Voir mes commandes </a></li> <?php
		} else { ?>
			<li style="background-color:#3febdc" ><a href="index.php?uc=gestionProduits&action=Ajouter"> Ajouter un Produit </a></li> <?php
		}
	}

	if(!isset($_SESSION['login'])) { ?> 
			<li style="float:right; background-color:#3febdc"><a href="index.php?uc=seconnecter&action=connexion"> Se connecter </a></li>  <?php
	} else { ?> 
			<li style="float:right; background-color:#3febdc"><a href="index.php?uc=deconnexion"> Se déconnecter </a></li> <?php
	} 
	?>
</ul>