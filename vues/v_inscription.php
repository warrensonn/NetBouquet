<?php
/** Vue de la création d'un compte client
 *  -------
 *  @file
 *  @brief L'utilisateur doit saisir les informations demandées pour la création d'un compte client
 * 
 *  @category  PPE
 *  @package   NetBouquet
 *  @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 *  @version   GIT: <0>
 */
?>

<form method='POST' action="index.php?uc=seconnecter&action=creationCompte">
    <fieldset>
    	<legend>Création d'un compte client</legend>
    		<p>
    			<label for="raisonSociale">Raison sociale*</label>
    			<input id="raisonSociale" type="text" name="raisonSociale" size="30" maxlength="45">
    		</p>
    		<p>
    			<label for="login">Login*</label>
    			<input id="login" type="text" name="login" size="30" maxlength="45">
    		</p>
            <p>
    			<label for="password">Mot de passe*</label>
    			<input id="mdp" type="password" name="mdp" size="30" maxlength="45">
    		</p>
    		<p>
    			<label for="adresse">Adresse*</label>
    			<input id="adresse" type="text" name="adresse" size="30" maxlength="45">
    		</p>
            <p>
    			<label for="cp">Code postal*</label>
    			<input id="cp" type="text" name="cp" size="30" maxlength="45">
    		</p>
    		<p>
    			<label for="ville">Ville*</label>
    			<input id="ville" type="text" name="ville" size="30" maxlength="45">
    		</p>
            <p>
    			<label for="mail">Mail*</label>
    			<input id="mail" type="text" name="mail" size="30" maxlength="45">
    		</p>
    		<p>
             <input style="background-color: #ccff11; border: 1px solid #600" type="submit" value="Valider" name="valider">
             <h6 style="margin-top:2px; margin-bottom:1px">*Champs obligatoires</h6>
            </p>
    </fieldset>	
</form>