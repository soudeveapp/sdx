<?php
$ip = $_POST["ip"];
$codigo = "";
$ttl = "";

if($ip == 3){
  //saque painel
  $ttl = "Historico de lucros";
  $codigo = "
  <div class='flex lg'>
  	<i class='cverde'>saque</i>
    <i class='cverde'>65 78</i><br>
  </div>
  ";
}else if($ip == 4){
  //saque painel
  $ttl = "Efetuar saque";
  $codigo = "
  <i class='cverde fas fa-credit-card'></i>
  <i class='cazul'> ...</i><br>
  <i class='cazul fas fa-user'></i>
  <i class='cazul'> ...</i><br>
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
    <input type='time'  class='lg cverde'>
    <i class='lg radiu fas fa-check cazul'></i>
  </div>
  ";
}
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
