<?php
/** Affichage de l'historique des commandes du client
 *  -------
 *  @file
 *  @brief Gère la demande d'affichage de l'historique des commandes
 * 
 *  @category  PPE
 *  @package   NetBouquet
 *  @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 *  @version   GIT: <0>
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