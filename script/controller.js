var option = "menu";
$(document).ready(function(){ 
	$("a").click(function(e){
		e.preventDefault();
		page = $(this).attr("href");
		if(page!="main.php")
		{
			$("#filtre").hide();
			option = "autre";

			if(page=="main.php?option=7")
			{
				option = "historique";
			}
		}
		else 
		{
			$("#filtre").show();
			option = "menu";
		}
		loadpage(page);
	})
	window.setInterval(function(){ 
		$.getJSON("moteur/miseAjourConstant.php", function(data){
			console.log(data['error']);
		});
		if(option=="menu")
		{
			$.getJSON("main.php", function(data){
				$('#contenu').html(data['contenue']); 
			})
		}
		else if(option=="historique")
		{
			$.getJSON("main.php?option=7", function(data){
				$('#contenu').html(data['contenue']); 
			})
		}
	}, 3000)
})
function loadpage(page)
{
	$.getJSON(page, function(data){
		affiche(data);
	})
}

function affiche(data)
{
	$('#contenu').fadeOut(500, function(){
		$('#contenu').empty().append(data['contenue']).fadeIn(500);
	})
}