<?php
/**
 * Vue pour la modification d'un produit
 *
 * PHP Version 7
 * 
 * L'administrateur peut modifier un produit au niveau de sa description et de son prix
 *
 * @category  PPE
 * @package   NetBouquet
 * @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 * @version   GIT: <0>
 */
?>

<div id="produits">
<?php
	
	$id = $unProduit['id'];
	$description = $unProduit['description'];
	$prix=$unProduit['prix'];
	$image = $unProduit['image'];
?>
<div id="administrer">
	<form method="post" action="index.php?uc=gestionProduits&action=MiseAJour&id=<?php echo $id?>">
	   <p>
			<img src=<?php echo $image ?> alt="article" title="article">
			<br />
			<label for="description">Description  :</label>
			<input type="text" name="description" id="description" value="<?php echo $description ?>"/>
		   
			<br />
			<label for="prix">Prix :</label>
			<input type="text" name="prix" id="prix" value="<?php echo $prix ?>"/>
		   
			<br />
			<input type="submit" value="Modifier" style="background-color: #ccff11; border: 1px solid #600"/>
	   </p>
	</form>
</div>
