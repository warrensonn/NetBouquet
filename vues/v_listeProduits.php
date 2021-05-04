<?php
/**
 * Vue des produits d'une catégorie
 *
 * PHP Version 7
 * 
 * L'utilisateur voit la liste des produits et peut les ajouter à son panier
 *
 * @category  PPE
 * @package   NetBouquet
 * @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 * @version   GIT: <0>
 */
?>

<div id="produits"> <?php

foreach( $lesProduits as $unProduit) 
{
	$id = $unProduit['id'];
	$description = $unProduit['description'];
	$prix=$unProduit['prix'];
	$image = $unProduit['image'];
	?>
	<ul>
		<li><img src="<?php echo $image ?>" alt=image /></li>
		<li><?php echo $description ?></li>
		<li><?php echo " : ".$prix." Euros" ?>
		<?php
		if(isset($_SESSION['login']))
		{ 
			if ($_SESSION['type']=='administrateur') { ?>	
				<li><a href=index.php?uc=gestionProduits&produit=<?php echo $id ?>&action=Modifier> 
				<img src="images/modifier.png" TITLE="Modifier"></li></a>
				<li><a href=index.php?uc=gestionProduits&produit=<?php echo $id ?>&action=Supprimer onclick="return confirm('Voulez-vous vraiment retirer cet article ?');"> 
				<img src="images/supprimer.png" TITLE="Supprimer"></li></a> <?php
			} else { ?>
				<li><a href='index.php?uc=voirProduits&produit=<?php echo $id ?>&action=ajouterAuPanier'> 
				<img src="images/mettrepanier.png" TITLE="Ajouter au panier"> </li></a> <?php
			}		
		} ?>
	</ul> <?php		
} ?>
</div>
