<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sacramento</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Horizontal Drop Down Menus</title>
<script type="text/javascript" src="drop_down.js"></script>
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	margin: 0;
	padding: 0;
	color: #000;
	background-color: #c5e7ee;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
	padding: 0;
	margin: 0;
}
}
h2 {
	margin-top: 0;
	padding-right: 15px;
	padding-left: 15px;
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
	
h1, h3, h4, h5, h6, p {
	margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
	padding-right: 15px;
	padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
	font-size: 12px;
	text-align: left;
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}

/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
	color: #42413C;
	text-decoration: none; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
}
a:visited {
	color: #6E6C64;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
	text-decoration: none;
}

/* ~~this fixed width container surrounds the other divs~~ */
.container {
	width: 980px;
	background: #FFF;
	margin: 0 auto; 	
}

/* ~~ the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo ~~ */
.header {
	background-color: #FFF;
}

.sidebar1 {
	float: left;
	width: 180px;
	background: #F5F6F2;
	padding-bottom: 10px;
}
.content {
	width: 780px;
	float: left;
	padding-top: 0px;
	padding-right: 0;
	padding-bottom: 0px;
	padding-left: 0;
}

.content ul, .content ol { 
	padding: 0 15px 15px 40px;
}

ul {
	margin: 0;
	padding: 0;
	list-style: none;
	width: 176px; /* Width of Menu Items */
	border-bottom: 1px solid #ccc;
	}

ul li {
	position:relative;
	font:Arial, Helvetica, sans-serif;
	font-size:12px;
	}

ul li a {
	display: block;
	text-decoration: none;
	color: #777;
	background: #F5F6F2; /* IE6 Bug */
	padding: 5px;
	border: 1px solid #ccc;
	border-bottom: 0;
	}

/* Fix IE. Hide from IE Mac \*/
* html ul li { float: left; height: 1%; }
* html ul li a { height: 1%; }
/* End */

ul li a:hover { color: #20a9bb; background: #cff2f6; } /* Hover Styles */

ul ul {
	position:absolute;
	display:none;
	left: 178px; /* Set 1px less than menu width */
	top: 0;
}

li ul li a { padding: 2px 5px; } /* Sub Menu Styles */

li:hover ul ul, li.over ul ul { display:none; }

li:hover ul, li li:hover ul, li.over ul, li li.over ul { display: block; } /* The magic */

.footer {
	position: relative;
	clear: both;
	text-align: center;
	background-color: #c5e7ee;
	padding-top: 0px;
	padding-right: 0;
	padding-bottom: 10px;
	padding-left: 0;
}

.fltrt {  
	float: right;
	margin-left: 8px;
}
.fltlft { 
	float: left;
	margin-right: 8px;
}
.clearfloat { 
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
table tr td {
	text-align: center;
	font-size: 12px;
	font-weight: bold;
	color: #000;
}
.none {
	font-family: Arial, Helvetica, sans-serif;
}
.container .content #tabela1 tr td table tr td {
	text-align: center;
}
.container .footer table tr td table tr td {
	text-align: left;
	font-size: 10px;
	font-weight: normal;
}
titulos {
	font-weight: bold;
}





-->
</style>
<script type="text/javascript" src="includes/Creative_Menus/menuDisplay.js"></script>
<script type="text/javascript" src="includes/Creative_Menus/swfobject.js"></script>










<script type="text/javascript" >
function validar_campos() {


//usu_login = nome do campo, cadastro = nome do formulário

var login = document.usu_login.cadastro_form.value;

if (login ==""){
	alert("Preenchimento do campo Login obrigatório.");
	document.usu_login.cadastro_form.focus();
}

return false;
}

</script> 




<script type="text/javascript" >

function telefone(v){
    v=v.replace(/\D/g,"")                      //Remove tudo o que não é dígito
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
    return v
}

</script> 



<script>

function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function leech(v){
    v=v.replace(/o/gi,"0")
    v=v.replace(/i/gi,"1")
    v=v.replace(/z/gi,"2")
    v=v.replace(/e/gi,"3")
    v=v.replace(/a/gi,"4")
    v=v.replace(/s/gi,"5")
    v=v.replace(/t/gi,"7")
    return v
}





function cpf(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}

function telefone(v){
    v=v.replace(/\D/g,"")                      //Remove tudo o que não é dígito
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
    return v
}

function nascimento(v){
    v=v.replace(/\D/g,"")                      //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
	 v=v.replace(/(\d{2})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
    return v
}



</script>




</head>

<body>
<div class="container">
  <div class="header"><a href="#"></a>
    <!-- end .header -->
    <table width="100%" height="119" background="img/header.jpg" border="0" cellpadding="1">
      <tr>
        <td width="20%" rowspan="4">&nbsp;</td>
        <td width="52%">&nbsp;</td>
        <td width="2%">&nbsp;</td>
        <td width="7%">&nbsp;</td>
        <td width="10%">&nbsp;</td>
        <td width="9%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td background="img/header.jpg">&nbsp;</td>
        <td background="img/header.jpg"><div align="center"><span class="style5"><a href="modelo1.html"></a></span><a href="modelo1.html">Home</a></div></td>
        <td background="img/header.jpg"><div align="center"><span class="style5"><a href="modelo1.html"></a></span><a href="modelo1.html">Institucional</a></div></td>
        <td background="img/header.jpg"><div align="center"><span class="style5"><a href="modelo1.html">Contato</a></span></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td valign="bottom">&nbsp;</td>
        <td colspan="3" align="center" valign="middle">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </div>
  <div class="sidebar1">
    <img src="img/prod_sacramento.png" width="150" height="24" />
   <ul id="nav">
  <li><a href="listar/vassoura.php">Vassouras</a> 
  <li><a href="listar/rodo.php">Rodo</a> 
  <li><a href="listar/prendedores.php">Prendedores</a>
  <li><a href="listar/escovas.php">Escovas</a>
  <li><a href="listar/panos.php">Panos</a>
  <li><a href="listar/pas.php">Pás</a>
  <li><a href="listar/desentupidores.php">Desentupidores</a>
  <li><a href="listar/diversossac.php">Diversos</a>
   </ul>
  </li>
</ul><br />

<img src="img/p_sacramomento1.png" width="150" height="36" />
<br />
<br />
	

<img src="img/prod_utilidade.png" width="170" height="24" />
<ul id="nav">
  <li><a href="listar/cozinha.php">Cozinha</a>
  <li><a href="listar/organizacao.php">Organização</a> 
  <li><a href="listar/mesa.php">Mesa</a>
  <li><a href="listar/banho.php">Banho</a>
  <li><a href="listar/limpeza.php">Limpeza</a>
  <li><a href="listar/infantil.php">Infantil</a>
  <li><a href="listar/construcao.php">Construção</a>
  <li><a href="listar/diversos.php">Diversos</a>
   </ul>
  </li>
  <a href="parceiros.html"><img src="img/prod_parceiros.png" width="150" height="22" border="0" /></a>
</ul>
&nbsp;<!-- end .sidebar1 --> </div>
  <div class="content">

    <table width="780" border="0" cellpadding="2">
      <tr>
        <td width="568" bgcolor="#F5F6F2"><input name="busca" type="text" id="busca" value="Buscar por" size="60" />
        <img src="img/bt_buscar.jpg" width="75" height="23" /></td>
        <td width="198" bgcolor="#F5F6F2">Meu Cadastro</td>
      </tr>
    </table>
    <h1><br />
      <table width="100%" height="490"  border="0" id="tabela1">
      <tr>
        <td width="74%" align="center" valign="top" background="img/fnd_bg.png" bgcolor="#FFFFFF"><p>&nbsp;</p>
          <p><strong>Cadastro de novo usuário - Pessoa Física</strong> </p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          
          







          <form name="cadastro_form" action="incluir.php" onSubmit="return validar_campos()" method="post" >
          
          <table width="514" border="0">
            <tr>
              <td width="151">Login*</td>
              
              <td width="121"><input name="usu_login" type="text" size="15" maxlength="50" onSubmit="return validar_campos()" /></td>
              <td width="131">Senha*</td>
              <td width="93"><input name="usu_senha" type="password" size="15" maxlength="50"  /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>Confirme Senha*</td>
              <td><input name="usu_senha2" type="password" size="15" maxlength="50"  /></td>
            </tr>
            <tr>
              <td>Nome*</td>
              <td><input name="usu_nome" type="text" size="15" maxlength="100"  /></td>
              <td>Data de Nasc.*</td>
              <td><input name="usu_nasc" type="text" size="15" onkeypress="mascara(this,nascimento)" maxlength="10"  /></td>
            </tr>
            <tr>
              <td>CPF*</td>
              <td><input name="usu_cpf_cnpj" type="text" size="15"  onkeypress="mascara(this,cpf)" maxlength="14" /> </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Endereço*</td>
              <td><input name="usu_end_add" type="text" size="15" maxlength="50"  /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Cidade*</td>
              <td><input name="usu_end_cidade" type="text" size="15" maxlength="50"  /></td>
              <td>Estado*</td>
              <td><input name="usu_end_estado" type="text" size="15" maxlength="50"  /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Telefone Fixo*</td>
              
              
              <td>
              
              
              <input name="usu_tel1" type="text" size="15" onkeypress="mascara(this,telefone)" maxlength="14"  />
              
              
              </td>
              <td>Telefone Móvel*</td>
              <td><input name="usu_tel2" type="text" size="15" onkeypress="mascara(this,telefone)" maxlength="14"  /></td>
            </tr>
            <tr>
              <td>E-mail*</td>
              <td><input name="usu_email" type="text" size="15" maxlength="50"  /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>	<input type="submit" value="Cadastrar"/>
              
              </td>
            </tr>
            
            
            
             
            </table>
            
            
            


            </form>
            


         
             
              
          <p>
          
          
    
          
          </p>
          <p>&nbsp;</p>
          <p><font size="1"><strong>*Preenchimento obrigatório.</strong></font></p>
          <p>&nbsp;</p></td>
        
        
        


      </tr>
    </table></h1>







  </div>
  <div class="footer">
    <table width="100%" border="0" cellpadding="2">
      <tr> 
        <td colspan="2" background="img/barra_institucional.png"><table width="100%" height="83" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="11%">&nbsp;</td>
            <td width="31%">Institucional</td>
            <td width="9%" rowspan="2">&nbsp;</td>
            <td width="24%"><span id="j_id261">
              <h4>&nbsp;</h4>
            </span></td>
            <td width="6%" rowspan="2" valign="middle"><img src="img/footer-twitter.png" width="57" height="64" /></td>
            <td width="19%"> Twitter Sacramento</td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td><a href="modelo1.html">A empresa</a><br />
              <a href="modelo1.html">Envie seu curriculum</a></td>
            <td>&nbsp;</td>
            <td valign="top">Venha nos seguir e saiba  todas as novidades</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&copy; Sacramento Industria e Comércio Ltda - ME<br />
          Rua General Clark, 1030
          <!-- end #footer -->
        - Novo Progresso | Contagem | MG - <strong>(31) 3354.8250</strong></td>
      </tr>
    </table>
  </div>
  <!-- end .container -->
</div>
</body>
</html>
