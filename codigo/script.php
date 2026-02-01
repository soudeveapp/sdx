<?php
include_once("bdsd.php");
$idn = $_POST["idn"];

if($idn == 1){
  $win = urlencode(base64_encode("pendente"));
  $data = urlencode(base64_encode(date("Y/m/d")));
  $tot = urlencode(base64_encode("0"));
  //ppagar usuarios pelos eventos
  $ev = $cnx->prepare("SELECT * FROM evkz WHERE win = :win GROUP BY id");
  $ev->execute([':win' => $win]);
  $vev = $ev->fetchAll(PDO::FETCH_ASSOC);
  //unlink("debug_log.txt");
  foreach($vev as $v){
   $idi = base64_decode(urldecode($v["idi"]));
   $idu = base64_decode(urldecode($v["idu"]));
   $rd = $cnx->prepare("SELECT * FROM rdkz WHERE id = :id LIMIT 1");
   $rd->execute([':id' => $idi]);
   $vrd = $rd->fetch(PDO::FETCH_ASSOC);
   $us = $cnx->prepare("SELECT * FROM uskz WHERE id = :id LIMIT 1");
   $us->execute([':id' => $idu]);
   $vus = $us->fetch(PDO::FETCH_ASSOC);
   $d = base64_decode(urldecode($vrd["dia"]));
   $t = base64_decode(urldecode($vrd["tot"]));
   $w = urlencode(base64_encode("concluido"));
   $evs = $cnx->prepare("SELECT * FROM evkz WHERE id = :id LIMIT 1");
   $evs->execute([':id' => $v["id"]]);
   $vevs = $evs->fetch(PDO::FETCH_ASSOC);
   if($data == $vrd["data"]){
     if($win == $vevs["win"] && $t == $d && $idi == $vrd["id"] && $vus["id"] == $idu){
       $dm = intval(base64_decode(urldecode($vus["dm"])));
       $kz = intval(base64_decode(urldecode($v["kzg"])));
       $vlr = $dm + $kz;
       $vlr = urlencode(base64_encode($vlr));
       //atualizar dadps
       $rd = $cnx->prepare("UPDATE rdkz SET win = :win WHERE id = :id");
       $rd->execute([':win' => $w, ':id' => $vrd["id"]]);
       $ev = $cnx->prepare("UPDATE evkz SET win = :win WHERE id = :id");
       $ev->execute([':win' => $w, ':id' => $vevs["id"]]);
       $us = $cnx->prepare("UPDATE uskz SET dm = :dm WHERE id = :id");
       $us->execute([':dm' => $vlr, ':id' => $vus["id"]]);
       //$file = 'debug_log.txt';
       //$dtu = "$vevs[win] d: $d - $dm - t: $t -kz: $kz pg...\n";
       //file_put_contents($file, $dtu, FILE_APPEND | LOCK_EX);
     }
   }else{
     if($t < $d){
       $t += 1;
       $tt = urlencode(base64_encode($t));
       $stmtips = $cnx->prepare("UPDATE rdkz SET tot = :tot, data = :data WHERE id = :id LIMIT 1");
       $stmtips->execute([':id' => $idi, ':tot' => $tt, ':data' => $data]);
     }
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
