<?php
/** Gestion du panier et de son affichage
 *  -------
 *  @file
 *  @brief Regroupe les fonctionnalités liées au panier de l'utilisateur et la prise de commandes
 * 
 *  @category  PPE
 *  @package   NetBouquet
 *  @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 *  @version   GIT: <0>
 */

$action = $_REQUEST['action'];
switch($action)
{
	case 'voirPanier':	  // Lors du clique sur l'onglet 'voir mon panier'
		$n= nbProduitsDuPanier();

		if($n >0)
		{
			$desIdProduit = getLesIdProduitsDuPanier();  
			$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);	
			include("vues/v_panier.php");
		} else {
			$message = "Votre panier est vide";
			include ("vues/v_message.php");
		}

		break;

	case 'supprimerUnProduit': 
		$n= nbProduitsDuPanier();
		if($n > 1)
		{
			$idProduit=$_REQUEST['produit'];
			retirerDuPanier($idProduit);

			$desIdProduit = getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);

			include("vues/v_panier.php");
		} else {
			$idProduit=$_REQUEST['produit'];
			retirerDuPanier($idProduit);

			$message = "Votre panier est dorénavant vide";
			include ("vues/v_message.php");
		}
		break;
	
	case 'augmenterQte':	// Augmenter la quantité d'un produit du panier
		$idProduit=$_REQUEST['produit'];
	
		augmenteQte($idProduit);
		$desIdProduit = getLesIdProduitsDuPanier();
		$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
		include("vues/v_panier.php");
		break;

	case 'diminuerQte':		// Diminuer la quantité d'un produit du panier
		$idProduit=$_REQUEST['produit'];

		diminuerQte($idProduit);
		$desIdProduit = getLesIdProduitsDuPanier();
		$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
		include("vues/v_panier.php");
		break;

	case 'passerCommande' :		// Le client décide de passer une commande
	    $n= nbProduitsDuPanier();
		
		$client = $pdo->getInfosClient($_SESSION['login']);
		
		if($n>0)
		{
			$raisonSociale = $client['raisonSociale'];
			$adresse = $client['adresse'];
			$ville = $client['ville'];
			$cp = $client['cp'];
			$mail = $client['mail'];

			$desIdProduit = getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);

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
		
	case 'confirmerCommande' :		// Insertion de la commande dans la base de données
		$login = $_SESSION['login'];
		$client = $pdo->getInfosClient($login);
		$idClient = $client['id'];
		$prix = $_SESSION['prixTotal'];
		$lesIdProduit = getLesIdProduitsDuPanier();
		$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($lesIdProduit);

		$pdo->creerCommande($idClient, $lesIdProduit, $prix);
			
		$message = "Commande enregistrée";
		supprimerPanier();

		include ("vues/v_message.php");
		break;
		
}


?>


