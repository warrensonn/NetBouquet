<img src="images/votrePanier1.png" alt="Panier" title="panier" height="150px" width="300" style="margin-top:-30px"/>
<img src="images/cady.png"	alt="Panierb" title="panier" height="80px" style="margin-bottom:30px"/>
<?php

$compteur = 0;
$i = 0;
// print_r($desIdProduit);
// print_r($desQtesProduit);	
//print_r($lesProduitsDuPanier[0]);
//print_r($_SESSION['quantite']);
foreach( $lesProduitsDuPanier as $unProduit) 
{
	$id = $unProduit['id'];
	$description = $unProduit['description'];
	$image = $unProduit['image'];
	$prix = $unProduit['prix'];
	$qte = $_SESSION['quantite'][$compteur];
	?>

	<p>
	<img src="<?php echo $image ?>" alt=image width=100	height=100 />
	<?php
		echo $description." ($prix Euros)";
	?>		
	<a href="index.php?uc=gererPanier&produit=<?php echo $id ?>&action=diminuerQte" >
	<img src="images/diminuerQte.png" TITLE="Diminuer la quantité du produit" ></a>	
	<?php 
		echo "Quantité : ".$qte; 
		$compteur++;
	?>
	<a href="index.php?uc=gererPanier&produit=<?php echo $id ?>&action=augmenterQte" >
	<img src="images/augmenterQte.png" TITLE="Augmenter la quantité du produit" ></a>
	
	<a href="index.php?uc=gererPanier&produit=<?php echo $id ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article frais?');">
	<img src="images/retirerpanier.png" TITLE="Retirer du panier" ></a>
	
	</p>
	<?php
}
?>
<br>
<div style="text-align: center">
<a href=index.php?uc=gererPanier&action=passerCommande><img src="images/commander.jpg" TITLE="Passer commande"></a>
</div>