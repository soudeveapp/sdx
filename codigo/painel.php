
<?php
include_once("bdsd.php");
$ip = $_POST["ip"];
$ir = $_POST["ir"];
$id = $_POST["id"];
$codigo = "";
$ttl = "";
$bda = $cnx->prepare("SELECT id,nm,py,dm,gh FROM uskz WHERE id = :id LIMIT 1");
$bda->execute([":id" => $id]);
$vkz = $bda->fetch(PDO::FETCH_ASSOC);
$nme = isset($vkz["id"]) ? base64_decode(urldecode($vkz["nm"])) : "Indisponivél...";
$vips = isset($vkz["id"]) ? base64_decode(urldecode($vkz["gh"])) : 0;
$pye = isset($vkz["id"]) ? base64_decode(urldecode($vkz["py"])) : "Indisponivél...";
$kz = isset($vkz["id"]) ? number_format(intval(base64_decode(urldecode($vkz["dm"]))), 0, ',', '.') : 0;
$ckz = isset($vkz["id"]) ? intval(base64_decode(urldecode($vkz["dm"]))) : 0;

if($ip == 1){
  //informação de investimento
  $ttl = "Informação SDX";
  $dtv = date("Y");
  $codigo = "
  <div class='flex lg'>
  	<i class='cpreto'>System Developer xtream</i>
    <i class='cpreto'>&copy;$dtv</i>
  </div>
  ";
}else if($ip == 2){
  //informação de investimento
  $ttl = "Permição de acesso";
  $codigo = "
  <div class='flex lg'>
  	<i class='cpreto'>PayPay AO </i>
    <i class='cverde'>Sistema integrado com SDX</i>
  </div>
  ";
}else if($ip == 3){
  //saque painel
  $ttl = "Meu dinheiro";
  $codigo = "
  <div class='flex lg'>
  	<i class='cpreto'>Você possui</i>
    <i class='cverde'>$kz <i class='cpreto'>Kz</i></i>
  </div>
  ";
}else if($ip == 4){
  //saque painel
  $ttl = "Efetuar saque";
  if($vips <= 0){
    $codigo = "
      <div class='flex lg'>
	    <span class='cpreto'>Requer vip 1 ou +</span>
		<span class='cverde'>activo</span>
	  </div>
    ";
  }else{
    $codigo = "
      <i class='cverde fas fa-credit-card'></i>
      <i class='cazul'> $pye</i><br>
      <i class='cazul fas fa-user'></i>
      <i class='cazul'> $nme</i><br>
      <div class='flex'>
        <input type='number' placeholder='informe o valor ...' class='lvt lg cverde'>
        <i onclick='sqdp(3)'class='lg radiu fas fa-check azul cbranco'></i>
      </div>
    ";
  }
}else if($ip == 5){
  //deposito painel
  $ttl = "Efetuar deposito";
  if($vips <= 0){
    $codigo = "
      <div class='flex lg'>
	    <span class='cpreto'>Requer vip 1 ou +</span>
		<span class='cverde'>activo</span>
	  </div>
    ";
  }else{
	$codigo = "
	  <i class='cverde fas fa-credit-card'></i>
	  <i class='cazul'> AO06 0420 0000 0000 0321 4846 5</i><br>
	  <i class='cazul fas fa-user'></i>
	  <i class='cazul'> James Bonde Runner</i><br>
	  <div class='flex'>
	    <input type='number' placeholder='informe o valor ...' class='dpst lg cverde'>
	    <input type='datetime-local'  class='datam lg cverde'>
	    <i onclick='sqdp(4)' class='lg radiu fas fa-check azul cbranco'></i>
	  </div>
	  ";
	}
}else if($ip == 6){
  //confirmação de eventos
  $ttl = "Atualizando VIP";
  if($id <= 0){
    $codigo = "
      <div class='flex lg'>
	    <span class='cpreto'>Requer conta activa</span>
		<span class='cverde'>ups</span>
	  </div>
    ";
  }else{
    $vip = $vips + 1;
    $codigo = "
      <div class='flex lg branco'>
        <span class='cpreto'>VIP: $vips</span>
		<span class='cverde'>ACTIVO</span>
	  </div>
	";
	if($vip <= 10) {
      $bdv = $cnx->prepare("SELECT * FROM spkz WHERE id = :id LIMIT 1");
      $bdv->execute([":id" => $vip]);
      $vcp = $bdv->fetch(PDO::FETCH_ASSOC);
      $kzv = base64_decode(urldecode($vcp["pcv"]));
      $kzvv = number_format(intval(base64_decode(urldecode($vcp["pcv"]))), 0, ',', '.');

	  if($ir >= 1 && $ir <= 10 && ($ckz - $kzv) >= 0){
		$dm = urlencode(base64_encode($ckz - $kzv));
		$gh = urlencode(base64_encode($vip));
        $bdv = $cnx->prepare("UPDATE uskz SET dm = :dm, gh = :gh WHERE id = :id");
        $bdv->execute([":dm" => $dm, ":gh" => $gh, ":id" => $id]);
	  }
	  $codigo .= "<br>
	    <div class='flex lg branco'>
	      <span class='cpreto'>VIP: $vip por  $kzvv Kz</span>
		  <span class='cazul' onclick='sistema(6,$vip)'>ACTIVAR</span>
	    </div>
	  ";
	}
  }
}else if($ip == 7){
  //confirmação de eventos
  $uid = urlencode(base64_encode($id));
  $bda = $cnx->prepare("SELECT * FROM evkz WHERE idu = :idu ORDER BY id desc LIMIT 5");
  $bda->execute([":idu" => $uid]);
  $pdt = $bda->fetchAll(PDO::FETCH_ASSOC);
  $tp = $bda->rowCount();
  if($tp <= 0){
    $ttl = "eventos investidos";
    $codigo = "
      <div class='flex lg'>
	    <span class='cpreto'>Nenhum evento activo</span>
		<span class='cverde'>ups</span>
	  </div>
    ";
  }else{
    $ttl = "$tp dos eventos investidos";
    foreach($pdt as $ev){
      $idi = base64_decode(urldecode($ev["idi"]));
      $win = base64_decode(urldecode($ev["win"]));
      $dat = base64_decode(urldecode($ev["dat"]));
      $kzp = base64_decode(urldecode($ev["kzi"]));
      $kzg = base64_decode(urldecode($ev["kzg"]));
      $kzp = number_format(intval($kzp), 0, ',', '.');
	  $kzg = number_format(intval($kzg), 0, ',', '.');
	  $bdb = $cnx->prepare("SELECT * FROM rdkz WHERE id = :id LIMIT 1");
      $bdb->execute([":id" => $idi]);
      $vev = $bdb->fetch(PDO::FETCH_ASSOC);
      $dia = base64_decode(urldecode($vev["dia"]));
      $totr = base64_decode(urldecode($vev["tot"]));

      $codigo .= "<br>
		  <div class='flex lg branco'>
		    <span class='cpreto'>investiu: <i class='cverde'>$kzp</i> kz</span>
		    <span class='cpreto'><i class='cverde'>$win</i> -> <i class='cverde'>$totr/$dia</i></span>
		  </div>
		  <div class='flex lg branco'>
		    <span class='cpreto'>retorno: <i class='cverde'>$kzg</i> Kz</span>
		    <span class='cverde'>$dat</span>
		  </div>
	  ";
    }
  }
}else if($ip == 8){
  //confirmação de eventos
  $uid = urlencode(base64_encode($id));
  $bda = $cnx->prepare("SELECT * FROM sqdp WHERE idu = :idu ORDER BY id desc LIMIT 5");
  $bda->execute([":idu" => $uid]);
  $pdt = $bda->fetchAll(PDO::FETCH_ASSOC);
  $tp = $bda->rowCount();
  if($tp <= 0){
    $ttl = "historicos de movimentos";
    $codigo = "
      <div class='flex lg'>
	    <span class='cpreto'>Nenhum movimento registrado</span>
		<span class='cverde'>ups</span>
	  </div>
    ";
  }else{
    $ttl = "$tp dos movimentos registrrado";
    foreach($pdt as $ev){
      $idu = base64_decode(urldecode($ev["idu"]));
      $vlr = base64_decode(urldecode($ev["vlr"]));
      $vlr = number_format(intval($vlr), 0, ',', '.');
	  $std = base64_decode(urldecode($ev["std"]));
      $tps = base64_decode(urldecode($ev["tps"]));
      $dta = base64_decode(urldecode($ev["dta"]));
      $codigo .= "<br>
	    <div class='flex lg branco'>
		  <span class='cpreto'>Operação: <i class='cverde'>$tps</i></span>
		  <span class='cpreto'>Estado: <i class='cverde'>$std</i></span>
		</div>
		<div class='flex lg branco'>
		  <span class='cpreto'>Fundo: <i class='cverde'>$vlr</i> Kz</span>
		  <span class='cescuro'>$dta</span>
		</div>
	  ";
    }
  }
}else if($ip == 9){
  //sistema de entrar
  $ttl = "Modo de conexão";
  $sdx = "";
  if($id){
    $sdx = "<i onclick='sistema(15,$id)' class='cclaro'> - </i>";
  }
  $codigo = "
  <div class='flex lg'>
  	<i onclick='sistema(12,0)' class='cazul'>Entrar</i>
  	$sdx
    <i onclick='sistema(14,0)'class='cazul'>Registrar</i>
  </div>
  ";
}else if($ip == 10){
  //informação de investimento
  $bdb = $cnx->prepare("SELECT * FROM rdkz WHERE id = :id LIMIT 1");
  $bdb->execute([":id" => $ir]);
  $pdt = $bdb->fetch(PDO::FETCH_ASSOC);
  $dia = base64_decode(urldecode($pdt["dia"]));
  $tot = base64_decode(urldecode($pdt["tot"]));
  $ator = base64_decode(urldecode($pdt["dsc"]));
  $vip = base64_decode(urldecode($pdt["usu"]));
  $kzp = base64_decode(urldecode($pdt["kzp"]));
  $kzpp = number_format(intval($kzp), 0, ',', '.');
  $kzg = base64_decode(urldecode($pdt["kzg"]));
  $kzgg = number_format(intval($kzg), 0, ',', '.');
  $dt = base64_decode(urldecode($pdt["data"]));
  $ttl = "Informação do evento";
  $codigo = "
  <div class='flex lg'>
  	<i class='cpreto'>Requer até vip $vip e $kzpp kz</i>
    <i class='cpreto'>id: $ir</i>
  </div>
  <div class='flex lg'>
  	<i class='cpreto'>Retorno se investir</i>
    <i class='cpreto'>$kzgg Kz</i>
  </div>
  ";
}else if($ip == 11){
  //confirmação de investimento
  $bdb = $cnx->prepare("SELECT * FROM rdkz WHERE id = :id LIMIT 1");
  $bdb->execute([":id" => $ir]);
  $pdt = $bdb->fetch(PDO::FETCH_ASSOC);
  $dia = base64_decode(urldecode($pdt["dia"]));
  $tot = base64_decode(urldecode($pdt["tot"]));
  $ator = base64_decode(urldecode($pdt["dsc"]));
  $vip = base64_decode(urldecode($pdt["usu"]));
  $kzp = base64_decode(urldecode($pdt["kzp"]));
  $kzpp = number_format(intval($kzp), 0, ',', '.');
  $kzg = base64_decode(urldecode($pdt["kzg"]));
  $kzgg = number_format(intval($kzg), 0, ',', '.');
  $dt = base64_decode(urldecode($pdt["data"]));
  $logr = "";
  $ttl = "Investir em evento";
  if ($ckz < $kzp || $id <= 0 || $vips < $vip) {
    $logr = "
    <i class='cverde fas fa-remove'></i>
    <b class='cvermelho'>Erro ao investir no evento</b><br>";
  }else if($id >= 1 && $vips >= $vip && ($ckz - $kzp) >= 0){
    $uid = urlencode(base64_encode($id));
    $uidp = urlencode(base64_encode($ir));
    $udt = urlencode(base64_encode(date("d/m/Y")));
    $ukzp = urlencode(base64_encode($kzp));
    $ukzg = urlencode(base64_encode($kzg));
    $ckz = $ckz - $kzp;
    $ckz = urlencode(base64_encode($ckz));
    $uwin = urlencode(base64_encode("pendente"));
    $bdb = $cnx->prepare("INSERT INTO evkz(id,idi,idu,kzi,kzg,win,dat) VALUES (null,:idi,:idu,:kzi,:kzg,:win,:dat)");
    $cf = $bdb->execute([":idi" => $uidp,":idu" => $uid,":kzi" => $ukzp,":kzg" => $ukzg,":win" => $uwin,":dat" => $udt]);
    $bdc = $cnx->prepare("UPDATE uskz SET dm = :dm WHERE id = :id");
    $cfc = $bdc->execute([":dm" => $ckz,":id" => $id]);
    if($cf && $cfc){
      $logr = "<i class='cverde fas fa-check'></i> <b class='cverde'>Investiu com sucesso</b><br>";
    }else{
      $logr = "<i class='cverde fas fa-remove'></i> <b class='cvermelho'>Erro ao investir no evento</b><br>";
    }
  }
  $codigo = "
  $logr
  <div class='flex lg'>
    <span class='cpreto'>investindo</span>
    <span class='cpreto'>$kzpp Kz</span>
  </div>
  <div class='flex lg'>
    <span class='cpreto'>retorno agendado</span>
    <span class='cpreto'>$kzgg Kz</span>
  </div>
  <div class='flex lg'>
    <span class='cpreto'>dias de espera</span>
    <span class='cpreto'>$dia dias</span>
  </div>
  <div class='flex lg'>
    <span class='cpreto'>identificação</span>
    <span class='cverde'>id: $ir</span>
  </div>
  ";
}else if($ip == 12){
  //deposito painel
  $logr = "
  <i class='cverde fas fa-exclamation-circle'></i>
  confirme seu iban<br>";
  $ttl = "Iniciar sessão";
  if ($ir == 1) {
    $logr = "
    <i class='cverde fas fa-remove'></i>
    Erro no IBAN de acesso<br>";
  }else if($ir == 2){
    $logr = "
    <i class='cverde fas fa-check'></i>
    <b class='cverde'>Usuario entrou com sucesso</b><br>";
  }
  $codigo = "
  $logr
  <div class='flex'>
    <input type='txt' placeholder='seu iban paypay' class='ibnacss lg cverde'>
    <i onclick='entrar()' class='cs entrar lg radiu fas azul fa-check cbranco'></i>
  </div>
  ";
}else if($ip == 14){
  //deposito painel
  $logr = "
  <i class='cverde fas fa-exclamation-circle'></i>
  vincule-se com o paypay<br>";
  $ttl = "Criar conta";
  if ($ir == 1) {
    $logr = "
    <i class='cverde fas fa-remove'></i>
    Erro nos dados de acesso<br>";
  }else if($ir == 2){
    $logr = "
    <i class='cverde fas fa-check'></i>
    <b class='cverde'>Usuario entrou com sucesso</b><br>";
  }
  $codigo = "
  $logr
  <div class='flex'>
    <input type='text' placeholder='seu nome paypay' class='usuacs lg cverde'>
    <input type='text' placeholder='seu iban paypay' class='ibnacs lg cverde'>
    <i onclick='registrar()' class='cs registro lg radiu azul fas fa-check cbranco'></i>
  </div>
  ";
}else if($ip == 15){
  //informação de investimento
  $ttl = "Painel adm &nbsp;
    <i onclick='sistema(15,2)' class='fas fa-user'></i>&nbsp;&nbsp;
    <i onclick='sistema(15,3)' class='fas fa-wallet'></i>&nbsp;&nbsp;
    <i onclick='sistema(15,4)' class='fas fa-credit-card'></i>
  ";
  if($ir == 2){
    $codigo = "
      <div class='flex lg'>
  	    <i class='cpreto'>Total de usuarios:</i>
        <i class='cazul'>1947</i>
      </div>
    ";
  }else if($ir == 3){
    $codigo = "
      <div class='flex lg'>
  	    <i class='cpreto'>Depositos feitos:</i>
        <i class='cazul'>9084</i>
      </div>
    ";
  }else if($ir == 4){
    $codigo = "
      <div class='flex lg'>
  	    <i class='cpreto'>Saques feitos:</i>
        <i class='cazul'>30488</i>
      </div>
    ";
  }else if($ir == 1){
    $codigo = "
      <div class='flex lg'>
  	    <i class='cpreto'>Bem vindo senhor!</i>
        <i class='cazul'>terminal</i>
      </div>
    ";
  }
}

//campo executalvel do painel
$sms = "
   <div class='claro cpa'>
     <div class='flex radiu verde cbranco'>
        <span>
           <i class='cbranco fas fa-exclamation-circle'></i> $ttl
        </span>
        <span onclick='sistema(0,0)' class='cbranco'>
           <i class='cbranco rd fas fa-remove'></i>
        </span>
    </div>
    $codigo
  </div>
";
$dados[] = ["id" => 1, "sms" => "$sms"];
echo json_encode($dados, JSON_PRETTY_PRINT);

?>
