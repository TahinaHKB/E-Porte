<?php
	include_once('fonction.php');

	$file = "../logiciel/badgeP/texte/saveBadge.txt";
	$read = file($file);

	$reponse = $bdd->query('SELECT * FROM listebadge');
	$teste = true;
	while($donnees = $reponse->fetch())
	{
		if($donnees['Numero']==$read[0] || $donnees['Titulaire']==$_POST['Titulaire'])
		{
			$teste = false;
		}
	}
	$reponse->closeCursor();
	if($teste)
	{
		$chiffre = preg_replace("#(\r\n|\n\r|\n|\r)#", "", $read[0]);
		$req = $bdd->prepare('INSERT INTO listebadge(Numero, Titulaire, Fonction) VALUES(:num,:tit,:fon)');
		$req->execute(array(
			'num' => $chiffre,
			'tit' => preg_replace("# #", "_",$_POST['Titulaire']),
			'fon' => $_POST['Fonction']
		));
		unlink($file);
		$fileopen = (fopen("$file",'w'));
		array_splice($read, 0, 1);
		foreach ($read as $key) {
			fwrite($fileopen, preg_replace("#(\r\n|\n\r|\n|\r)#", "", $key)."\n");
		}
		fclose($fileopen);
		header('Location: ../main2.php?enr=1');

		$reqs = $bdd->prepare('INSERT INTO historique(type, motif, dates) VALUES(:e,:n, NOW())');
			$reqs->execute(array(
				'e' => "Enregistrement",
				'n' => preg_replace("# #", "_",$_POST['Titulaire'])
        ));
	}
	else 
	{
		unlink($file);
		$fileopen = (fopen("$file",'w'));
		array_splice($read, 0, 1);
		foreach ($read as $key) {
			fwrite($fileopen, preg_replace("#(\r\n|\n\r|\n|\r)#", "", $key)."\n");
		}
		fclose($fileopen);
		header('Location: ../main2.php?enr=0');
	}