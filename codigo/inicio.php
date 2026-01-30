<?php
include_once("bdsd.php");
$rd = $_POST["cd"];
$id = $_POST["id"];
$bda = $cnx->prepare("SELECT id, dm FROM uskz WHERE id = :id LIMIT 1");
$bda->execute([":id" => $id]);
$vkz = $bda->fetch(PDO::FETCH_ASSOC);
$kz = isset($vkz["id"]) ? number_format(intval(base64_decode(urldecode($vkz["dm"]))), 0, ',', '.') : "0";

$head = "
<div class='rolcbc'>
  <div class='flex escuro div'>
	<span onclick='sistema(1,0)' class='heade cbranco'>
		<i class='logo fas fa-wallet'></i> SDX
	</span>
	<span onclick='sistema(2,0)' class='healdc cverde'> PayPay AO </span>
	<span class='headd cbranco' onclick='sistema(3,0)'>
        $kz <i class='logo fas fa-credit-card'></i>
    </span>
  </div>
  <div class='h1 escuro'></div>
</div>
";

$ctd = "
<div class='h1'></div><br>
<div class='h1'></div><br>
<div class='cp claro cazul'>
  <div class='png ct'>
    <i onclick='sistema(6,0)' class='cs tpnga cazul fas fa-medal'></i><br>VIP 0
  </div>
  <div class='txt cpreto'>
    <div class='flex div'>
      <span class='heade cverde'>
		<i class='logo cverde fas fa-credit-card'></i>
		AOA Levantamento:<br>
		<b class='p1 cescuro'>Permitido: 1.00 a 50.000 kz</b>
	    <br><hr>
	    <i class='logo cverde fas fa-wallet'></i>
		AOA Deposito:<br>
		<b class='p1 cescuro'>Permitido: 1.000 a 50.000 kz</b>
	  </span>
	  <span class='heade cazul'>
	    <i onclick='sistema(4,0)' class='rd cazul fas fa-upload'></i><br><br>
	    <i onclick='sistema(5,0)' class='rd cazul fas fa-download'></i>
	  </span>
    </div>
  </div>
</div>
";
$i = 0;
$data = urlencode(base64_encode(date("Y/m/d")));
$p = urlencode(base64_encode("pendente"));
$t = urlencode(base64_encode("0"));
$stmtip = $cnx->prepare("SELECT * FROM rdkz WHERE tot = :tot and win = :win and data = :data ORDER BY id DESC LIMIT 10");
$stmtip->execute([':tot' => $t,'win' => $p,':data' => $data]);
$ipv = $stmtip->fetchAll(PDO::FETCH_ASSOC);
$tot = $stmtip->rowCount();
foreach ($ipv as $pdt) {
  $dia = base64_decode(urldecode($pdt["dia"]));
  $tot = base64_decode(urldecode($pdt["tot"]));
  $ator = base64_decode(urldecode($pdt["dsc"]));
  $vip = base64_decode(urldecode($pdt["usu"]));
  $kzp = base64_decode(urldecode($pdt["kzp"]));
  $kzg = base64_decode(urldecode($pdt["kzg"]));
  $dt = base64_decode(urldecode($pdt["data"]));
  $i = $pdt["id"];
$ctd .= "
<div class='h1'></div><br>
<div class='cp radiu'>
  <div class='txt cpreto'>
    <div class='flex div'>
      <span class='lg cverde'>
		<i class='logo cazul fas fa-user-tie'></i>
		<i class='cverde lg'>$ator</i><br>
		<b class='p1 cescuro'>
		  <b class='cpreto al lg'>
		    <i class='cescuro fas fa-exclamation-circle'></i>
		    Vai levar <b class='cazul'>$dia Dias</b> para ganhar o valor
		  </b><br>
		  <b class='cpreto al lg'>
		    <i class='cescuro fas fa-calendar'></i>
		    Evento de <b class='cazul'>$dt</b> até <b class='cazul'>vip $vip</b> 
	 	  </b><br>
		  <b class='cpreto al lg'>
		    <i class='cescuro fas fa-wallet'></i>
		    requer $rd <b class='cazul'>$kzp Kz</b> para investir
		  </b><br>
		  <b class='cpreto al lg'>
		    <i class='cescuro fas fa-gift'></i>
		    Retorno do evento <b class='cazul'>$kzg Kz</b>
		  </b><br>
		</b><br>
	  </span>
    </div>
  </div>
  <div class='png ct cpreto'>
    <i class='tpnga cazul fas fa-gift'></i><br>
       <div class='lg flex radiu'>
		<span class='sp ct cazul'  onclick='sistema(10,$i)'>
			<i class='rd fas fa-question-circle cazul'></i>
		</span>
		<span class='sp ct cazul'  onclick='sistema(11,$i)'>
			<i class='rd fas fa-check cazul'></i>
		</span>
</div>

  </div>
</div>
";
}
$ctd .= "<div class='h1'></div><br><br>";

$foot = "
<div class='rolrdp'>
  <div class='flex escuro div'>
    <span onclick='sistema(7,0)' class='sp ct cbranco'>
			<i class='rd fas fa-gift cbranco'></i>
			<br>eventos
		</span>
		<span onclick='sistema(8,0)' class='sp ct cbranco'>
			<i class='rd fas fa-save cbranco'></i>
			<br>historico
		</span>
		<span onclick='sistema(9,0)' class='sp ct cbranco'>
			<i class='rd fas fa-power-off cbranco'></i>
			<br>entrar
		</span>
	</div>
</div>
<div class='h1 escuro'></div>
";

$dados[] = ["id" => 1, "head" => "$head", "ctds" => "$ctd", "foot" => "$foot"];
echo json_encode($dados, JSON_PRETTY_PRINT);
?>
