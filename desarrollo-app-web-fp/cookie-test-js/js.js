var contador = 0;
window.onload = function(){
	cargarCokie();
	document.getElementById('a1').onclick = function(){enviar();};
	document.getElementById("img1").onclick = function(){borrar("img1");};
	document.getElementById('img2').onclick = function(){borrar('img2');};
	document.getElementById('img3').onclick = function(){borrar('img3');};
	document.getElementById('img4').onclick = function(){borrar('img4');};
	
}
function borrar(valor){
	document.getElementById(valor).remove();

	document.cookie = "foto-"+contador+"="+valor;
	contador++;
}
function cambiarColor() {
	var selector = document.getElementById('select');
    var value = selector[selector.selectedIndex].value;

    document.body.style.backgroundColor = value;
    document.cookie = "color-fons=" + value;

}
function enviar(){
		var text = document.getElementById('inom').value;
		document.cookie = "nom=" + text;
		alert("Se ha guardado el nombre: " + text);
}
function cargarCokie(){
	var array_cookies = document.cookie.split('; ');
	var nom_cookie, valor_cookie;
	var temp;
	for (var i = 0; i < array_cookies.length; i++) {

		temp = array_cookies[i].split("=");
		nom_cookie = temp[0];
		valor_cookie = temp[1];

		if (nom_cookie=="color-fons") {
			document.body.style.backgroundColor = valor_cookie;
		}
		if (nom_cookie=="nom") {
			document.getElementById("inom").value = valor_cookie;
		}
		for (var j = 0; j < 4; j++) {
			if (nom_cookie == "foto-"+j) {
				document.getElementById(valor_cookie).style.display = "none";
			}
		}
	}
}
function removeCookies(){
            var res = document.cookie.split("; ")
            for(var i = 0; i < res.length; i++) {
               var key = res[i].split("=");
               document.cookie = key[0]+"=; expires = Thu, 01 Jan 1970 00:00:00 UTC";
            }
            location.reload();
         }
	
