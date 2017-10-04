<!DOCTYPE html>
<html>
	<head>
  <meta charset=utf-8>
  <meta name=description content="">
  <meta name=viewport content="width=device-width, initial-scale=1">
	<title>Laudador</title>
                  <?php  
                     function remover_caracter($string) {
                      $string = preg_replace("/[áàâãä]/", "a", $string);
                      $string = preg_replace("/[ÁÀÂÃÄ]/", "A", $string);
                      $string = preg_replace("/[éèê]/", "e", $string);
                      $string = preg_replace("/[ÉÈÊ]/", "E", $string);
                      $string = preg_replace("/[íì]/", "i", $string);
                      $string = preg_replace("/[ÍÌ]/", "I", $string);
                      $string = preg_replace("/[óòôõö]/", "o", $string);
                      $string = preg_replace("/[ÓÒÔÕÖ]/", "O", $string);
                      $string = preg_replace("/[úùü]/", "u", $string);
                      $string = preg_replace("/[ÚÙÜ]/", "U", $string);
                      $string = preg_replace("/ç/", "c", $string);
                      $string = preg_replace("/Ç/", "C", $string);
                      $string = preg_replace("/[][><}{)(:;,!?*%~^`@]/", "", $string);
                      $string = preg_replace("/ /", " ", $string);
                      return $string;}
                  $link = @mysqli_connect("192.168.1.180","root","123","pacsdb") or die(mysqli_connect_error()); 
                  ?>         

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
                                $data = date_create($nascimentopaciente[0]);
                               
                                
                        			//Nome do Medico Solicitante	
                        			 $result3 = $link->query("SELECT study.ref_physician as medicosolicitante FROM study LEFT JOIN patient ON study.patient_fk = patient.pk WHERE study.pk={$idexame}")
                               		 or trigger_error($link->error);
                        				$medicosolicitante = $result3->fetch_array(MYSQL_BOTH);
                         	
                        			//Idade 
                         			 $result4 = $link->query("SELECT TIMESTAMPDIFF(YEAR, patient.pat_birthdate, CURDATE()) AS idade FROM study LEFT JOIN patient ON study.patient_fk = patient.pk WHERE study.pk = {$idexame}")
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
                              //echo $desc;
                                
                                $result8 = $link->query("SELECT min(id) FROM matrizes WHERE MATCH(titulo,texto) AGAINST ('{$desc}')") or trigger_error($link->error);
                                $idMatriz = $result8 ->fetch_array(MYSQL_BOTH);
                                //echo $idMatriz;


                                $result9 = $link->query("SELECT texto FROM matrizes WHERE id = ('{$idMatriz[0]}')") or trigger_error($link->error);
                                $texto = $result9 ->fetch_array(MYSQL_BOTH);

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
                      <p>ID: <?php echo $fkpaciente[0] ?> </p>
                      <p>Nome: <?php echo remover_caracter($nome[0]); ?></p>  
                      <p>Data de Nascimento: <?php echo date_format($data,'d/m/Y') ?></p>
                      <p>Idade: <?php echo $idade[0]; ?> anos</p>
                      <p>Médico Solicitante: <?php echo utf8_encode($medicosolicitante[0]); ?></p> 
        	   </div>
            
            
             <h3 ><?php echo utf8_encode($descricaoexame[0]);?></h3>
           
              <div>
                    <p><?php print_r($tx) ;?></p>
              </div>
          
         
                <footer style=" ;  position: relative; bottom: 0px;    width: 100%; height: 60px; ">
                          <figure>
                              <p align="center"><img src="assinatura/<?php echo $assinatura[0]?>" width="100px"></p>
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