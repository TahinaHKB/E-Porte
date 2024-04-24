<?php
function listeSup()
{
	global $bdd;
	$file = "logiciel/badgeP/texte/deleteBadge.txt";
	$read = file($file);
	$noms = [];
	foreach ($read as $key) {
		$key = preg_replace("#(\r\n|\n\r|\n|\r)#", "", $key);
		$req = $bdd->prepare('SELECT Titulaire FROM listebadge WHERE Numero=:num');
		$req->execute(array(
			'num' => $key
		));
		while($donnes = $req->fetch())
		{
			array_push($noms, $donnes['Titulaire']);
		}
		$req->closeCursor();
	}
	return $noms;
}