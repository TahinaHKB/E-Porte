<?php
$numero;
function detection($type)
{
	if($type=='Enr')
	{
		$file = "logiciel/badgeP/texte/saveBadge.txt";
	}
	else 
	{
		$file = "logiciel/badgeP/texte/deleteBadge.txt";
	}
	$read = file($file);
	$testes = false;
	foreach ($read as $key) {
		if(preg_match("#^[123456789]#", $key))
		{
			$testes = true;
		}
	}
	return $testes;
}