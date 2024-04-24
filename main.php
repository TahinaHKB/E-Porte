<?php 
	include_once('moteur/fonction.php');
	//include_once('moteur/insertion.php');
	include_once('moteur/recherche.php');
	include_once('moteur/enregistrement.php');
	include_once('moteur/suppression.php');
	// liste();
	// updateBadge();
	if(isset($_GET['nom']) && isset($_GET['dates']))
	{
		$donnees = donnerListeFiltre($_GET['dates'], $_GET['nom']);
		include_once('vue/filtre.php');
	}
	else if(!isset($_GET['option']) || $_GET['option']<=0 || $_GET['option']>7)
	{
		$donnees = donnerListeSelonDate();
		include_once('vue/menu.php');
	}
	else if($_GET['option']==1)
	{
		if(!detection('Enr'))
		{
			include_once('vue/noCarteEnr.php');
		}
		else 
		{
			include_once('vue/phaseEnregistrement.php');
		}
	}
	else if($_GET['option']==2)
	{
		if(!detection('Sup'))
		{
			include_once('vue/noCarteSup.php');
		}
		else 
		{
			$noms = listeSup();
			include_once('vue/phaseSuppression.php');
		}
	}
	else if($_GET['option']==5)
	{
		include_once('vue/msgSup.php');
	}
	else if($_GET['option']==3)
	{
		$msg = 'Une erreur s\'est produite lors de l\'enregistrement.';
		include_once('vue/msgEnr.php');
	}
	else if($_GET['option']==4)
    {
    	$msg = 'Le badge a été enregistré avec succès ! ';
    	include_once('vue/msgEnr.php');
    }
    else if($_GET['option']==6)
    {
    	$donnees = donnerBadge();
    	include_once('vue/badge.php');
    }
    else if($_GET['option']==7)
    {
    	$donnees = donnerHistorique();
		include_once('vue/historique.php');
    }