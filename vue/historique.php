<?php 
	ob_start();
?>
		<link rel="stylesheet" type="text/css" href="style/menu.css">
		<style type="text/css">
		table
		{
			width: 90%;
			color: white;
			background: none;
		}
		caption
		{
			color: rgb(150, 150, 120);
			border-radius: 20px;
		}
		th
		{
			color: rgb(150, 150, 120);
			border-radius: 10px;
		}
		td
		{
			border-radius: 10px;
			text-align: center;
		}
		#titulaire
		{
			background: rgb(10, 40, 100);
		}
		#fonction
		{
			background: rgb(10, 10, 80);
		}
		#datess
		{
			background: rgb(30, 10, 80);
		}
		</style>
		<table cellpadding="5" cellspacing="10">
			<caption>HISTORIQUE : toutes les actions faites sur le système</caption> 
			<tr>
				<th id="titulaire">TYPES</th>
				<th id="fonction">MOTIFS</th>
				<th id="datess">DATES</th>
			</tr>
<?php
	foreach ($donnees as $key => $value) 
	{		
?>  
			<tr>
				<td id="titulaire"> <?= preg_replace("#_#", " ", $value['type']) ?> </td>	
				<td id="fonction"> <?= $value['motif'] ?> </td>
				<td id="datess"> <?= $value['dates'] ?> </td>
			</tr>
<?php 
	}
?>
		</table>
<?php
	$contenue = ob_get_clean(); 
	$json['contenue'] = $contenue;
	echo json_encode($json);
?>