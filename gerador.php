<?php
session_start();
$link = @mysqli_connect("localhost","root","","pacsdb") or die(mysqli_connect_error()); 
 				
 				$laudo = $_GET["laudo"];
 				$buffer = $laudo;
                $filename = $_SESSION['filename'];
                file_put_contents($filename, $buffer);
/* Inclusão da classe mPDF */
include('geradorpdf/mpdf60/mpdf.php');

// Extrai os dados do HTML gerado pelo programa PHP
$filename =  "code.html";
$html = file_get_contents($filename);
//$mpdf = new mPDF('','A4',NULL,''); // Página, fonte;
$mpdf = new mPDF(
             '',    // mode - default ''
             '',    // format - A4, for example, default ''
             0,     // font size - default 0
             '',    // default font family
             15,    // margin_left
             15,    // margin right
             58,     // margin top    -- aumentei aqui para que não ficasse em cima do header
             0,    // margin bottom
             6,     // margin header
             0,     // margin footer
             'L');  // L - landscape, P - portrait
$cabecalho= '<header id="header" style="position:relative;">
		<figcaption>Endereço -  Telefone Blabla bla</figcaption>
		<figure>
  			<img src="logo.png"  alt="logoHCR" width="400px"> 
		</figure>
	</header>';
$mpdf->setHTMLHeader($cabecalho);


/*
 * A conversão de caracteres foi necessária aqui, mas pode não ser no seu servidor.
 * Certifique-se disso nas configurações globais do PHP.
 * Usar codificação errada resulta em travamento.
 */
/*$mpdf->allow_charset_conversion = true; //Ativa a conversão de caracteres;
$mpdf->charset_in = 'windows-1252'; //Codificação do arquivo '$filename';*/

/* Propriedades do documento PDF */
$mpdf->SetAuthor('AVANTECH'); // Autor
$mpdf->SetSubject("LAUDO"); //Assunto
$mpdf->SetTitle('Titulo do PDF'); //Titulo
$mpdf->SetKeywords('palavras, chave, aqui'); //Palavras chave
$mpdf->SetCreator('Han Solo'); //Criador

/* A proteção para o PDF é opcional */
/*$mpdf->SetProtection(array('copy','print'), '', '#minhasenha'); // Permite apenas copiar e imprimir*/


/*Inserir no BD*/
//session_start();


$identificacao = $_SESSION['identificacao'];
$caminholaudo = 'geradorpdf/pdf/'. $identificacao .'.pdf';
$result = $link->query("SELECT `caminholaudo` FROM `laudo` WHERE `caminholaudo`='{$caminholaudo}'")
       		 or trigger_error($link->error);
				$verificar = $result->fetch_array(MYSQL_BOTH);
if($verificar = null){
	mysqli_query($link,"INSERT INTO `laudo` (`idlaudo`, `pdf`, `caminholaudo`) VALUES (NULL, '{$identificacao}', '{$caminholaudo}')") or  trigger_error($link->error) ;
}else {mysqli_query($link,"DELETE FROM `laudo` WHERE `laudo`.`pdf` = '{$identificacao}'") or  trigger_error($link->error) ;
		unlink('geradorpdf/pdf/'. $identificacao .'.pdf');
		mysqli_query($link,"INSERT INTO `laudo` (`idlaudo`, `pdf`, `caminholaudo`) VALUES (NULL, '{$identificacao}', '{$caminholaudo}')") or  trigger_error($link->error) ;}










/* Geração do PDF */
$mpdf->WriteHTML($html,0); // Carrega o conteudo do HTML criado;

$mpdf->Output('geradorpdf/pdf/'. $identificacao .'.pdf','F'); // Cria PDF usando 'D' para forçar o download;
unlink($filename); // Apaga o HTML
ob_clean(); // Descarta o buffer;
$laudo = null;
echo '<!DOCTYPE html>
						<html>
						<head>
						<title></title>
						<script>
						  			window.onload = function () {					            

						            window.alert("Laudo salvo com sucesso!");
						            window.close();
						            };
						</script>
						</head>
						<body>
						</body>
						</html>';
exit();
?>

