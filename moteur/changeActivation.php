<?php
	include_once('fonction.php');
	if($_GET['act']=='checked')
	{
		$act = 'not';
	}
	else 
	{
		$act = 'checked';
	}
	$req = $bdd->prepare("UPDATE listebadge SET Activation=:a WHERE Titulaire=:t");
	$req->execute(array(
		"a" => $act,
		"t" => $_GET['titulaire']
	));

	$json['titulaire'] = $_GET['titulaire'];
	echo json_encode($json);