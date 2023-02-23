<!-- MODULE CPF-->
<script type="text/javascript" src="{$this_path_ssl}js/maskedinput.js"></script>
<script type="text/javascript" src="{$this_path_ssl}js/functions.js"></script>
<script type="text/javascript">
    var urlValidatecnpj = '{$this_path_ssl}validate2.php?cnpj=';
    var urlValidatecpf = '{$this_path_ssl}validate2.php?cpf=';
    var urlCep = '{$this_path_ssl}getCep.php?cep=';
</script>
{if $required == "1"}
<script type="text/javascript">
{literal}
$("#account-creation_form").submit(function() {
    if(document.getElementById("id_pf").checked){ 
        return validateCpf();
        //executa validação de cpf, caso o mesmo seja invalido e nao deixa submeter o formulario     
        if($.trim($("#cpf").val()) == "")
            {
                document.getElementById("alertcpf").style.color = "red";
                document.getElementById("alertcpf").innerHTML = "CPF é de preenchimento obrigatório!";
                return false;  
            }
            if($.trim($("#rg").val()) == "")
            {
                 document.getElementById("alertrg").style.color = "red";
                 document.getElementById("alertrg").innerHTML = "RG é de preenchimento obrigatório!";
                 return false;
            }
            return true; 
    }
    else{ 
        //executa validação de cnpj, caso o mesmo seja invalido e nao deixa submeter o formulario
        return validateCnpj();                
        if($.trim($("#cnpj").val()) == "")
            {
                document.getElementById("alertcnpj").style.color = "red";
                document.getElementById("alertcnpj").innerHTML = "CNPJ é de preenchimento obrigatório!";
                return false;  
            }
            if($.trim($("#ie").val()) == "")
            {
                 document.getElementById("alertie").style.color = "red";
                 document.getElementById("alertie").innerHTML = "Número da inscrição estadual é de preenchimento obrigatório!";
                 return false;
            }
            return true;
    }

});

  
{/literal}
</script>
{/if}
{assign var="sl_country" value="58"}
{assign var="v.id_country" value="58"}

		<fieldset class="account_creation">
			<h3>{l s='Informações do cliente ou da empresa:' mod='cpfmodule'}</h3>
           <table width="40%">
           <tr>
           <td>
           <p class="checkbox"> <span style="font-weight:bold;">{l s='Tipo de Registro:' mod='cpfmodule'}</span></td>
                 <td><input type="radio" name="citizen" id="id_pj" value="1" onclick="checkMixed(this);" {if isset($smarty.post.citizen) AND $smarty.post.citizen == '1'}checked="checked"{/if}/></td>
                 <td><label for="id_pj">{l s='Pessoa Jurídica' mod='cpfmodule'}</label></td>
                 <td><input type="radio" name="citizen" id="id_pf" value="2" onclick="checkMixed(this);" {if $smarty.post.citizen == NULL OR $smarty.post.citizen == '2'}checked="checked"{/if}/></td>
                 <td><label for="id_pf">{l s='Pessoa Física' mod='cpfmodule'}</label></td>
                 </tr>
                 </table>
            </p>
			<div id="cpfdiv" {if isset($smarty.post.citizen) AND $smarty.post.citizen == '1'}style="display:none"{else}style="display:block"{/if}>
			<p class="required text">
				<label for="cpf"  style="font-weight:bold;">{l s='Número de CPF:' mod='cpfmodule'}</label>
				<input type="text" class="text" name="cpf" id="cpf" onkepress="validaCPF2(event)" maxlength="14" value="{if isset($smarty.post.cpf)}{$smarty.post.cpf}{/if}" onBlur="validateCpf()"  />
    			<sup>*</sup>                                               
                <span style="display:block">
                <span class="form_info">{l s='(somente números)' mod='cpfmodule'}</span>
                <span id="alertcpf" class="alertcpf" name="alertcpf" ></span>
                <div style="clear:both"></div>
                </span> 
  			</p><br />
  			<p class="required text">
                <label for="rg"  style="font-weight:bold;">{l s='Número de RG:' mod='cpfmodule'}</label>
				<input type="text" class="text" name="rg" id="rg" maxlength="11" value="{if isset($smarty.post.rg)}{$smarty.post.rg}{/if}" />
    			<sup>*</sup>               
                <span id="alertrg" class="alertrg" name="alertrg" style="position:absolute;"></span>
  			</p>
            </div>
            <div id="cnpjdiv" {if isset($smarty.post.citizen) AND $smarty.post.citizen == '1'}style="display:block"{else}style="display:none"{/if}>
   		    <p class="required text">
			    <label for="cnpj"  style="font-weight:bold;">{l s='Número de CNPJ:' mod='cpfmodule'}</label>
			    <input type="text" class="text" name="cnpj" id="cnpj" maxlength="19" value="{if isset($smarty.post.cnpj)}{$smarty.post.cnpj}{/if}" onBlur="validateCnpj()" />
    			<sup>*</sup>
                <span style="display:block">
                <span class="form_info">{l s='(somente números)' mod='cpfmodule'}</span>
                <span id="alertcnpj" class="alertcnpj" name="alertcnpj"></span>
                <div style="clear:both"></div>
                </span>
			</p><br />
     		<p class="required text">
                <label for="ie"  style="font-weight:bold;">{l s='Número de IE:' mod='cpfmodule'}</label>
				<input type="text" class="text" name="ie" id="ie" maxlength="11" value="{if isset($smarty.post.ie)}{$smarty.post.ie}{/if}" />
    			<sup>*</sup>                
                <span id="alertie" class="alertie" name="alertie" style="position:absolute;"></span>
  			</p>
            </div>
            <br />
		</fieldset>
<!-- /MODULE CPF-->
