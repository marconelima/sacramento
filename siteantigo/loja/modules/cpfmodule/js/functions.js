    function checkMixed(id)
    {
        if (id.value == "1")
        {
            $("#cpfdiv").css("display","none");
            $("#cnpjdiv").css("display","block");
            $("#alertcpf").html("");
            $("#cpf").val('');
            $("#rg").val('');
        }
        if(id.value == "2")
        {
            $("#cpfdiv").css("display","block");
            $("#cnpjdiv").css("display","none");
            $("#alertcnpj").html("");
            $("#cnpj").val('');
            $("#ie").val('');
        }
    }

              function validateCpf()
             {
                 $isValCpf = false;
                 $("#alertcpf").css("color","orange");
                 $("#alertcpf").html("Aguarde, validando...");
                 if($.trim($("#cpf").val()) != "")
                 {
                     $.ajax({
                        url : urlValidatecpf+$("#cpf").val(),
                        context : document.body,
                        async : false,
                        dataType : "JSON"             
                    }).done(function(result){
                         if(result.validate == "0")
                         {
                             $("#alertcpf").css("color","red");
                             $("#alertcpf").html(result["err"]);
                             isValCpf = false;
                         }
                         else
                         {
                             $("#alertcpf").css("color","green");
                             $("#alertcpf").html("CPF válido");
                             $('#submitAccount:disabled').removeAttr('disabled');                           
                             $isValCpf = true;                            
                         }                         
                     });
                 }
                 return $isValCpf;                 
             }

             function validateCnpj()
             {
                 $isValCnpj = false;
                 $("#alertcnpj").css("color","orange");
                 $("#alertcnpj").html("Aguarde, validando...");
                 if($.trim($("#cnpj").val()) != "")
                 {

                      $.ajax({
                        url : urlValidatecnpj+$("#cnpj").val(),
                        context : document.body,
                        async : false,
                        dataType : "JSON"             
                    }).done(function(result)
                     {
                         if(result.validate == "0")
                         {
                             $("#alertcnpj").css("color","red");
                             $("#alertcnpj").html(result["err"]);
                             $('#submitAccount').attr('disabled','disabled');
                             $isValCnpj = false;                             
                         }
                         else
                         {
                             $("#alertcnpj").css("color","green");
                             $("#alertcnpj").html("CNPJ válido!");
                             $('#submitAccount:disabled').removeAttr('disabled');
                             $isValCnpj = true;
                         }
                     });
                 }
                return $isValCnpj;
             }
         
         function getEndereco()
         {
             if($.trim($("#postcode").val()) != "")
             {
                 $("#alertcep").css("color","orange");
                 $("#alertcep").html("Aguarde, validando...");
                 $.getScript(urlCep+$("#postcode").val(), function()
                 {  
                     if(resultadoCEP && resultadoCEP["resultado"] == "1")
                     {

                         $("#alertcep").css("color","green");
                         $("#alertcep").html("Número válido");
                         $("#address1").val(unescape(resultadoCEP["tipo_logradouro"])+"  "+unescape(resultadoCEP["logradouro"]));
                         $("#address2").val(unescape(resultadoCEP["bairro"]));
						 $("#city").val(unescape(resultadoCEP["cidade"]));
                         $("#postcode").val(unescape($("#postcode").val()));
                         $("#postcode").removeAttr("readonly", true);
                         if(resultadoCEP["uf"] == "AC"){$("#id_state").val("313");}
                         if(resultadoCEP["uf"] == "AL"){$("#id_state").val("314");}
                         if(resultadoCEP["uf"] == "AP"){$("#id_state").val("315");}
                         if(resultadoCEP["uf"] == "AM"){$("#id_state").val("316");}
                         if(resultadoCEP["uf"] == "BA"){$("#id_state").val("317");}
                         if(resultadoCEP["uf"] == "CE"){$("#id_state").val("318");}
                         if(resultadoCEP["uf"] == "ES"){$("#id_state").val("319");}
                         if(resultadoCEP["uf"] == "GO"){$("#id_state").val("320");}
                         if(resultadoCEP["uf"] == "MA"){$("#id_state").val("321");}
                         if(resultadoCEP["uf"] == "MT"){$("#id_state").val("322");}
                         if(resultadoCEP["uf"] == "MS"){$("#id_state").val("323");}
                         if(resultadoCEP["uf"] == "MG"){$("#id_state").val("324");}
                         if(resultadoCEP["uf"] == "PA"){$("#id_state").val("325");}
                         if(resultadoCEP["uf"] == "PB"){$("#id_state").val("326");}
                         if(resultadoCEP["uf"] == "PR"){$("#id_state").val("327");}
                         if(resultadoCEP["uf"] == "PE"){$("#id_state").val("328");}
                         if(resultadoCEP["uf"] == "PI"){$("#id_state").val("329");}
                         if(resultadoCEP["uf"] == "RJ"){$("#id_state").val("330");}
                         if(resultadoCEP["uf"] == "RN"){$("#id_state").val("331");}
                         if(resultadoCEP["uf"] == "RS"){$("#id_state").val("332");}
                         if(resultadoCEP["uf"] == "RO"){$("#id_state").val("333");}
                         if(resultadoCEP["uf"] == "RR"){$("#id_state").val("334");}
                         if(resultadoCEP["uf"] == "SC"){$("#id_state").val("335");}
                         if(resultadoCEP["uf"] == "SP"){$("#id_state").val("336");}
                         if(resultadoCEP["uf"] == "SE"){$("#id_state").val("337");}
                         if(resultadoCEP["uf"] == "TO"){$("#id_state").val("338");}
                      }
                      if(resultadoCEP && resultadoCEP["resultado"] == "0")
						{ $("#alert").css("color","red");
						$("#alert").html("CEP não encontrado. Verifique, por favor."); } 
                   });
			   }
	        }
      
      $(function($) {
			$("#cnpj").mask('99.999.999/9999-99');
            $("#cpf").mask('999.999.999-99');
   			//$("#cep").mask('99999-999');
           // $("#postcode").mask('99999-999');
			$("#phone").mask('(99)9999-9999');
			$("#phone_mobile").mask('(99)9999-9999');
		});

