<?php
	$titre = 'Suppression';
	ob_start();
?>
	<style type="text/css">
		#mSp
		{
			color: orange;
			text-align: center;
			font-size: 30px;
		}
	</style>
	<p id="mSp">Les ordres ont été effectuées ! </p>
<?php
	$contenue = ob_get_clean();
	$json['contenue'] = $contenue;
	echo json_encode($json);
?>