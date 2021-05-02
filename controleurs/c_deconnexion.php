<?php
/**
 * Controleur de déconnexion
 *
 * PHP Version 7
 * 
 * Si appelé, détruit la session et renvoie à index.php
 *
 * @category  PPE
 * @package   NetBouquet
 * @author    Bevilacqua Warren <bevilacqua.warren@gmail.com>
 * @version   GIT: <0>
 */

session_destroy();
header('Location: index.php');
?>