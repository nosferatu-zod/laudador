	<?php

		include_once("conexao.php");
							$limite = 1; // limite de registros por pagina
							$pag = 0; // valor padrao se nao for enviado nenhum valor via metodo GET
						
							if(isset($_GET["pag_atual"])){$pag_atual = $_GET["pag_atual"];}else $pag_atual = 0;
		$resultado = "SELECT study.pk as id_exame, patient.pat_name as nomepaciente, study.study_desc as descricaoexame, date_format(study.study_datetime,'%d/%m/%Y')  as dataexame FROM study LEFT JOIN patient ON study.patient_fk = patient.pk ORDER BY `study_datetime` desc LIMIT $pag_atual, $limite ";
		$resultado_listar= mysqli_query($conn, $resultado);
		session_abort ();
	
	?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Laudator - Lista</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="datepicker/css/bootstrap-datepicker.css">
	</head>
	<body>
			<div class="container theme-showcase" role="main">
			<div class="page-header">
				<h1>Lista de Exames</h1>
			</div>
			
	<div class="col-md-12">
			<form method="GET">
				  	<div class="form-group">
					    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome do Paciente" name="paciente">				    
				 	</div>	   		
    				
    				<div class="form-group col-md-5 input-group date" data-provide="datepicker">
      					<input type="text" class="form-control" placeholder="de" name="datainicio" id="datainicio">
	      					<div class="input-group-addon">
			        					<span class="glyphicon glyphicon-th"></span>
			    			</div>				

    				</div>
	    				
	    			<div class="form-group col-md-5 input-group date" data-provide="datepicker">
	      				<input type="text" class="form-control" placeholder="até" name="datafim" id="datafim">
	      					
	      					<div class="input-group-addon">
			        				<span class="glyphicon glyphicon-th"></span>
			    			</div>	
	    			
	    			</div>
  					
  				<button type="submit" class="btn btn-primary">Procurar</button>    <a href="http://localhost:8080/laudator/listar/"><button type="submit" class="btn btn-primary" >Limpar</button></a>                           
  				
			</form>


	</div>
	<div class="col-xs-12 col-md-4 pull-right">
	    <div class="teemo-block">
					<a href="http://localhost:8080/laudator/assinatura/form.php" target="_blank"><button class="btn btn-primary" >Cadastrar Médico Assinante</button></a>
		</div>
	</div>

<?php 
if(isset($_GET['paciente'])||isset($_GET['datainicio'])||isset($_GET['datafim'])){
$paciente = $_GET["paciente"];
$datainicio = $_GET["datainicio"];

$datafim = $_GET["datafim"];
$resultado_listar = mysqli_query($conn, "SELECT study.pk as id_exame,study.study_desc as descricaoexame, patient.pat_name as nomepaciente, date_format(study.study_datetime,'%d/%m/%Y') as dataexame FROM study LEFT JOIN patient ON study.patient_fk = patient.pk  WHERE ( date_format(study.study_datetime,'%d/%m/%Y') BETWEEN '{$datainicio}' AND '{$datafim}') OR ( patient.pat_name like '%{$paciente}%') ORDER BY `study_datetime` desc");

}
//if(isset($_GET['datainicio'])||isset($_GET['datafim'])){
//$datainicio = $_GET['datainicio'];

//$datafim = date($_GET['datafim']);
//$resultado_listar = mysqli_query($conn, "SELECT *,date_format(dataexame,'%d/%m/%Y') FROM `exame` WHERE date_format(dataexame,'%d/%m/%Y') BETWEEN '{$datainicio}' AND '{$datafim}'");
//}
?>
			
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>N° Exame</th>
								<th>Exame</th>
								<th>Nome do Paciente</th>
								<th>Data do Exame</th>
								<th>Ação</th>
								<th>Laudo</th>
							</tr>
						</thead>
						<tbody>
							<?php while($rows_exames = mysqli_fetch_assoc($resultado_listar)){ ?>
								<tr>
									<td><?php echo $idexame = $rows_exames['id_exame'];?></td>									
									<td><?php echo utf8_encode($rows_exames['descricaoexame']);?></td>
									<td><?php echo utf8_encode($rows_exames['nomepaciente']); ?></td>
									<td><?php echo $rows_exames['dataexame']; ?></td>
									<td>
										<a style="text-decoration: none; " href="../geradorpdf/pdf/<?=$idexame?>.pdf" target="_blank" onclick="window.open(this.href,'laudo','width=680,height=470'); return false;"><button type="button" class="btn btn-xs btn-primary" >Visualizar</button></a>
										
										<a style="text-decoration: none; " href="../index.php?idexame=<?=$idexame?>"  onClick="return confirm('Esta ação irá apagar o laudo! Salve o conteúdo antes de Continuar!')" target="_blank"><button type="button" class="btn btn-xs btn-warning">Editar</button></a>
										
										<a href="../geradorpdf/pdf/apagar.php?tmpString=<?=$idexame?>" onClick="return confirm('Deseja realmente deletar o laudo: <?php echo $rows_exames['id_exame']; ?> ?')"><button type="button" class="btn btn-xs btn-danger">Apagar</button></a>
									</td>
									<td><?php $arquivo = '../geradorpdf/pdf/'. $idexame .'.pdf'; if(file_exists($arquivo)){ echo 'Digitado';}else echo 'Vazio'; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					 </table>
				</div>
					<?php

						$tabela = "study"; // altere aqui sua tabela do banco de dados


						if (!$pag_atual) {	
							$pag_atual = $pag;
						} else {
							$pag_atual = $pag_atual;
						}
						// sql que pega o resultado total de registro
						$sql2 = mysqli_query($conn,"SELECT * FROM $tabela") or die();
						$resultado2 =  mysqli_num_rows($sql2);
						// fim sql

					
						$contagem_linhas = (int) mysqli_num_rows($resultado_listar);

						echo "     Foram encontrados $contagem_linhas resultados de $resultado2<br />";
						while ($linha = mysqli_fetch_array($resultado_listar)) {
						$campo1 = $linha["study_desc"]; // campos que vao repetir na função while... copie, cole e renomeie para fazer outro
						$campo2 = $linha["pk"];
						echo "$campo1 - $campo2<br />";
						}
						// fim sql


						// inicio paginação
						//$res_int = (int) $resultado; 
						$l_int =  (int) $limite;
						$ultima = ceil($contagem_linhas/$limite); // define o valor da ultima pagina
						$anterior = $pag_atual-$limite; // define o valor da pagina anterior a atual

						if ($anterior < 0) { // se anterior for menor que 0, ele exibe apenas os nomes sem link
						echo "Primeira - Anterior - ";
						} else { // senao ele exibe os links
						echo " <a href=index.php?pag_atual=0>Primeira - </a>";
						echo " <a href=index.php?pag_atual=$anterior>Anterior - </a>";
						}

						$proxima = intval($pag_atual+$limite); // define o valor da proxima pagina
						if ($proxima > $resultado2) { // não deixa o link passar do total de registros
						echo "Proxima - Ultima";
						} else {
						echo " <a href=index.php?pag_atual=$proxima>Proxima - </a>";
						echo " <a href=index.php?pag_atual=$ultima>Ultima</a>";
						}
					?>
			</div>		
		</div>
							
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>

						<script type="text/javascript">
							
							//$.fn.datepicker.defaults.language = "pt-BR";
							//$.fn.datepicker.defaults.format = "yyyy-mm-dd";
						</script>



  </body>
</html>