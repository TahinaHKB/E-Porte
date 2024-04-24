<?php
	ob_start();
?>
	<style type="text/css">
		#noCarte
		{
			color: orange;
			margin: 0 auto;
/*			border: 1px solid black;*/
			font-size: 30px;
			margin-top: 10px;
			text-align: center;
		}
	</style>
	<p id="noCarte">
		Ooops... Aucune nouvelle carte à enregistrer :( </br></br>
		<img src="images/user (1).png" width="75px">
	</p>
<?php	
	$contenue= ob_get_clean();
	$json['contenue'] = $contenue;
	echo json_encode($json);
?>