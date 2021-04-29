<div id="admin">
<form method="POST" action="index.php?uc=seconnecter&action=verifconnexion">
<fieldset>
	<legend>Connexion</legend>
		<p>
			<label for="login">Login*</label>
			<input id="login" type="login" name="login" size="30" maxlength="45">
		</p>
		<p>
			<label for="password">Mot de passe*</label>
			<input id="password" type="password" name="password" size="30" maxlength="45">
		</p>
		<p>
         <input style="background-color: #ccff11; border: 1px solid #600" type="submit" value="Valider" name="valider">
        </p>
</fieldset>		
</form>
</div> <br><br>

<form method="POST" action="index.php?uc=seconnecter&action=inscription">
	<fieldset>
      <legend> Vous n'avez pas encore de compte ? Créez-en un </legend>
	  	<p>
         	<input style="background-color: #ccff11; border: 1px solid #600" type="submit" value="Créer un compte" name="valider">
       	</p>	
	</fieldset>
</form>

