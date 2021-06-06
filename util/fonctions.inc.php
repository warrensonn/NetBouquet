﻿<?php
/** Fonctions du projet NetBouquet
 *  -------
 *  @file
 *  @brief Regroupe toutes les fonctions utilisées dans l'application et qui ne font jamais appel à la base de données
 * 
 *  @category  PPE
 *  @package   NetBouquet
 *  @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 *  @version   GIT: <0>
 */

/**
 * initPanier
 * 
 * Initialise le panier
 *
 * Crée une variable de type session dans le cas où elle n'existe pas 
 */
function initPanier()
{
	if(!isset($_SESSION['produits']))
	{
		$_SESSION['produits']= array();
		$_SESSION['quantite']= array();
	}
}


/**
 * supprimerPanier
 * 
 * Supprime le panier
 *
 * Supprime la variable $_SESSION['produits'] contenant les produits du panier
 * Supprime la variable $_SESSION['quantite'] contenant les quantités des produits du panier
 */
function supprimerPanier()
{
	unset($_SESSION['produits']);
	unset($_SESSION['quantite']);
}


/**
 * ajouterAuPanier
 * 
 * Ajoute un produit au panier
 *
 * Teste si l'identifiant du produit est déjà dans la variable session['produit'] 
 * ajoute l'identifiant à la variable de type session dans le cas où l'identifiant du produit n'a pas été trouvé
 * 
 * @param Int $idProduit identifiant d'un produit
 * 
 * @return vrai si le produit n'était pas dans la variable, faux sinon 
 */
function ajouterAuPanier($idProduit)
{
	
	$ok = true;
	if(in_array($idProduit,$_SESSION['produits']))
	{
		$ok = false;
	}
	else
	{
		$_SESSION['produits'][]= $idProduit;
		$_SESSION['quantite'][]= 1;
	}
	return $ok;
}


/**
 * getLesIdProduitsDuPanier
 * 
 * Retourne les produits du panier
 * 
 * @return un tableau contenant les idProduits présent dans le panier
*/
function getLesIdProduitsDuPanier()
{
	return $_SESSION['produits']; //array contenant les idproduits du panier
}


/**
 * nbProduitsDuPanier
 * 
 * Retourne le nombre de produits du panier
 *
 * Teste si la variable de session existe
 * et retourne le nombre d'éléments de la variable session
 * 
 * @return : le nombre de produits du panier
*/
function nbProduitsDuPanier()
{
	$n = 0;
	if(isset($_SESSION['produits'])) {
		$n = count($_SESSION['produits']);
	}
	return $n;
}


/**
 * augmenteQte
 * 
 * Augmente la quantité d'un produit du panier
 * 
 * @param Int $id 	id du produit
 */
function augmenteQte($id){
		$index =array_search($id, $_SESSION['produits']);
		$_SESSION['quantite'][$index]++;
}


/**
 * diminuerQte
 * 
 * Diminue la quantité d'un produit du panier
 * 
 * @param Int $id 	id du produit
 */
function diminuerQte($id){
		$index =array_search($id, $_SESSION['produits']);
		if($_SESSION['quantite'][$index]<=1)
		{
			$_SESSION['quantite'][$index];
		}
		else
		{
			$_SESSION['quantite'][$index]--;
		}
}

/**
 * retirerDuPanier
 * 
 * Retire un de produits du panier
 *
 * Recherche l'index de l'idProduit dans la variable session
 * et détruit la valeur à ce rang
 * 
 * @param Int $idProduit	 identifiant du produit
 */
function retirerDuPanier($idProduit)
{
		$index =array_search($idProduit, $_SESSION['produits']);
		unset($_SESSION['produits'][$index]);
		unset($_SESSION['quantite'][$index]);
}


/**
 * estUnCp
 * 
 * teste si une chaîne a un format de code postal
 *
 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
 * 
 * @param String $codePostal 	la chaîne testée
 * 
 * @return vrai ou faux
*/
function estUnCp($codePostal)
{
   return strlen($codePostal)== 5 && estEntier($codePostal);
}


/**
 * estEntier
 * 
 * teste si une chaîne est un entier
 *
 * Teste si la chaîne ne contient que des chiffres
 * 
 * @param String $valeur 	la chaîne testée
 * 
 * @return vrai ou faux
*/
function estEntier($valeur) 
{
	return preg_match("/[^0-9]/", $valeur) == 0;
}


/**
 * estUnMail
 * 
 * Teste si une chaîne a le format d'un mail
 *
 * Utilise les expressions régulières
 * 
 * @param String $mail 	  la chaîne testée
 * 
 * @return vrai ou faux
*/
function estUnMail($mail)
{
return  preg_match ('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#', $mail);
}


/**
 * getErreursSaisieCommande
 * 
 * Retourne un tableau d'erreurs de saisie pour une commande
 *
 * @param String $nom 	 la raison sociale
 * @param String $login	 le login choisi
 * @param String $mdp	 Le mot de passe choisi
 * @param String $rue 	 la rue
 * @param String $ville  la ville
 * @param String $cp 	 le cp
 * @param String $mail 	 le mail 
 * 
 * @return : un tableau de chaînes d'erreurs
 */
function getErreursSaisieCommande($raisonSociale, $login, $mdp, $rue, $ville, $cp, $mail)
{
	$lesErreurs = array();
	if($raisonSociale == "")
	{
		$lesErreurs[]="Il faut saisir le champ nom";
	}
	if($login == "")
	{
		$lesErreurs[]="Il faut saisir le champ nom";
	}
	if($mdp == "")
	{
		$lesErreurs[]="Il faut saisir le champ nom";
	}
	if($rue == "")
	{
	$lesErreurs[]="Il faut saisir le champ rue";
	}
	if($ville == "")
	{
		$lesErreurs[]="Il faut saisir le champ ville";
	}
	if($cp == "")
	{
		$lesErreurs[]="Il faut saisir le champ Code postal";
	}
	else
	{
		if(!estUnCp($cp))
		{
			$lesErreurs[]= "erreur de code postal";
		}
	}
	if($mail == "")
	{
		$lesErreurs[]="Il faut saisir le champ mail";
	}
	else
	{
		if(!estUnMail($mail))
		{
			$lesErreurs[]= "erreur de mail";
		}
	}
	return $lesErreurs;
}

?>
