<?php 
function liste()
{
	global $bdd;
	$file = "../logiciel/badgeP/texte/liste.txt";
	$read = file($file);
	foreach ($read as $key => $value) {
		if($value!='')
		{
			$info = explode('/', $value);
			$req = $bdd->prepare('INSERT INTO checkpresence(NumBadge, Dates) VALUES(:num,:d)');
			$req->execute(array(
				'num' => $info[0],
				'd' => $info[1]
        	));

			$donnees = $bdd->prepare('SELECT Titulaire FROM listebadge WHERE Numero=:n');
			$donnees->execute(array(
				"n" => $info[0]
			));
			$d = $donnees->fetch();
        	$reqs = $bdd->prepare('INSERT INTO historique(type, motif, dates) VALUES(:b,:n, :d)');
			$reqs->execute(array(
				'b' => "Validation badge",
				'n' => $d['Titulaire'],
				'd' => $info[1]
        	));
        	$donnees->closeCursor();
		}
	}
	//unlink($file);
	$fileopen = (fopen("$file",'w'));
	fclose($fileopen);
}
function nonValide()
{
	global $bdd;
	$file = "../logiciel/badgeP/texte/historique.txt";
	$read = file($file);
	foreach ($read as $key => $value) {
		if($value!='')
		{
			$info = explode('/', $value);
        	$reqs = $bdd->prepare('INSERT INTO historique(type, motif, dates) VALUES(:b,:n, :d)');
			$reqs->execute(array(
				'b' => "Non validation",
				'n' => $info[0],
				'd' => $info[1]
        	));
		}
	}
	//unlink($file);
	$fileopen = (fopen("$file",'w'));
	fclose($fileopen);
}
function updateBadge()
{
	$file = "../logiciel/badgeP/texte/badgeAutorise.txt";
	//unlink($file);
	$fileopen = (fopen("$file",'w'));
	fclose($fileopen);

	global $bdd;
	$fileopen = (fopen("$file", 'a'));
	$reponse = $bdd->query('SELECT * FROM listebadge WHERE Activation=\'checked\' ');
	while($donnees=$reponse->fetch())
	{
		fwrite($fileopen, $donnees['Numero'].'-'.preg_replace("#_#", " ",$donnees['Titulaire']).'-'.$donnees['Fonction']."\n");
	}
	$reponse->closeCursor();
	fclose($fileopen);
}