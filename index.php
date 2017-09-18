<!DOCTYPE html>
<html>
	<head>
  <meta charset=utf-8>
  <meta name=description content="">
  <meta name=viewport content="width=device-width, initial-scale=1">
	<title>Laudador</title>
                  <?php  $link = @mysqli_connect("localhost","root","","pacsdb") or die(mysqli_connect_error()); ?>         

          <link rel="stylesheet" type="text/css" href="css/estilo.css">

	</head>
    <body>
       
        <?php                   
       
          
                                if(isset($_GET['idexame'])){
                                      $idexame = $_GET["idexame"];
                                      
                                      session_start();                                   

                                      $_SESSION['identificacao'] = $idexame;
                                                

                                    };

                                if(isset($_GET['crm'])){
                                      $idexame = $_GET["idexame"];
                                      $crm = $_GET["crm"];
                                      }else $crm = "123";
                            
        ?>
        
            <form method="GET"  >
                <label>Nº do Exame: </label><input type="text" name="idexame" value="<?=$idexame?>" onClick="this.value=''" onBlur="if(this.value==''){this.value='<?=$idexame?>'};">
                <p><label>CRM do Médico Assinante: </label><input type="text" name="crm" id="crm"></p>
                  <a href=""><input type="submit" value="Inserir Assinatura" /></a>
            </form>

       
        <?php
       

                        			//Select fk paciente
                        			$result0 = $link->query("SELECT study.patient_fk as fk_paciente FROM study LEFT JOIN patient ON study.patient_fk = patient.pk WHERE study.pk = {$idexame}")
                               		 or trigger_error($link->error);
                        				$fkpaciente = $result0->fetch_array(MYSQL_BOTH);
                        			//Nomde do Paciente
                        			 $result1 = $link->query("SELECT patient.pat_name as nomepaciente FROM study LEFT JOIN patient ON study.patient_fk = patient.pk WHERE study.pk = {$idexame}")
                               		 or trigger_error($link->error);
                        				$nome = $result1->fetch_array(MYSQL_BOTH);
                        			//Data de Nacsimento	
                        			 $result2 = $link->query("SELECT patient.pat_birthdate as nascimentopaciente FROM study LEFT JOIN patient ON study.patient_fk = patient.pk WHERE study.pk ={$idexame}")
                               		 or trigger_error($link->error);
                        				$nascimentopaciente = $result2->fetch_array(MYSQL_BOTH);
                        			//Nome do Medico Solicitante	
                        			 $result3 = $link->query("SELECT study.ref_physician as medicosolicitante FROM study LEFT JOIN patient ON study.patient_fk = patient.pk WHERE study.pk={$idexame}")
                               		 or trigger_error($link->error);
                        				$medicosolicitante = $result3->fetch_array(MYSQL_BOTH);
                         	
                        			//Idade 
                         			 $result4 = $link->query("SELECT (YEAR(CURDATE())-YEAR(patient.pat_birthdate)) - (RIGHT(CURDATE(),5)<RIGHT(patient.pat_birthdate,5)) AS idade FROM study LEFT JOIN patient ON study.patient_fk = patient.pk WHERE study.pk = {$idexame}")
                               		 or trigger_error($link->error);
                        				$idade = $result4->fetch_array(MYSQL_BOTH);

                        			 // Descrição do Exame
                        			 $result5 = $link->query("SELECT study.study_desc as descricaoexame FROM study LEFT JOIN patient ON study.patient_fk = patient.pk WHERE study.pk= {$idexame}")
                               		 or trigger_error($link->error);
                        				$descricaoexame = $result5->fetch_array(MYSQL_BOTH);
                                

                        			 $result6 = $link->query("SELECT `caminho` FROM `assinatura` WHERE `CRM` = {$crm}")
                               		 or trigger_error($link->error);
                        				$assinatura = $result6 ->fetch_array(MYSQL_BOTH);

                                $result7 = $link->query("SELECT `medico` FROM `assinatura` WHERE `CRM` = {$crm}")
                                   or trigger_error($link->error);
                                $medico = $result7 ->fetch_array(MYSQL_BOTH);


                               
                               $desc =  utf8_encode($descricaoexame[0]);
                              // echo $desc;
                                
                                $result8 = $link->query("SELECT texto FROM matrizes WHERE MATCH(titulo,texto) AGAINST ('{$desc}')") or trigger_error($link->error);
                                $texto = $result8 ->fetch_array(MYSQL_BOTH);
                                 $tx = utf8_encode($texto[0]);
                                 //echo $tx;
                            //SELECT texto FROM articles WHERE MATCH(titulo,texto) AGAINST ('{$desc}');


        

	
        ?>
      

  <div style="display: block;margin-left: auto;margin-right: auto;text-align: center;">
    <form action="gerador.php" action="" target="_blank" method="GET">
         
      <textarea class="tinymce" name="laudo" style="resize: 50px;">
        
        <?php ob_start(); // Ativa o buffer de saida do PHP ?>
                
               
         
          <!DOCTYPE html>
            <html style=" position: relative;min-height: 100%;">
              <head>
                <meta charset=utf-8>
                <meta name=description content="">
                <meta name=viewport content="width=device-width, initial-scale=1">
                <title></title>
              </head>
            <body >                        
        	 			
  			     <div style="position: relative;"> 
                      <p>ID:<?php echo $fkpaciente[0] ?> </p>
                      <p>Nome:<?php echo utf8_encode($nome[0]); ?></p>  
                      <p>Data de Nascimento:<?php echo $nascimentopaciente[0]; ?></p>
                      <p>Idade: <?php echo $idade[0]; ?> anos</p>
                      <p>Médico Solicitante:<?php echo utf8_encode($medicosolicitante[0]); ?></p> 
        	   </div>
            
            
             <h3 ><?php echo utf8_encode($descricaoexame[0]);?></h3>
           
              <div>
                    <p><?php print_r($tx) ;?></p>
              </div>
          
         
                <footer style=" ;  position: relative; bottom: 0px;    width: 100%; height: 60px; ">
                          <figure>
                              <p align="center"><img src="assinatura/<?php echo $assinatura[0]?>" width="200px"></p>
                          </figure>
                      <figcaption style="position:relative;"><p align="center"><?php echo ($medico[0]);?></p></figcaption>
                </footer>
            
            </body>
          </html>
                                  <?php
                                        /* Captação de dados */

                                        $buffer = ob_get_contents(); // Obtém os dados do buffer interno
                                        $filename =  "code.html"; // Nome do arquivo HTML
                                        //file_put_contents($filename, $buffer); // Grava os dados do buffer interno no arquivo HTML
                                        $_SESSION['buffer'] = $buffer;
                                       $_SESSION['filename'] = $filename;

                                    ?>
            
        
      </textarea>

        
  </div>
      
        
  <input type="submit" value="Salvar " javascript:window.close()>
  </form>
  
                
    
    
		<!-- javascript -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
		<script type="text/javascript" src="plugin/tinymce/init-tinymce.js"></script>
	</body>
</html>