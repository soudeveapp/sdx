<?php
include_once("bdsd.php");
$idn = $_POST["idn"];
$id = 0;
$dt = date("d/m/Y h:i");
if($idn == 1){
  //painel login
  $ibn = trim(htmlspecialchars(strip_tags(filter_input(INPUT_POST, "ibnacss", FILTER_SANITIZE_SPECIAL_CHARS))));
  $ibnv = str_replace(" ","",$ibn);
  if(strlen($ibn) >= 25 && strlen($ibnv) <= 26){
    $ibn = urlencode(base64_encode($ibn));
    $pegaras = $cnx->prepare("SELECT id, py FROM uskz WHERE py = :py LIMIT 1");
    $pegaras->execute([':py' => $ibn]);
    $vid = $pegaras->fetch(PDO::FETCH_ASSOC);
    $id = $vid["id"];
  }
}else if($idn == 2){
  //painel registro
  $nme = trim(htmlspecialchars(strip_tags(filter_input(INPUT_POST, "usuacs", FILTER_SANITIZE_SPECIAL_CHARS))));
  $ibn = trim(htmlspecialchars(strip_tags(filter_input(INPUT_POST, "ibnacs", FILTER_SANITIZE_SPECIAL_CHARS))));
  $ibnv = str_replace(" ","",$ibn);
  if(strlen($nme) > 5 && strlen($ibn) >= 25 && strlen($ibnv) <= 26){
    $ibn = urlencode(base64_encode($ibn));
    $nme = urlencode(base64_encode($nme));
	//checar iban se ja existe
    $pegara = $cnx->prepare("SELECT py FROM uskz WHERE py = :py LIMIT 2");
    $pegara->execute([':py' => $ibn]);
    $totvn = $pegara->rowCount();
	//registrar caso não existir
    if ($totvn == 0 && preg_match("/^[a-zA-Z]+[0-9]+$/", $ibnv)) {
      $zer = urlencode(base64_encode("0"));
      $dt = urlencode(base64_encode($dt));
      $stmtip = $cnx->prepare("INSERT INTO uskz(id,nm,py,dm,gh,dt) VALUES (null,:nm,:py,:dm,:gh,:dt)");
      $stmtip->execute([':nm' => $nme,':py' => $ibn,':dm' => $zer,':gh' => $zer,':dt' => $dt]);
      //Iniciar sessão
      $pegaras = $cnx->prepare("SELECT id, py FROM uskz WHERE py = :py LIMIT 1");
      $pegaras->execute([':py' => $ibn]);
      $vid = $pegaras->fetch(PDO::FETCH_ASSOC);
      $id = $vid["id"];
    }
  }
}

$dados[] = ["id" => 1, "rt" => $id];
echo json_encode($dados, JSON_PRETTY_PRINT);
?>
