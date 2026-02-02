const bd = document.getElementsByTagName("body");
const sms = document.getElementsByClassName("sms");
var id = 0;
var rd = 0;

/*** SouDeve - APP/API
* Desc: Softwere de automação de sistemas
* Projecto: SouDeve
* Author: Lopes Carlos
* Contacto: soudeve@gmail.com
**/

function Inicio() {
  var fd = new FormData();
  fd.append('id', id);
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'codigo/inicio.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var res = JSON.parse(xhr.responseText);
      var head = document.getElementsByClassName("cbc");
      var ctda = document.getElementsByClassName("ctd");
      var foot = document.getElementsByClassName("rdp");
      res.forEach(item => {
        head[0].innerHTML = item.head;
		ctda[0].innerHTML = item.ctds;
    	foot[0].innerHTML = item.foot;
      });
    }
  }
  xhr.send(fd);
}

function sistema(ip,ir){
    var ctda = document.getElementsByClassName("ctd");
    if(ip != 0){
    ctda[0].style.background = "rgba(100,100,100,0.8)";
    sms[0].style.display = "flex";
    var fd = new FormData();
    fd.append('id', id);
    fd.append('ip', ip);
    fd.append('ir', ir);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'codigo/painel.php', true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var res = JSON.parse(xhr.responseText);
        res.forEach(item => {
          Inicio();
          if(ip == 6 && ir >= 1){
            sistema(ip,0);
          }
          sms[0].innerHTML = item.sms;
        });
      }
    }
    xhr.send(fd);
  }else{
    sms[0].style.display = "none";
    ctda[0].style.background = "rgba(255,255,255,1)";
  }
}
function sqdp(ii){
  var kzr = 0;
  var dtm = 0;
  if(ii == 3){
    var lvt = document.getElementsByClassName("lvt")[0].value;
    kzr = lvt;
  }else if(ii == 4){
    var dpst = document.getElementsByClassName("dpst")[0].value;
    var datam = document.getElementsByClassName("datam")[0].value;
    kzr = dpst;
    dtm = datam;
  }
  var fd = new FormData();
  fd.append('id', id);
  fd.append('idn', ii);
  fd.append('kzr', kzr);
  fd.append('dtm', dtm);
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'codigo/bot.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var res = JSON.parse(xhr.responseText);
      res.forEach(item => {
        if(item.rt >= 1){
          Inicio();
          sistema(8,0);
		}else{
		  Inicio();
		}
	  });
    }
  }
  xhr.send(fd);
}

function admin(ii, cpf, idp){
  var cdg = document.getElementsByClassName("cdgadm")[0].value;
  var fd = new FormData();
  fd.append('id', id);
  fd.append('idn', ii);
  fd.append('cpf', cpf);
  fd.append('idp', idp);
  fd.append('cdg', cdg);
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'codigo/bot.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var res = JSON.parse(xhr.responseText);
      res.forEach(item => {
        if(item.rt >= 1){
          Inicio();
          sistema(15,1);
		}else{
		  Inicio();
		}
	  });
    }
  }
  xhr.send(fd);
}

function entrar() {
  var ibnacss = document.getElementsByClassName("ibnacss")[0].value;
  var fd = new FormData();
  fd.append('id', id);
  fd.append('idn', 1);
  fd.append('ibnacss', ibnacss);
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'codigo/bot.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var res = JSON.parse(xhr.responseText);
      res.forEach(item => {
        if(item.rt >= 1){
          id = item.rt;
          Inicio();
          sistema(12,2);
		}else{
		  id = 0;
		  Inicio();
		  sistema(12,1);
		}
	  });
    }
  }
  xhr.send(fd);
}
function registrar() {
  var usuacs = document.getElementsByClassName("usuacs")[0].value;
  var ibnacs = document.getElementsByClassName("ibnacs")[0].value;
  var fd = new FormData();
  fd.append('id', id);
  fd.append('idn', 2);
  fd.append('usuacs', usuacs);
  fd.append('ibnacs', ibnacs);
   var xhr = new XMLHttpRequest();
  xhr.open('POST', 'codigo/bot.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var res = JSON.parse(xhr.responseText);
      res.forEach(item => {
        if(item.rt >= 1){
          id = item.rt;
          Inicio();
          sistema(14,2);
		}else{
		  id = 0;
		  Inicio();
		  sistema(14,1);
		}
	  });
    }
  }
  xhr.send(fd);
}
function rodando() {
  var fd = new FormData();
  fd.append('id', id);
  fd.append('idn', 1);
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'codigo/script.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var res = JSON.parse(xhr.responseText);
      res.forEach(item => {});
    }
  }
  xhr.send(fd);
}
setInterval(rodando, 1000);
window.onload = Inicio();
