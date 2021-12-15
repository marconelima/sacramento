// JavaScript Document

//* VALIDAÇÃO DOS CAMPOS DA PÁGINA INDEX.PHP ADMIN
function validar_login() {
		var form = document.frmlogin;
				
		if(form.login.value == "" || form.login.value.length < 3)  {
			alert("Login inválido");
			return false;
		} else if(form.senha.value == "" || form.senha.value.length < 4) {
				alert("Senha inválida");
				return false;
			} else {
					return true;
				}
	}