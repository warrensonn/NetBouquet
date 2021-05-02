<?php
/**
 * Vue d'affichage des erreurs
 *
 * PHP Version 7
 * 
 * L'utilisateur peut voir l'ensemble des erreurs affichées
 *
 * @category  PPE
 * @package   NetBouquet
 * @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 * @version   GIT: <0>
 */
?>

<div class="erreur">
<ul>
<?php
foreach($msgErreurs as $erreur)
	{
 ?>     
	  <li><?php echo $erreur . 'De plus' ?></li>
<?php	  
	}
?>
</ul>
</div>
