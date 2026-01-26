<?php
$fl = fopen("nerde.sd","r");
$conteudo = "";
$contar = 0;
while (!feof($fl))
{
	$conteudo .= fgets($fl);
	
	$contar += 1;
}
fclose($fl);
$dados[] = ["id" => 1, "dados" => "$conteudo"];
echo json_encode($dados, JSON_PRETTY_PRINT);
?>
