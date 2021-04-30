<?php
$action = $_REQUEST['action'];
switch($action)
{
    case 'historiqueCommandes':
        $login = $_SESSION['login'];
        $client = $pdo->getInfosClient($login);

        $idClient = $client['id'];
        $lesCommandes = $pdo->getCommandesClient($idClient);

        include 'vues/v_historiqueCommandes.php';
        break;
}