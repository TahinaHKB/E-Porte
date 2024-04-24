<?php
function donnerListeSelonDate()
{
	global $bdd;
	$donnees = $bdd->query('SELECT chPr.Dates dates,
							  lb.Titulaire titulaire, lb.Fonction fonction 
							  FROM listebadge lb INNER JOIN checkpresence chPr 
							  ON lb.Numero = chPr.NumBadge ORDER BY dates DESC');
	$valeur = $donnees->fetchAll();
	return $valeur;
}

function donnerListeFiltre($datesFix, $noms)
{
	global $bdd;
	$donnees = $bdd->prepare('SELECT chPr.Dates dates,
							  lb.Titulaire titulaire, lb.Fonction fonction 
							  FROM listebadge lb INNER JOIN checkpresence chPr 
							  ON lb.Numero = chPr.NumBadge WHERE titulaire=:nom AND dates>=:dat ORDER BY dates DESC');
	$donnees->execute(array(
		"nom" => $noms,
		"dat" => $datesFix
	));
	$valeur = $donnees->fetchAll();
	return $valeur;
}

function donnerBadge()
{
	global $bdd;
	$donnees = $bdd->query('SELECT * FROM listebadge ORDER BY Titulaire');
	$valeur = $donnees->fetchAll();
	return $valeur;
}

function donnerHistorique()
{
	global $bdd;
	$donnees = $bdd->query('SELECT * FROM historique ORDER BY dates DESC');
	$valeur = $donnees->fetchAll();
	return $valeur;
}