<?php

$action = $_REQUEST['action'];

switch ($action) {   
	
    case 'connexion' :		//fait appel a la vue connexion, soit le formulaire qui permet d’inscrire le login et mot de passe permettant de se connecté
	    include 'vues/v_formConnexion.php';
	    break;

    case 'verifconnexion' :	//verificonnexion fait appel a login et mot de passe ainsi qu’a la fonction situé dans la classe PDO pour vérifier si ces deux champs corresponde avec la base de donnée
	    $login = $_REQUEST['login'];
	    $password = $_REQUEST['password'];
	    $statutClient = $pdo->verifConnexionClient($login, $password);
        $statutAdmin = $pdo->verifConnexionAdmin($login, $password);

	    //Si la valeur de statut est correct alors on initialise le $_SESSION et on le redirige vers la page d’accueil sinon une erreur de login ou de mot de passe apparait
        if($statutClient) {
		    $_SESSION['login'] = $login;
            $_SESSION['type'] = 'client';
		    header('Location: index.php');
	    } elseif ($statutAdmin) {
            $_SESSION['login'] = $login;
            $_SESSION['type'] = 'administrateur';
            header('Location: index.php');
        }else {
		    $message = 'erreur de login ou mot de passe';
			include 'vues/v_message.php';
			include 'vues/v_formConnexion.php';
	    }
	    break;
		
	case 'inscription' :
		include 'vues/v_inscription.php';
		break;
	
	case 'creationCompte' :
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