/***** Usuario Registro ******/
function showPlaceholderUsuarioReg(){
	document.getElementById("usuarioReg").placeholder = "Máximo 6 caracteres";
}
function hidePlaceholderUsuarioReg(){
	document.getElementById("usuarioReg").placeholder = "";
}

/***** Email Registro ******/
function showPlaceholderEmailReg(){
	document.getElementById("emailReg").placeholder = "Escriba su email correctamente";
}
function hidePlaceholderEmailReg(){
	document.getElementById("emailReg").placeholder = "";
}

/***** Contraseña Registro ******/
function showPlaceholderContraReg(){
	document.getElementById("contraseñaReg").placeholder = "Mínimo 6 caracteres, incluir números y una mayúscula";
}

function hidePlaceholderContraReg(){
	document.getElementById("contraseñaReg").placeholder = "";
}

/*---------- SLIDER -----------*/

function mostrar(){
	document.getElementById('menu-desplegable').classList.add('open')
}
	
function ocultar(){
	document.getElementById('menu-desplegable').classList.remove('open')
}

window.addEventListener('scroll', function() {
  var elementos = document.querySelectorAll('.animar');
  
  elementos.forEach(function(elemento) {
    var posicion = elemento.getBoundingClientRect().top;
    var pantalla = window.innerHeight;
    
    if (posicion < pantalla) {
      elemento.classList.add('aparecer');
      elemento.classList.remove('desaparecer');
    } else {
      elemento.classList.remove('aparecer');
      elemento.classList.add('desaparecer');
    }
  });
});