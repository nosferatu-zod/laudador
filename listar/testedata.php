<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>TesteData</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="datepicker/css/bootstrap-datepicker.css">
	<?php 

		include_once("conexao.php");
		$resultado = "SELECT * FROM `exame`";
		$resultado_listar= mysqli_query($conn, $resultado);

	?>
</head>
	<body>

		<form>
		  	<div class="form-group" method="GET"  >
			    <label for="nome">Nome do Paciente</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nome" placeholder="Nome do Paciente">
			    <small id="emailHelp" class="form-text text-muted">Digite qualquer parte do nome.</small>
		 	</div>
		 	
		 	<div class="row">
    			<div class="form-group col-md-6 input-group date" >
      				<input type="text" class="form-control" placeholder="de" name="DataInicio" id="datainicio">
      					<div class="input-group-addon">
		        					<span class="glyphicon glyphicon-th"></span>
		    			</div>				

    			</div>
    			<div class="form-group col-md-6 input-group date" data-provide="datepicker">
      				<input type="text" class="form-control" placeholder="até" name="DataFim" id="datafim">
      					<div class="input-group-addon">
		        					<span class="glyphicon glyphicon-th"></span>
		    			</div>				

    			</div>
    			
  			</div>		
  		<button type="submit" class="btn btn-primary">Procurar</button>
	</form>
<script type="text/javascript">
	$('#datainicio').datepicker({
	    format: 'mm/dd/yyyy',
	    
	    language: 'pt-BR',
	});
	$('#datafim').datepicker({
	    format: 'mm/dd/yyyy',
	    
	    language: 'pt-BR',
	});
</script>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
		
	</body>
</html>