<?php
	ob_start()
?>
	<script type="text/javascript">
		$(document).ready(function(){
			<?php 
				if(isset($_GET['enr']))
				{
					if($_GET['enr']==0)
					{
						echo "option='autre';loadpage('main.php?option=3')";
					}
					else 
					{
						echo "option='autre';loadpage('main.php?option=4')";
					}
				}
				else if(isset($_GET['sup']))
				{
					echo "option='autre';loadpage('main.php?option=5')";
				}
				else if(isset($_GET['dates']) && isset($_GET['nom']))
				{
					$n = preg_replace("# #", "_", $_GET['nom']);
					$d = $_GET['dates'];
					echo "option='autre';loadpage('main.php?nom=$n&dates=$d')";
				}
				else 
				{
					echo "loadpage('main.php')";
				}
			?>
		})
	</script>
<?php
	$contenue = ob_get_clean();
	echo $contenue;
