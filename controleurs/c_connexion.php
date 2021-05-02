<?php
/**
 * Controleur pour la connexion à un compte, ou la création d'un compte
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   NetBouquet
 * @author    Bevilacqua Warren <bevilacqua.warren@gmail.com>
 * @version   GIT: <0>
 */

$action = $_REQUEST['action'];

switch ($action) {   
	
    case 'connexion' :		//fait appel a la vue connexion, soit le formulaire qui permet d’inscrire le login et mot de passe permettant de se connecté ou le choix de créer un compte
	    include 'vues/v_formConnexion.php';
	    break;

    case 'verifconnexion' :		// verifiz si le couple login / mot de passe 
	    $login = $_REQUEST['login'];
	    $password = $_REQUEST['password'];
	    $statut = $pdo->verifConnexionCompte($login, $password);	// Fonction renvoyant un tableau si le couple login / mot de passe existe

	    //Si la valeur de statut est correct alors on initialise le $_SESSION et on redirige vers la page d’accueil sinon une erreur de login ou de mot de passe apparait
        if($statut) 
		{
		    $_SESSION['login'] = $login;
			if ($statut['type'] == 1) {
				$_SESSION['type'] = 'administrateur';
			} else {
				$_SESSION['type'] = 'client';
			}          
		    header('Location: index.php');
	    } else {
		    $message = 'erreur de login ou de mot de passe';
			include 'vues/v_message.php';
			include 'vues/v_formConnexion.php';
	    }
	    break;
		
	case 'inscription' :	 // L'utilisateur souhaite s'inscrire
		include 'vues/v_inscription.php';
		break;
	
	case 'creationCompte' :		// Gère la création du compte client
		$raisonSociale = $_REQUEST['raisonSociale'];
		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
		$adresse = $_REQUEST['adresse'];
		$cp = $_REQUEST['cp'];
		$ville = $_REQUEST['ville'];
		$mail = $_REQUEST['mail'];

		$pdo->creationCompte($raisonSociale, $login, $mdp, $adresse, $cp, $ville, $mail);
		
		$_SESSION['login'] = $login;
        $_SESSION['type'] = 'client';
		$_SESSION['inscription'] = 1;
		header('Location: index.php');
		break;
}
?>