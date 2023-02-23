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


#reduzida {
	height:70px;
	width:70px; 
};



-->
</style>
<script type="text/javascript" src="includes/Creative_Menus/menuDisplay.js"></script>
<script type="text/javascript" src="includes/Creative_Menus/swfobject.js"></script>
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
        <td background="img/header.jpg"><div align="center"><span class="style5"><a href=""></a></span></div></td>
        <td background="img/header.jpg"><div align="center"><span class="style5"><a href=""></a></span></div></td>
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
  <div class="sidebar1">
    <img src="img/prod_sacramento.png" width="150" height="24" />
    
    <ul id="nav">
   
   <li><a href="">Consultar</a>

    <ul>
      <li><a href="filtro_cliente.php">Clientes Cadastrados</a></li>
      <li><a href="filtro_prod.php">Produtos Cadastrados</a></li>

    </ul>
  </li>
     <li><a href="">Cadastrar</a>

    <ul>
          <li><a href="cad_prod.php">Produtos</a></li>
          <li><a href="cad_fabricantes.php">Fabricantes</a></li>

    </ul>
    
    </li>
         <li><a href="">Alterar</a>

    <ul>
      <li><a href="alter_prod_filtro.php">Produtos Cadastrados</a></li>
      <li><a href="alterar_prod_destaque.php">Produto em destaque</a></li>
      <li><a href="alterar_prod_mais_vendido.php">Produtos mais vendidos</a></li>
      <li><a href="alterar_img_banner.php">Imagens banner inicial</a></li>
    </ul>
    </li>
    
    <li><a href="">Banir</a>
    
    <ul>
      <li><a href="banir_fabricante.php">Fabricantes</a>
    </ul>
    </li>
    
    
    </ul>




 </div>
  <div class="content">
    <h1><table width="100%" height="262" border="0" id="tabela1">
      <tr>
        <td width="74%" align="center" valign="middle" background="img/bg.jpg" bgcolor="#FFFFFF"><p>&nbsp;</p>
 <p><br /><br /><br /><center>Listagem Atual<center>
            <p>
              
              
  <?php


  define ("Diretorio", "../banner");

?>
              
              
              
  <?php

  function exibeEstrutura ($pasta, $acima, $caminho, $nivel = 0) {
  
    $arquivos = null;
    
    $id = md5 (microtime());
    
    $mostrar = ($nivel == 0) ? "" : " style=\"display: none;\"";
    
    echo "";
  
    if (!is_dir ($pasta)) :
    
      echo "$pasta não é uma pasta válida e/ou acessível!";
    
    endif;
    
    chdir ($pasta);
    
    $eval = dir ("./");
    
    $atual = getcwd();
    
    echo str_repeat ("&nbsp;", ($nivel * 5));

    echo "</a><br /><div id=\"$id\"$mostrar>\n\n\n";
    
    while (($itens = $eval->read()) !== false) :
    
      if (($itens == ".") or ($itens == "..")) :
      
        continue;
      
      endif;
      
      if (is_dir ($itens)) :
      
        exibeEstrutura ($itens, $atual, $caminho . "/" . $itens, ($nivel + 1));
        
      else :
      
        $arquivos .= str_repeat ("&nbsp;", (($nivel + 1) * 5));
        
        $extra = ($nivel != 0) ? $pasta . "/" : "";
    
        $arquivos .=  "$itens <a href=\"$caminho/$itens\"><img src=\"visualizar.gif\" border=\"0\" alt=\"\" title=\"Visualizar este arquivo!\" width=\"14\" height=\"14\" align=\"absmiddle\" /></a> <a href=\"apagar.php?source=" . base64_encode ($caminho . "/" . $itens) . "\"></a><br />\n";
        
      endif;
    
    endwhile;
    

    
    echo $arquivos;
    
    echo "</div>\n\n";
  
  }
  
  exibeEstrutura (Diretorio, Diretorio, Diretorio);

?>
              
              
              
              
              
            </p>
            <p><br /><center><a href="JavaScript:location.reload(true);">Atualizar Lista </a><br /><center>
            <a href="javascript:history.go(-1)">Voltar</a> <br /><hr><br />
            
              <br />
              
              
              
              
              
<?php
ini_set('display_errors', 0);
	// Pasta onde o arquivo vai ser salvo
	$_UP['pasta'] = '../banner';
	
	// Tamanho máximo do arquivo (em Bytes)
	$_UP['tamanho'] = 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 
	1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 
	1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 
	1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 
	1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 
	1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 
	1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 
	1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 
	1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 *
	1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 *  2; // 100Mb
	
	// Array com as extensões permitidas
	$_UP['extensoes'] = array('jpg', 'png', 'gif');
	
	// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
	$_UP['renomeia'] = false;
	
	// Array com os tipos de erros de upload do PHP
	$_UP['erros'][0] = 'Não houve erro';
	$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
	$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
	$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
	
	// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
	if ($_FILES['arquivo']['error'] != 0) {
	die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
	exit; // Para a execução do script
	}
	
	// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
	
	// Faz a verificação da extensão do arquivo
	$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
	if (array_search($extensao, $_UP['extensoes']) === false) {
	echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
	}
	
	// Faz a verificação do tamanho do arquivo
	else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
	echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
	}
	
	// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
	else {
	// Primeiro verifica se deve trocar o nome do arquivo
	if ($_UP['renomeia'] == true) {
	// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
	$nome_final = time().'.jpg';
	} else {
	// Mantém o nome original do arquivo
	$nome_final = $_FILES['arquivo']['name'];
	}
	
	// Depois verifica se é possível mover o arquivo para a pasta escolhida
	if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
	// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
	echo "Upload efetuado com sucesso!";
	echo '<br /><a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
	} else {
	// Não foi possível fazer o upload, provavelmente a pasta está incorreta
	echo "Não foi possível enviar o arquivo, tente novamente";
	}
	
	}

?>	

		
        </p>
            <p><font size="1"><center>
	      <br /></center></font><br /></p>
	    <p>


	      </p>
	    <p>       
	      
	      
	      
	      
	      <br />
	      </p>
	      <br />
	      
	      </p>
	    <p></p>
          
          
          </td>
        </tr>
  </table></h1>
    <h1><h1>
  </div>
  <div class="footer"></div>
  <!-- end .container -->
</div>
</body>
</html>