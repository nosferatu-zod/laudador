<?php
	$link = @mysqli_connect("localhost","root","","pacsdb") or die(mysqli_connect_error());
			

			if (isset($_GET['tmpString'])){
			    $tmpString = $_GET['tmpString'];
				mysqli_query($link,"DELETE FROM `laudo` WHERE `laudo`.`pdf` = '{$tmpString}'") or  trigger_error($link->error) ;
				$arquivodeletar = $tmpString .'.pdf';
				unlink($arquivodeletar);
 				
 				echo '<!DOCTYPE html>
						<html>
						<head>
						<title></title>
						<script>
						  			window.onload = function () {					            

						            window.alert("Laudo deletado com sucesso!");
						            window.location.href = "../../listar/index.php";
						       
						            };
						</script>
						</head>
						<body>
						</body>
						</html>';
			}else
			    $tmpString = null;

			
?>
