<h4> ¤ Vos commandes </h4>

<?php
foreach($lesCommandes as $uneCommande) 
{
	$id = $uneCommande['id'];
	$dateCommande = $uneCommande['dateCommande'];
	$prix = $uneCommande['prix']; 
	$articlesCommande = $pdo->getArticlesCommande($id);
?>
	<fieldset style='background-color:#d0dcee'>
		<legend><?php echo 'Commande numéro : ' . $id ?></legend>
		<ul>
			<li><span> <?php echo 'Date de la commande : ' . $dateCommande ?></span></li>
			<li><span> <?php echo 'Prix : ' . $prix ?></span></li> 
			<fieldset style="background-color:#e5ebf3"> 
				<legend>¤ Les articles</legend>
				<ul><?php
				foreach ($articlesCommande as $unArticle) { ?>
					<li><span> <?php echo 'Description : ' . $unArticle['description'] . ', quantité : ' . $unArticle['quantité'] ?></span></li> <?php
				} ?>
				</ul>
			</fieldset>
		</ul> 
	</fieldset> <?php
} ?>
		