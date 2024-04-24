<?php
	ob_start();
?>
	<!-- <link rel="stylesheet" type="text/css" href="style/phaseEnregistrement.css"> -->
	<style type="text/css">
		#image
		{
			width: 100px;
			margin: 0 auto;
		}	
		#conteneur
		{
			color: white;
		}
	</style>
	<h1 id="pEtitre">Ereukaa ! Une nouvelle carte detectée ^-^</h1>
	<p id="pEp">
		Veuillez entrer les informations correspondants à ce nouveau badge
	</p>
	<div id="image">
		<img src="images/section/user.png" width="75px">
	</div>
	<form action="moteur/transitionEnr.php" method="POST">
		<fieldset>
			<legend>INFORMATIONS</legend>
			<label for="Titulaire">Nom du Titulaire : </label>
			<input type="text" name="Titulaire" required='true'/> </br></br>
			<label for="Fonction">Fonction : </label>
			<input type="text" name="Fonction" required='true'/> </br></br>
			<input type="submit" value="Envoyer" id="submit"/>
		</fieldset>
	</form>
<?php
	$contenue = ob_get_clean();
	$json['contenue'] = $contenue;
	echo json_encode($json);
?>