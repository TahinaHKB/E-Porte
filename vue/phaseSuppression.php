<?php
	ob_start();
?>
	<link rel="stylesheet" type="text/css" href="style/phaseSuppression.css">
	<style type="text/css">
		#conteneur
		{
			color: white;
		}
	</style>
	<h1 id="pSh">Des cartes sont préparés à être supprimés</h1>
	<p id="pSp">Veuillez confirmer les badges qui doivent être oubliés</p>
	<form method='POST' action='moteur/transitionSup.php'>
<?php foreach($noms as $key) { ?>
		<fieldset>
			<legend><?= preg_replace("#_#", " ", $key) ?></legend>
			<p>Supprimer tout les données correspondant à <?= preg_replace("#_#", " ", $key) ?> ?</p>
			<input type="radio" name="<?= $key ?>" value="oui" checked />
			<label>Oui</label></br>
			<input type="radio" name="<?= $key ?>" value="non" />
			<label>Non</label>
		</fieldset> 
<?php } ?>
	<input type="submit" value="Ok" />
	</form>
<?php
	$contenue = ob_get_clean();
	$json['contenue'] = $contenue;
	echo json_encode($json);
?>