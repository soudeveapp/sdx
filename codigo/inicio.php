<?php
$rd = $_POST["cd"];
$head = "
<div class='rolcbc'>
  <div class='flex escuro div'>
	<span class='heade cbranco'>
		<i class='logo fas fa-wallet'></i> SDX
	</span>
	<span class='healdc cverde'> PayPay AO </span>
	<span class='headd cbranco' onclick='sistema(3,0)'>
        00.00 <i class='logo fas fa-credit-card'></i>
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
    <i class='tpnga cverde fas fa-medal'></i><br>VIP 1
  </div>
  <div class='txt cpreto'>
    <div class='flex div'>
      <span class='heade cverde'>
		<i class='logo cverde fas fa-credit-card'></i>
		AOA Levantamento:<br>
		<b class='p1 cescuro'>Permitido: 1.00 a 50.000 kz</b>
	    <br>
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
while($i < 8){
$i ++;
$ctd .= "
<div class='h1'></div><br>
<div class='cp radiu'>
  <div class='txt cpreto'>
    <div class='flex div'>
      <span class='lg cverde'>
		<i class='logo cazul fas fa-user-tie'></i>
		<i class='cverde lg'>James Bonde Runner</i><br>
		<b class='p1 cescuro'>
		  <b class='cpreto al lg'>
		    <i class='cescuro fas fa-calendar'></i>
		    <b class='cazul'>5 Dias</b> de renda recursiva
		  </b><br>
		  <b class='cpreto al lg'>
		    <i class='cescuro fas fa-calendar'></i>
		    Evento de <b class='cazul'>25/01/2026</b>
		  </b><br>
		  <b class='cpreto al lg'>
		    <i class='cescuro fas fa-gift'></i>
		    requer $rd <b class='cazul'>1.000kz</b> para investir
		  </b><br>
		  <b class='cpreto al lg'>
		    <i class='cescuro fas fa-calendar'></i>
		    Retorno do evento <b class='cazul'>2.750 kz</b>
		  </b><br>
		</b><br>
	  </span>
    </div>
  </div>
  <div class='png ct cpreto'>
    <i class='tpnga cazul fas fa-gift'></i><br>
       <div class='lg flex'>
		<span class='sp ct cazul'>
			<i class='rd fas fa-question-circle cazul'></i>
		</span>
		<span class='sp ct cazul'>
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
		<span class='sp ct cbranco'>
			<i class='rd fas fa-home cbranco'></i>
			<br>investir
		</span>
		<span class='sp ct cbranco'>
			<i class='rd fas fa-wallet cbranco'></i>
			<br>carteira
		</span>
		<span class='sp ct cbranco'>
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
