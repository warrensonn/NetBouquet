<div id="bandeau">
	<img src="images/lafleur.gif"	alt="Lafleur" title="Lafleur"/>
</div>
<?php 
	if(isset($_SESSION['login']))
	{
		if ($_SESSION['type'] == 'administrateur') {
			echo 'Bonjour ' . $_SESSION['type'] . ' ' . $_SESSION['login']. ', bienvenue dans l interface de modification :';
		} else {
			echo 'Bonjour ' . $_SESSION['type'] . ' ' . $_SESSION['login']. ', bienvenue dans votre boutique :';
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
	<li><a href="index.php?uc=accueil"> Accueil </a></li>
	<li><a href="index.php?uc=voirProduits&action=voirCategories"> Voir le catalogue de fleurs </a></li> <?php
	
	if (isset($_SESSION['type'])) {
		if ($_SESSION['type']=='client') { ?>		
			<li><a href="index.php?uc=gererPanier&action=voirPanier"> Voir son panier </a></li> <?php
		} else { ?>
			<li><a href="index.php?uc=gestionProduits&action=Ajouter"> Ajouter un Produit </a></li> <?php
		}
	}

	if(!isset($_SESSION['login'])) { ?> 
			<li style="float:right"><a href="index.php?uc=seconnecter&action=connexion"> Se connecter </a></li>  <?php
	} else { ?> 
			<li style="float:right"><a href="index.php?uc=deconnexion"> Se déconnecter </a></li> <?php
	} 
	?>
</ul>
