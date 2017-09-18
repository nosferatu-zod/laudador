<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 
    <script src="bootstrap.min.js"></script>
<title>Upload de arquivos</title>
</head>

<body>
  
    <div class="col-4">
      
      <div class="form-group col-4">
          <form method="post"  enctype="multipart/form-data" action="recebeUpload.php">
             <h5>Selecione uma imagem: <input name="arquivo" type="file" /></h5>
      	     <p>Digite o CRM: <input name="crm" type="text" /></p>
             <p>Digite o Nome: <input name="medico" type="text" /></p>

             <input type="submit" value="Salvar" />
          </form>
          </div>
          </div>
          
      
  <div class="col-4">
      
    </div>
      <div class="form-group col-4">
      <h5>Deletar uma Assinatura</h5>
          <form method="post"  enctype="multipart/form-data" action="form.php">

             <p>Digite o CRM a ser deletado: <input name="deletar" type="text" /></p>

             <input type="submit" value="Salvar" />
          </form>
      </div>
   


    <?php
    $link = @mysqli_connect("localhost","root","","pacsdb") or die(mysqli_connect_error());
    
  

          if(isset($_POST['deletar'])){
             $deletar = $_POST["deletar"];
                        
          }else echo $deletar=null;

      if($deletar!=null){
      $resultado = mysqli_query($link,"DELETE FROM `assinatura` WHERE `CRM` = {$deletar}");
      if($resultado!=null){
        echo "Deletado com sucesso!";

      }else{
        echo "CRM nao encontrado!";
      }
    }
    
    ?>
    
</body>
</html>