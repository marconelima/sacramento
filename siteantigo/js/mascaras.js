function mascaraData(campoData){
	  var data = campoData.value;
	  if (data.length == 2){
		  data = data + '/';
		  document.forms[0].data.value = data;
		  return true;              
	  }
	  if (data.length == 5){
		  data = data + '/';
		  document.forms[0].data.value = data;
		  return true;
	  }
 }
 
 function mascaraHora(campoHora){
	  var hora = campoHora.value;
	  if (hora.length == 2){
		  hora = hora + ':';
		  document.forms[0].hora.value = hora;
		  return true;              
	  }
 }
 
 function mascaraHoraInicio(campoHora){
	  var hora = campoHora.value;
	  if (hora.length == 2){
		  hora = hora + ':';
		  document.forms[0].inicio.value = hora;
		  return true;              
	  }
 }
 
 function mascaraHoraTermino(campoHora){
	  var hora = campoHora.value;
	  if (hora.length == 2){
		  hora = hora + ':';
		  document.forms[0].termino.value = hora;
		  return true;              
	  }
 }


function m_Telefone(campo,tammax) {
	var vr = campo.value;
	tam = vr.length;
	
	if(tam == 1) {
	   vr = "";
	   vr = "(" + campo.value;
	} else if (tam == 3) {
	   vr =  vr.substr(0,3) + ")" + vr.substr(tam,1) ;
	   } else if (tam == 8) {
	   vr =  vr.substr(0,8) + "-" + vr.substr(tam,1) ;
	   } else {
	   vr = campo.value;
	}
	
	var tam = vr.length;
	campo.value = vr;
}

function v_NR(tecla) {
	if(typeof(tecla) == 'undefined')
		var tecla = window.event;
	
	var codigo = (tecla.which ? tecla.which : tecla.keyCode ? tecla.keyCode : tecla.charCode);
	
	// permite números, 8=backspace, 46=del e 9=tab
	if ( (codigo >= 48 && codigo <= 57) || (codigo >= 96 && codigo <= 105) || codigo == 8 || codigo == 46 || codigo == 9 ) { 
		return true; 
	} else { 
	alert("Apenas números são permitidos !"); return false; 
	} 
}

if (navigator.appName.indexOf('Microsoft') != -1){
 	clientNavigator = "IE";
 }else{
 	clientNavigator = "Other";
 }

function Bloqueia_Caracteres(evnt){
 //Função permite digitação de números
 	if (clientNavigator == "IE"){
 		if (evnt.keyCode < 48 || evnt.keyCode > 57){
 			return false
 		}
 	}else{
 		if ((evnt.charCode < 48 || evnt.charCode > 57) && evnt.keyCode == 0){
 			return false
 		}
 	}
 }


function Ajusta_Data(input, evnt){
 //Ajusta máscara de Data e só permite digitação de números
 	if (input.value.length == 2 || input.value.length == 5){
 		if(clientNavigator == "IE"){
 			input.value += "/";
 		}else{
 			if(evnt.keyCode == 0){
 				input.value += "/";
 			}
 		}
 	}
 //Chama a função Bloqueia_Caracteres para só permitir a digitação de números
 	return Bloqueia_Caracteres(evnt);
 }
 
 function Ajusta_Hora(input, evnt){
 //Ajusta máscara de Data e só permite digitação de números
 	if (input.value.length == 2){
 		if(clientNavigator == "IE"){
 			input.value += ":";
 		}else{
 			if(evnt.keyCode == 0){
 				input.value += ":";
 			}
 		}
 	}
 //Chama a função Bloqueia_Caracteres para só permitir a digitação de números
 	return Bloqueia_Caracteres(evnt);
 }
 

function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
	var t = new String(objTextBox.value);
	if (whichCode == 8){
	objTextBox.value = t.substring(0, t.length-1);
	} 
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}