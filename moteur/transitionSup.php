<?php 
include_once("fonction.php");
$file = "../logiciel/badgeP/texte/deleteBadge.txt";
$read = file($file);
$curs = 0;
foreach ($_POST as $key => $value) {
	$read[$curs] = preg_replace("#(\r\n|\n\r|\n|\r)#", "", $read[$curs]);
	if($value=="oui")
	{
		$req = $bdd->prepare("DELETE FROM listebadge WHERE Titulaire=:nom");
		$req->execute(array(
			"nom" => $key
		));
		$req = $bdd->prepare("DELETE FROM checkpresence WHERE NumBadge=:num");
		$req->execute(array(
			"num" => $read[$curs]
		));

		$reqs = $bdd->prepare('INSERT INTO historique(type, motif, dates) VALUES(:s,:n, NOW())');
			$reqs->execute(array(
				"s" => "Suppression",
				"n" => $key
        ));
	}
	$curs++;
}
unlink($file);
$fileopen = (fopen("$file",'w'));
fclose($fileopen);
header("Location: ../main2.php?sup=1");