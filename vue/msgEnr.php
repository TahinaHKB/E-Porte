<?php
	$titre = 'Message';
	$style = 'style/msgEnr.css';
	ob_start();
?>
	<style type="text/css">
		#mEp
		{
			color: orange;
			text-align: center;
			font-size: 30px;
		}
	</style>
	<h1 id="mEp"> <?= $msg ?> </h1>
<?php
	$contenue = ob_get_clean();
	$json['contenue'] = $contenue;
	echo json_encode($json);
?>
