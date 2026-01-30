<?php
include_once("bdsd.php");
$idn = $_POST["idn"];

if($idn == 1){
  $win = urlencode(base64_encode("pendente"));
  $data = urlencode(base64_encode(date("Y/m/d")));
  $tot = urlencode(base64_encode("0"));
  $stmtips = $cnx->prepare("SELECT * FROM rdkz WHERE data != :data and win = :win LIMIT 100");
  $stmtips->execute([':data' => $data,':win' => $win]);
  $ipvs = $stmtips->fetchAll(PDO::FETCH_ASSOC);
  foreach($ipvs as $pai){
	$d = base64_decode(urldecode($pai["dia"]));
	$t = base64_decode(urldecode($pai["tot"]));
    $t += 1;
    $tt = urlencode(base64_encode($t));
    if ($t >= $d) {
      $w = urlencode(base64_encode("concluido"));
      $stmtips = $cnx->prepare("UPDATE rdkz SET tot = :tot, win = :win, data = :data WHERE id = :id LIMIT 1");
      $stmtips->execute([':id' => $pai["id"], ':tot' => $tt, ':win' => $w, ':data' => $data]);
    }else {
      $stmtips = $cnx->prepare("UPDATE rdkz SET tot = :tot, data = :data WHERE id = :id LIMIT 1");
      $stmtips->execute([':id' => $pai["id"], ':tot' => $tt, ':data' => $data]);
    }
  }
  //saque painel
  $stmtip = $cnx->prepare("SELECT * FROM rdkz WHERE win = :win and tot = :tot and data = :data LIMIT 10");
  $stmtip->execute([':win' => $win, ':tot' => $tot, ':data' => $data]);
  $totp = $stmtip->rowCount();
  if($totp < 10){
    $vip = 0;
    $dia = $vip;
    $kz = rand(1000, 11000);
    $kzi = 0; $kzg = 0;
    $ator = urlencode(base64_encode("James Bomde Runner"));
    $kzi = $kz;
    $kzg = $kzi * 2;
    if($kzi >= 1000 && $kzi <= 2000){
      $dia = rand(1, 2);
      $vip = 1;
      $kzg = ($kzg / 2) + 200;
    }else if($kzi >= 2001 && $kzi <= 3000){
      $dia = rand(1, 3);
      $vip = 2;
      $kzg = ($kzg / 2) + 500;
    }else if($kzi >= 3001 && $kzi <= 4000){
      $dia = rand(2, 3);
      $vip = 3;
      $kzg = ($kzg / 2) + 800;
    }else if($kzi >= 4001 && $kzi <= 5000){
      $dia = rand(2, 4);
      $vip = 4;
      $kzg = ($kzg / 2) + 1100;
    }else if($kzi >= 5001 && $kzi <= 6000){
      $dia = rand(3, 4);
      $vip = 5;
      $kzg = ($kzg / 2) + 1400;
    }else if($kzi >= 6001 && $kzi <= 7000){
      $dia = rand(3, 5);
      $vip = 6;
      $kzg = ($kzg / 2) + 1700;
    }else if($kzi >= 7001 && $kzi <= 8000){
      $dia = rand(4, 5);
      $vip = 7;
      $kzg = ($kzg / 2) + 2000;
    }else if($kzi >= 8001 && $kzi <= 9000){
      $dia = rand(4, 6);
      $vip = 8;
      $kzg = ($kzg / 2) + 2300;
    }else if($kzi >= 9001 && $kzi <= 10000){
      $dia = rand(5, 7);
      $vip = 9;
      $kzg = ($kzg / 2) + 2600;
    }else if($kzi >= 10001 && $kzi <= 11000){
      $dia = rand(5, 8);
      $vip = 10;
      $kzg = ($kzg / 2) + 2900;
    }
    $vip = urlencode(base64_encode($vip));
    $kzi = urlencode(base64_encode($kzi));
    $kzg = urlencode(base64_encode($kzg));
    $tot = urlencode(base64_encode("0"));
    $win = urlencode(base64_encode("pendente"));
    $dia = urlencode(base64_encode($dia));
    //salvar os dados
    $stmtip = $cnx->prepare("INSERT INTO rdkz(id,usu,dia,kzp,kzg,tot,dsc,win,data) VALUES(null,:usu,:dia,:kzp,:kzg,:tot,:dsc,:win,:data)");
    $stmtip->execute([':usu' => $vip,':dia' => $dia,':kzp' => $kzi,':kzg' => $kzg,':tot' => $tot,':dsc' => $ator,':win' => $win,':data' => $data]);
  }
}else if($idn == 2){
  //saque painel
}

$dados[] = ["id" => 1];
echo json_encode($dados, JSON_PRETTY_PRINT);
?>
