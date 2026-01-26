const bd = document.getElementsByTagName("body");
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
      res.forEach(item => {
        id = item.id;
		head[0].innerHTML = item.head;
      });
    }
  }
  xhr.send(fd);
}
function renderrm() {
  if(rd < 360){
	rd += 1;
  }else{
  	rd = 0;
  }
}
setInterval(renderrm, 10);
window.onload = Inicio();
