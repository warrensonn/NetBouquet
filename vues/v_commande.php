<?php
/** Vue du récapitulatif avant validation de la commande
 *  -------
 *  @file
 *  @brief Le client peut voir les informations sur la commande, le prix et les articles ainsi que leur quantité. Il peut de plus choisir de valider la commande
 * 
 *  @category  PPE
 *  @package   NetBouquet
 *  @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 *  @version   GIT: <0>
 */
?>

<div id="creationCommande">
<form method="POST" action="index.php?uc=gererPanier&action=confirmerCommande">
   <fieldset>
     <legend> Commande</legend>
		<p>
			<label for="raisonSociale">Raison sociale</label>
			<label id="raisonSociale" type="text" name="raisonSociale" value="<?php echo $raisonSociale ?>" size="30" maxlength="45"><?php echo $raisonSociale ?></label><br>
		</p>
		<p>
			<label for="Adresse">Adresse</label>
			<label id="Adresse" type="text" name="Adresse" value="<?php echo $adresse ?>" size="30" maxlength="45"><?php echo $adresse ?></label><br>
		</p>
		<p>
         <label for="cp">Code postal </label>
         <label id="cp" type="text" name="cp" value="<?php echo $cp ?>" size="30" maxlength="45"><?php echo $cp ?></label><br>
      </p>
      <p>
         <label for="ville">Ville </label>
         <label id="ville" type="text" name="Ville" value="<?php echo $ville ?>" size="30" maxlength="45"><?php echo $ville ?></label><br>
      </p>
      <p>
         <label for="mail">Adresse mail </label>
         <label id="mail" type="text" name="mail" value="<?php echo $mail ?>" size="30" maxlength="45"><?php echo $mail ?></label><br>
      </p> 
      <p>
         <label for="price">Prix total </label>
         <label id="price" type="text" name="price" value="<?php echo $total ?>" size="30" maxlength="45"><?php echo $total . " euros" ?></label><br>
      </p>
	  	<p style="text-align:center">
         <input type="submit" value="Valider" name="valider" style="background-color: #ccff11; border: 1px solid #600" onclick="return confirm('Êtes-vous certain de vouloir valider la commande ?');">
      </p>
   </fieldset>
</form>
</div>

<fieldset>     <!-- Affiche les articles de la commande avec leur quantité -->
      <legend> Vos articles</legend> <?php
         $compteur = 0;
         $i = 0;

         foreach( $lesProduitsDuPanier as $unProduit) 
         {
	         $id = $unProduit['id'];
	         $description = $unProduit['description'];
	         $image = $unProduit['image'];
	         $prix = $unProduit['prix'];
            while (!isset($_SESSION['quantite'][$compteur])) {
               $compteur+=1;
            }
	         $qte = $_SESSION['quantite'][$compteur]; ?>
		      <p>
		         <img src="<?php echo $image ?>" alt=image width=100	height=100 /> <?php
			      echo $description." ($prix €"; 
			      echo "x".$qte . ") soit " . $prix*$qte . " euros"; 
			      $compteur++;
               ?>
		      </p> <?php		
         } ?> <br>

</fieldset>

