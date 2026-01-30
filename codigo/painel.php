<?php
include_once("bdsd.php");
$ip = $_POST["ip"];
$ir = $_POST["ir"];
$id = $_POST["id"];
$codigo = "";
$ttl = "";
$bda = $cnx->prepare("SELECT id,nm,py,dm FROM uskz WHERE id = :id LIMIT 1");
$bda->execute([":id" => $id]);
$vkz = $bda->fetch(PDO::FETCH_ASSOC);
$nme = isset($vkz["id"]) ? base64_decode(urldecode($vkz["nm"])) : "Indisponivél...";
$pye = isset($vkz["id"]) ? base64_decode(urldecode($vkz["py"])) : "Indisponivél...";
$kz = isset($vkz["id"]) ? number_format(intval(base64_decode(urldecode($vkz["dm"]))), 0, ',', '.') : "0";

if($ip == 1){
  //informação de investimento
  $ttl = "Informação SDX";
  $codigo = "
  <div class='flex lg'>
  	<i class='cverde'>Sistema Dinamico X</i>
    <i class='cverde'>&copy;2026</i>
  </div>
  ";
}else if($ip == 2){
  //informação de investimento
  $ttl = "Permição de acesso";
  $codigo = "
  <div class='flex lg'>
  	<i class='cverde'>Use o PayPay AO </i>
    <i class='cverde'>e vincule-a sua conta SDX</i>
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
  $codigo = "
  <i class='cverde fas fa-credit-card'></i>
  <i class='cazul'> $pye</i><br>
  <i class='cazul fas fa-user'></i>
  <i class='cazul'> $nme</i><br>
  <div class='flex'>
    <input type='number' placeholder='informe o valor ...' class='lg cverde'>
    <i class='lg radiu fas fa-check cazul'></i>
  </div>
  ";
}else if($ip == 5){
  //deposito painel
  $ttl = "Efetuar deposito";
  $codigo = "
  <i class='cverde fas fa-credit-card'></i>
  <i class='cazul'> AO06 0420 0000 0000 0321 4846 5</i><br>
  <i class='cazul fas fa-user'></i>
  <i class='cazul'> James Bonde Runner</i><br>
  <div class='flex'>
    <input type='number' placeholder='informe o valor ...' class='lg cverde'>
    <input type='datetime-local'  class='lg cverde'>
    <i class='lg radiu fas fa-check cazul'></i>
  </div>
  ";
}else if($ip == 9){
  //sistema de entrar
  $ttl = "Modo de conexão";
  $codigo = "
  <div class='flex lg'>
  	<i onclick='sistema(12,0)' class='cazul'>Entrar</i>
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
  $kzg = base64_decode(urldecode($pdt["kzg"]));
  $dt = base64_decode(urldecode($pdt["data"]));

  $ttl = "Informação do evento";
  $codigo = "
  <div class='flex lg'>
  	<i class='cpreto'>Requer até vip $vip e $kzp kz</i>
    <i class='cpreto'>id: $ir</i>
  </div>
  ";
}else if($ip == 11){
  //confirmação de investimento
  $ttl = "Confirmar investimento";
  $codigo = "
  <div class='flex lg'>
  	<i class='cverde'>Tens a certeza deste ?</i>
    <i class='cverde'>SIM</i>
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
