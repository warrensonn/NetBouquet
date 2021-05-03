<?php
/**
 * Affichage de l'historique des commandes du client
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   NetBouquet
 * @author    Bevilacqua Warren <bevilacqua.warren@gmail.com>
 * @version   GIT: <0>
 */

$action = $_REQUEST['action'];
switch($action)
{
    case 'historiqueCommandes':
        $login = $_SESSION['login'];
        $client = $pdo->getInfosClient($login);

        $idClient = $client['id'];
        $lesCommandes = $pdo->getCommandesClient($idClient);

        if (!$lesCommandes) {
            $message = "Vous n'avez pas encore passé de commande";
            include 'vues/v_message.php';
        } else {
            include 'vues/v_historiqueCommandes.php';
        }
        break;
}