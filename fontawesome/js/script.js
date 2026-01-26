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
        id = item.id;
		head[0].innerHTML = item.head;
		ctda[0].innerHTML = item.ctds;
    	foot[0].innerHTML = item.foot;
      });
    }
  }
  xhr.send(fd);
}

function sistema(ip,ir){
  if(ip != 0){
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
          id = item.id;
		  sms[0].innerHTML = item.sms;
        });
      }
    }
    xhr.send(fd);
  }else{
    sms[0].style.display = "none";
  }
}
//setInterval(rodarsms, 100);
window.onload = Inicio(1);
