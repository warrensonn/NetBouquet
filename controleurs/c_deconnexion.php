<?php
/** Controleur de déconnexion
 *  -------
 *  @file
 *  @brief à l'appel, détruit la session et renvoie à index.php
 * 
 *  @category  PPE
 *  @package   NetBouquet
 *  @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 *  @version   GIT: <0>
 */

session_destroy();
header('Location: index.php');
?>