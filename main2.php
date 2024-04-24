<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Graduate&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="style/main2.css">
	<style type="text/css">
		#logo
{
    width: 100px;
    position: absolute;
    right: 50px;
    top: 20px;
    border-radius: 50px;
    overflow: hidden;
}

	</style>
	<script type="text/javascript" src="script/jquery-3.7.0.min.js"></script>
	<script type="text/javascript" src="script/controller.js"></script>
	<title>EPorte</title>
</head>
<body>
	<?php include_once("moteur/controlVueD.php"); ?>
	<div id="logo"><img src="images/logo3.png" alt="logo ISPM" width="100%"></div>
	<div id="conteneur">
		<header id="header">
        	<div>
                <img src="images/header/setting.png" alt="">
                <h1>PANNEAU D'OBSERVATION</h1>
        	</div>
    	</header>
		<div>
        	<section id="section">
        	<h1>Nous vous souhaitons la bienvenue dans le panneau d’observation de la PORTE INTELLIGENTE et nous sommes heureux que vous utilisez nos produits. Ce système est conçu exclusivement pour suivre les entrés dans vos batiments et cette interface a été créer pour faire la suivie et la maintenance des badges checkés. On vise une securité optomale, rejouissez-vous d’avoir choisie notre système, ci dessous vous verrez les différentes opérations que vous pourriez effectuer et aussi pour voir les badges checkés.</h1>
        	</section>
        	<section id="section" class="section">
        		<form id="filtre" method="GET" action="main2.php">
					<h1>Filtrer les données</h1>
					<label for="nom">Nom : </label>
					<input type="text" id="nom" name="nom" required > </br>
					<label for="dates">Depuis : </label>
					<input type="date" id="dates" name="dates" required > </br>
					<input type="submit" value="Ok">
				</form>
				<div id="lien">
        			<img src="images/section/user.png" alt="icone represantant un personnage">
        			<nav>
            			<p><a href="main.php">PRESENTATION</a></p>
        			</nav>
       			</div>
       			<div id="lien">
        			<img src="images/section/employee.png" alt="icone d'erreur">
        			<nav>
            			<p><a href="main.php?option=6">BADGE</a></p>
        			</nav>
       			</div> 
       			<div id="lien">
        			<img src="images/section/notepad.png" alt="icone represantant un formulaire">
        			<nav>
            			<p><a href="main.php?option=1">ENREGISTREMENT</a></p>
        			</nav>
       			</div> 
       			<div id="lien">
        			<img src="images/section/error.png" alt="icone d'erreur">
        			<nav>
            			<p><a href="main.php?option=2">SUPPRESSION</a></p>
        			</nav>
       			</div>  
       			<div id="lien">
        			<img src="images/section/parchment.png" alt="icone d'erreur">
        			<nav>
            			<p><a href="main.php?option=7">HISTORIQUE</a></p>
        			</nav>
       			</div>          
			</div>
			<section id="contenu" class="section">
		
			</section>
		</div>
	</div>
</body>
</html>