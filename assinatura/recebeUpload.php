<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload de arquivos</title>
</head>

<body>
<?php

 $link = @mysqli_connect("localhost","root","","pacsdb") or die(mysqli_connect_error()); 
// verifica se foi enviado um arquivo 



if(isset($_FILES['arquivo']['name']) && $_FILES["arquivo"]["error"] == 0)
{

	echo "Você enviou o arquivo: <strong>" . $_FILES['arquivo']['name'] . "</strong><br />";
	echo "Este arquivo é do tipo: <strong>" . $_FILES['arquivo']['type'] . "</strong><br />";
	echo "Temporáriamente foi salvo em: <strong>" . $_FILES['arquivo']['tmp_name'] . "</strong><br />";
	echo "Seu tamanho é: <strong>" . $_FILES['arquivo']['size'] . "</strong> Bytes<br /><br />";

	$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
	$nome = $_FILES['arquivo']['name'];
	

	// Pega a extensao
	$extensao = strrchr($nome, '.');

	// Converte a extensao para mimusculo
	$extensao = strtolower($extensao);

	// Somente imagens, .jpg;.jpeg;.gif;.png
	// Aqui eu enfilero as extesões permitidas e separo por ';'
	// Isso server apenas para eu poder pesquisar dentro desta String
	if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
	{
		$crm = $_POST["crm"];
		$medico = $_POST["medico"];
		
		// Cria um nome único para esta imagem
		// Evita que duplique as imagens no servidor.
		
		$novoNome = $crm . $extensao;
		
		// Concatena a pasta com o nome
		$destino = 'imagens/' . $novoNome; 

		mysqli_query($link,"INSERT INTO `assinatura` (`idAssinatura`, `CRM`, `caminho`,`medico`) VALUES (NULL, '{$crm}', '{$destino}','{$medico}')") or  trigger_error($link->error) ;
		

		$error= mysqli_error($link);

		if($error!=null){
		
		echo  "<script type='text/javascript' charset='utf-8'>";
		echo "alert('CRM JÁ EXISTENTE!')";
		echo "</script>";
		echo "<script>window.location = 'form.html';</script>";
		exit();

		}else ;


		// tenta mover o arquivo para o destino
		if( @move_uploaded_file( $arquivo_tmp, $destino  ))
		{
			echo "Arquivo salvo com sucesso em : <strong>" . $destino . "</strong><br />";
			echo "<img src=\"" . $destino . "\" />";
		}
		else
			echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
	}
	else
		echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
}
else
{
	echo "Você não enviou nenhum arquivo!";
}
?>
</body>
</html>