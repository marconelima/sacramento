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
	width: 980px;
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


#reduzida {
	width: 260px; 
	height: 220px; 
};


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
        <td background="img/header.jpg"><div align="center"><span class="style5"><a href="modelo1.html"></a></span></div></td>
        <td background="img/header.jpg"><div align="center"><span class="style5"><a href="modelo1.html"></a></span></div></td>
        <td background="img/header.jpg"><div align="center"><span class="style5"><a href="../index.php">Sair</a></span></div></td>
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
  <table width="980" border="0">
    <tr>
      <td width="490"><center>
Cadastro de novos produtos</td>
      <td width="480">Verificação do ultimo produto cadastrado</td>
    </tr>
  </table>
  <p><strong><a href="admin.php">Voltar</a></strong>
  <hr /></p>
  <table width="980" border="0">
    <tr >
      <td width="526" >
      
      

      <p>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro_form" id="cadastro_form" onsubmit="return validar_campos()">

<table width="449" border="0" >
  <tr>
        <td width="134"><br />
Codigo*</td>
        <td width="272"><br />
  <input name="prod_cod" type="text" size="19" maxlength="50" /></td>
        </tr>
      <tr>
        <td>Nome*</td>
        <td><input name="prod_nome" type="text" size="19" maxlength="50"  /></td>
        </tr>
      <tr>
        <td>Tipo*</td>
        <td><select name="prod_tipo">
          <option>Cozinha</option>
          <option>Organizacao</option>
          <option>Mesa</option>
          <option>Banho</option>
          <option>Limpeza</option>
          <option>Infantil</option>
          <option>Construcao</option>
          <option>Diversos</option>
          <option>------------</option>
          <option>Sacramento</option>
          <option>------------</option>
          <option>Vassoura</option>
          <option>Rodo</option>
          <option>Prendedores</option>
          <option>Escovas</option>
          <option>Panos</option>
          <option>Pas</option>
          <option>Desentupidores</option>
          <option>Diversos.</option>
        </select></td>
        </tr>
      <tr>
        <td>Fabricante*</td>
        <td><select name="prod_fabri">
          <?php


include("conecta.php");
$sql = mysql_query ("SELECT * FROM fabricantes");
$row = mysql_num_rows($sql);
while ($row = mysql_fetch_array($sql)) {
$combobox = $row['fabri_nome']; }

?>
          
          
          <?php
// Consulta o restante da tabela
$sql = mysql_query ("SELECT * FROM fabricantes");
$row = mysql_num_rows($sql);
while ($row = mysql_fetch_array($sql)) {
$resto = $row['fabri_nome'];
?>
          <option value="<?php echo $resto;?>"><?php echo $resto;?></option>
          <?php }?>
        </select></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>Especificação*</td>
        <td><textarea name="prod_desc" cols="15" ></textarea></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>Embalagem*</td>
        <td><input name="prod_embalagem" type="text" size="19" maxlength="50"  /></td>
        </tr>
      <tr>
        <td>Dimensões*</td>
        <td><input name="prod_dimen" type="text" size="19" maxlength="50"  /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td><font size="-3">(altura</font>X<font size="-3">largura</font>X<font size="-3">profundidade)</font></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>EAN*</td>
        <td><input name="prod_ean" type="text" size="19" maxlength="14"  /></td>
        </tr>
      <tr>
        <td>Foto*</td>
        <td><input type="file" name="prod_foto" size="20"/></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" value="Cadastrar Produto"/></td>
        </tr>
  </table>
    <p></p>
      </form>
      <p>
      
	
      
<?php

ini_set('display_errors', 0);

		$prod_nome = $_POST['prod_nome'];
		$prod_cod = $_POST['prod_cod'];
		$prod_tipo = $_POST['prod_tipo']; 
		$prod_fabri = $_POST['prod_fabri'];
		$prod_desc = $_POST['prod_desc']; 
		$prod_dimen = $_POST['prod_dimen'];
		$prod_embalagem = $_POST['prod_embalagem'];
		$prod_ean = $_POST['prod_ean'];
		$prod_tmp = '1';
		$prod_foto = $_FILES['prod_foto'];


echo '<center>';

if ($prod_nome == ""){
	echo "*Preenchimento obrigatório.";
}
	elseif ($prod_cod == ""){
		echo "Código do produto - Preechimento obrigatório.";
	}
		elseif ($prod_tipo == ""){
		 echo "Tipo do produto - Preenchimento obrigatório.";
		}
			elseif ($prod_desc == ""){
				echo "Descrição do produto - Preenchimento obrigatório.";
			}
					elseif ($prod_dimen == ""){
						echo "Dimensões do produto - Preenchimento obrigatório.";
					}
						elseif ($prod_embalagem == ""){
							echo "Embalagem - Preenchimento obrigatório.";
						}
							elseif ($prod_ean == ""){
								echo "EAN do produto - Preenchimento obrigatório.";
							}
								
								else {
									
									
									
					preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $prod_foto["name"], $ext);
                   	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
                 	$caminho_imagem = "../img_prod/" . $nome_imagem;
         			move_uploaded_file($prod_foto["tmp_name"], $caminho_imagem);
					


									
									
					$inserir = mysql_query("INSERT INTO produtos(prod_nome,prod_cod,prod_tipo,prod_fabri,prod_desc,prod_dimen,prod_embalagem,prod_ean,prod_tmp,prod_foto) values('$prod_nome','$prod_cod','$prod_tipo','$prod_fabri','$prod_desc','$prod_dimen','$prod_embalagem','$prod_ean','$prod_tmp','$nome_imagem')") or die(mysql_error()); 
	
	

								
		}
		
	
      
?>

</p></td>
      
      
      
      
      
      <td width="444"><p><?php
          $listar = mysql_query("SELECT * FROM produtos ORDER BY prod_reg desc limit 1 ");
 

while ($produtos = mysql_fetch_object($listar)) {

	echo "<center>";
	
	echo "<img src='../img_prod/".$produtos->prod_foto."'  id='reduzida' >";
	
	echo "<br />";
	echo "<b>Código:</b> " . $produtos->prod_cod . "<br />";
	echo "<b>Nome:</b> " . $produtos->prod_nome . "<br />";
	echo "<b>Tipo:</b> "  . $produtos->prod_tipo . "<br />";
	echo "<b>Fabricante:</b> "  . $produtos->prod_fabri . "<br />";
	echo "<b>Especificação:</b> "  . $produtos->prod_desc . "<br />";
	echo "<b>Embalagem:</b> "  . $produtos->prod_embalagem . "<br />";
	echo "<b>Dimensões:</b> "  . $produtos->prod_dimen . "<br />";
	echo "<b>EAN:</b> "  . $produtos->prod_ean . "<br />";
	echo "<br /><br />";
	
}
?>
<center><input type=button onClick="parent.location='cad_prod_alterar.php'" value='Alterar Informações'><br /></p></td>
    
    
    
    </tr>
  </table>
  <br />

  
  
  
  
  


</div>
</body>
</html>
