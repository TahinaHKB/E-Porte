<?php
	include_once('fonction.php');
	include_once('insertion.php');
	updateBadge();
	nonValide();
	liste();
	$json['error'] = 'none';
	echo json_encode($json);