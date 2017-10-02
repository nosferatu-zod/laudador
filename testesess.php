<?php
//**************************************//
// Desenvolvido por: Diego Souza Machado//
// Email: dsmachado_36@hotmail.com	  //
//**************************************//
 $link = @mysqli_connect("localhost","root","","pacsdb") or die(mysqli_connect_error());

// error_reporting(E_ALL ^ E_NOTICE); // tira os "notice" que aparece - se quiser usar retire as barras do começo


$tabela = "study"; // altere aqui sua tabela do banco de dados

$limite = 3; // limite de registros por pagina
$pag = 0; // valor padrao se nao for enviado nenhum valor via metodo GET
$pag_atual = $_GET["pag_atual"]; // recebe o valor enviado pelo metodo GET
if (!$pag_atual) {	
	$pag_atual = $pag;
} else {
	$pag_atual = $pag_atual;
}
// sql que pega o resultado total de registro
$sql2 = mysqli_query($link,"SELECT * FROM $tabela") or die();
$resultado2 =  mysqli_num_rows($sql2);
// fim sql

// sql que pega o tatal que esta sendo exibido e repete os resultados
$sql = mysqli_query($link,"SELECT * FROM $tabela LIMIT $pag_atual, $limite") or die();
$resultado = (int) mysqli_num_rows($sql);

echo "foram encontrados $resultado resultados, de $resultado2<br />";
while ($linha = mysqli_fetch_array($sql)) {
$campo1 = $linha["study_desc"]; // campos que vao repetir na função while... copie, cole e renomeie para fazer outro
$campo2 = $linha["pk"];
echo "$campo1 - $campo2<br />";
}
// fim sql


// inicio paginação
//$res_int = (int) $resultado; 
$l_int =  (int) $limite;
echo $ultima = ceil($resultado/$limite); // define o valor da ultima pagina
$anterior = $pag_atual-$limite; // define o valor da pagina anterior a atual

if ($anterior < 0) { // se anterior for menor que 0, ele exibe apenas os nomes sem link
echo "Primeira - Anterior - ";
} else { // senao ele exibe os links
echo " <a href=testesess.php?pag_atual=0>Primeira - </a>";
echo " <a href=testesess.php?pag_atual=$anterior>Anterior - </a>";
}

$proxima = intval($pag_atual+$limite); // define o valor da proxima pagina
if ($proxima > $resultado2) { // não deixa o link passar do total de registros
echo "Proxima - Ultima";
} else {
echo " <a href=testesess.php?pag_atual=$proxima>Proxima - </a>";
echo " <a href=testesess.php?pag_atual=$ultima>Ultima</a>";
}
?>