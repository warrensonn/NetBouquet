﻿<?php
/**
 * Vue d'ajout d'un produit
 *
 * PHP Version 7
 * 
 * L'administrateur peut saisir les informations sur le nouveau produit à ajouter
 *
 * @category  PPE
 * @package   NetBouquet
 * @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 * @version   GIT: <0>
 */
?>

<div id="Ajouter un Produit">
	<form method="POST" action="index.php?uc=gestionProduits&action=AjouterProduit">
		<fieldset>
			<legend>Ajout d'un Produit</legend>
				<!-- <p>
					<label for="id">Id du produit</label>
					<input id="id" type="int" name="id" size="3" maxlength="3">
				</p> -->
				<p>
					<label for="categorie">Categories</label>
					<select name="categorie">
						<option value=""> ----- Choisir ----- </option>
						<option value="com"> com </option>
						<option value="fle"> fle </option>
						<option value="pla"> pla </option>
					</select>
				</p>
				<p>
					<label for="description">Description</label>
					<input id="description" type="text" name="description" size="30" maxlength="45">
				</p>
				<p>
					<label for="image">URL image</label>
					<input id="image" type="text" name="image">
				</p>
				<p>
					<label for="prix">Prix</label>
					<input id="prix" type="float" name="prix" size="5" maxlength="8">
					€
				</p>
				<p style="text-align:center">
					<input style="background-color: #ccff11; border: 1px solid #600" type="submit" value="Valider" name="ajouter">
				</p>
	</form>
</div>