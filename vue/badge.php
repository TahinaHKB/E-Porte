<?php 
	ob_start();
?>
		<link rel="stylesheet" type="text/css" href="style/badge.css">
		<script type="text/javascript">
			function change(nom, act)
			{
				$.getJSON("moteur/changeActivation.php?titulaire="+nom+"&act="+act, function(data){
					// console.log(data['titulaire']);
				})
			}	
		</script>
		<table cellpadding="5" cellspacing="10">
			<caption>Liste des badges</caption> 
			<tr>
				<th id="titulaire">TITULAIRE</th>
				<th id="fonction">FONCTION</th>
				<th id="datess">ACTIVATION</th>
			</tr>
<?php
	foreach ($donnees as $key => $value) 
	{		
?>  
			<tr>
				<td id="titulaire"> <?= preg_replace("#_#", " ", $value['Titulaire']) ?> </td>	
				<td id="fonction"> <?= $value['Fonction'] ?> </td>
				<td id="datess">
					<input type="checkbox" id="<?= $value['Titulaire'] ?>" class='checkbox' <?= $value['Activation'] ?> onclick="change('<?= $value['Titulaire'] ?>', '<?= $value['Activation'] ?>')">
					<label for="<?= $value['Titulaire'] ?>" class="toggle">
						<p>
							OFF &emsp; ON
						</p>
					</label>
				</td>
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