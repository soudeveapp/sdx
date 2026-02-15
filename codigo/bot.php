<?php
include_once("bdsd.php");
$idn = $_POST["idn"];
$idu = $_POST["id"];
$id = 0;
$dt = date("d/m/Y h:i");
if($idn == 1){
  //painel login
  $ibn = trim(htmlspecialchars(strip_tags(filter_input(INPUT_POST, "ibnacss", FILTER_SANITIZE_SPECIAL_CHARS))));
  $ibnv = str_replace(" ","",$ibn);
  if(strlen($ibn) >= 25 && strlen($ibnv) <= 26){
    $ibn = urlencode(base64_encode($ibn));
    $ibnv = urlencode(base64_encode($ibnv));
    $pegaras = $cnx->prepare("SELECT id, py FROM uskz WHERE py = :py LIMIT 1");
    $pegaras->execute([':py' => $ibnv]);
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
    $ibnv = urlencode(base64_encode($ibnv));
    $nme = urlencode(base64_encode($nme));
	//checar iban se ja existe
    $pegara = $cnx->prepare("SELECT py FROM uskz WHERE py = :py LIMIT 2");
    $pegara->execute([':py' => $ibnv]);
    $totvn = $pegara->rowCount();
	//registrar caso não existir
	$ibnv = base64_decode(urldecode($ibnv));
    if ($totvn == 0 && preg_match("/^[a-zA-Z]+[0-9]+$/", $ibnv)) {
      $zer = urlencode(base64_encode("101"));
      $vip = urlencode(base64_encode("0"));
      $dt = urlencode(base64_encode($dt));
      $ibnv = urlencode(base64_encode($ibnv));
      $stmtip = $cnx->prepare("INSERT INTO uskz(id,nm,py,dm,gh,dt) VALUES (null,:nm,:py,:dm,:gh,:dt)");
      $stmtip->execute([':nm' => $nme,':py' => $ibnv,':dm' => $zer,':gh' => $vip,':dt' => $dt]);
      //Iniciar sessão
      $pegaras = $cnx->prepare("SELECT id, py FROM uskz WHERE py = :py LIMIT 1");
      $pegaras->execute([':py' => $ibnv]);
      $vid = $pegaras->fetch(PDO::FETCH_ASSOC);
      $id = $vid["id"];
    }
  }
}else if($idn == 3){
  //saque
  $vlr = trim(htmlspecialchars(strip_tags(filter_input(INPUT_POST, "kzr", FILTER_SANITIZE_SPECIAL_CHARS))));
  $dtm = str_replace("/", "-", $dt);
  $dtm = date("d-m-Y H:i", strtotime($dtm));
  $dtm = urlencode(base64_encode($dtm));
  $std = urlencode(base64_encode("pendente"));
  $tps = urlencode(base64_encode("saque"));
  $iduu = $idu;
  $pegaras = $cnx->prepare("SELECT id, py, dm FROM uskz WHERE id = :id LIMIT 1");
  $pegaras->execute([':id' => $iduu]);
  $vid = $pegaras->fetch(PDO::FETCH_ASSOC);
  $idu = urlencode(base64_encode($idu));
  $sq = intval(base64_decode(urldecode($vid["dm"])));
  $vlr = intval($vlr);
  $sq = $sq - $vlr;
  if($vlr >= 100 && $vlr <= 50000 && $sq >= 0){
    $sq = urlencode(base64_encode($sq));
    $atus = $cnx->prepare("UPDATE uskz SET dm = :dm WHERE id = :id LIMIT 1");
    $catus = $atus->execute([":dm" => $sq ,":id" => $iduu]);
    if($catus){
      $vlr = urlencode(base64_encode($vlr));
      $stmtip = $cnx->prepare("INSERT INTO sqdp(id,idu,vlr,std,tps,dta) VALUES (null,:idu,:vlr,:std,:tps,:dta)");
      $stmtip->execute([':idu' => $idu,':vlr' => $vlr,':std' => $std,':tps' => $tps,':dta' => $dtm]);
      $id = $iduu;
    }
  }
}else if($idn == 4){
  //deposito
  $vlr = trim(htmlspecialchars(strip_tags(filter_input(INPUT_POST, "kzr", FILTER_SANITIZE_SPECIAL_CHARS))));
  $dtm = trim(htmlspecialchars(strip_tags(filter_input(INPUT_POST, "dtm", FILTER_SANITIZE_SPECIAL_CHARS))));
  $dtm = str_replace("T", " ", $dtm);
  $dtm = str_replace("/", "-", $dtm);
  $dtm = date("d-m-Y H:i", strtotime($dtm));
  $dtm = urlencode(base64_encode($dtm));
  $std = urlencode(base64_encode("pendente"));
  $tps = urlencode(base64_encode("deposito"));
  $iduu = $idu;
  $idu = urlencode(base64_encode($idu));
  $vlr = intval($vlr);
  if($vlr >= 1000 && $vlr <= 50000){
    $vlr = urlencode(base64_encode($vlr));
    $stmtip = $cnx->prepare("INSERT INTO sqdp(id,idu,vlr,std,tps,dta) VALUES (null,:idu,:vlr,:std,:tps,:dta)");
    $stmtip->execute([':idu' => $idu,':vlr' => $vlr,':std' => $std,':tps' => $tps,':dta' => $dtm]);
    $id = $iduu;
  }
}

$dados[] = ["id" => 1, "rt" => $id];
echo json_encode($dados, JSON_PRETTY_PRINT);
?>
