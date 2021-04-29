<?php
$action = $_REQUEST['action'];
switch($action)
{
	case 'voirPanier':
	{
		$n= nbProduitsDuPanier();
		if($n >0)
		{
			$desIdProduit = getLesIdProduitsDuPanier();  // contient les idproduits du panier
			$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);	
			// tableau de clé 0,1,2,3.. avec pour chaque clé un autre de tableau contenant les clés de la table produits avec la valeur de chaque colonne
			$desQtesProduit = getLesQteProduitsDuPanier();

			include("vues/v_panier.php");
		}
		else
		{
			$message = "Votre panier est vide";
			include ("vues/v_message.php");
		}
		break;
	}

	case 'supprimerUnProduit': // il faudrait réussir à mettre dans une liste tous les rangs qui ont été supprimé
		// $_SESSION['quantite][0] est égal à la quantité du premier article ajouté, $_SESSION['quantite][1] à la quantité du 2e article
		// je dois sauter les $_SESSION[quantite][x] qui n'ont plus de valeur
	{
		$n= nbProduitsDuPanier();
		if($n >0)
		{
			$idProduit=$_REQUEST['produit'];

			retirerDuPanier($idProduit);

			$desIdProduit = getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
			$desQtesProduit = getLesQteProduitsDuPanier();

			include("vues/v_panier.php");
		}
		else
		{
			$message = "Votre panier est dorénavant vide";
			include ("vues/v_message.php");
		}
		break;
	}
	
	case 'augmenterQte':
	{
		$idProduit=$_REQUEST['produit'];
	
		augmenteQte($idProduit);
		$desIdProduit = getLesIdProduitsDuPanier();
		$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
		$desQtesProduit = getLesQteProduitsDuPanier();
		include("vues/v_panier.php");
		break;
	}

	case 'diminuerQte':
	{
		$idProduit=$_REQUEST['produit'];

	//Fait appel a la fonction dans la classe PDO qui permet diminuer la quantité de 1

		diminuerQte($idProduit);
		$desIdProduit = getLesIdProduitsDuPanier();
		$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
		$desQtesProduit = getLesQteProduitsDuPanier();
		include("vues/v_panier.php");
		break;
	}

	case 'passerCommande' :
	    $n= nbProduitsDuPanier();
		$login = $_SESSION['login'];
		$client = $pdo->getInfosClient($login);
		
		if($n>0)
		{
			$raisonSociale = $client['raisonSociale'];
			$adresse = $client['adresse'];
			$ville = $client['villeClient'];
			$cp = $client['cpClient'];
			$mail = $client['mailClient'];

			$desIdProduit = getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
			$desQtesProduit = getLesQteProduitsDuPanier();

			$total = 0;
			$compteur=0;
			foreach( $lesProduitsDuPanier as $unProduit) 
			{
				$prix = $unProduit['prix'];
				while (!isset($_SESSION['quantite'][$compteur])) {
					$compteur+=1;
				}
				$qte = $_SESSION['quantite'][$compteur];
				$total += $prix*$qte;
				$compteur++;
			}
			$_SESSION['prixTotal'] = $total;

			include ("vues/v_commande.php");
		} else {
			$message = "Votre panier est vide";
			include ("vues/v_message.php");
		}
		break;
		
	case 'confirmerCommande' :
	{
		$login = $_SESSION['login'];
		$client = $pdo->getInfosClient($login);
		$idClient = $client['id'];
		$prix = $_SESSION['prixTotal'];

		$lesIdProduit = getLesIdProduitsDuPanier();
		$pdo->creerCommande($idClient, $lesIdProduit, $prix);
			
		$message = "Commande enregistrée";
		// supprimerPanier();

		include ("vues/v_message.php");
		break;
	}
}


?>


