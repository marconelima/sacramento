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
	background-color: #25A8BA;
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
	width: 990px;
	background: #FFF;
	margin-top: 0;
	margin-right: auto;
	margin-bottom: 0;
	margin-left: auto;
}

/* ~~ the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo ~~ */
.header {
	background-color: #FFF;
}

.sidebar1 {
	float: left;
	width: 186px;
	background: #FCFBF9	;
	padding-bottom: 10px;
	border-left-width: 5px;
	

}
.content {
	width: 794px;
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
	width: 170px;
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

ul li a:hover { color: #4874cb; background: #C8D6F0; } /* Hover Styles */

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
	background-color: #25A8BA;
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
#apDiv1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
	left: 259px;
	top: 197px;
}
-->

#banner_flash {
	width:913px;
	height:249px;


}


#banner_destaque {
	width:220px;
	height:260px;
	background-color:#666;
}


#redondo {
        -moz-border-radius-bottomleft:8px;
        -moz-border-radius-topleft:8px;
		height:22px;
		border: 0;
}

#locate {
	position-left:25px;
}	



#apDiv2 {
	position:absolute;
	width:193px;
	height:257px;
	z-index:1;
	left: 50%;
	top: 470px;
	background-color:#fcfbf9;
	background-image:url(img/fnd_destaque.png)
}



#apDiv3 {
	
	margin-left:92px;
	left:73%;
	position:absolute;
	width:185px;
	height:185px;
	z-index:1;
	top: 155px;
	background:url(img/hehe.png)

}


 


#apDiv4 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:2;
	left: 531px;
	top: 1643px;
}
#apDiv5 {
	position:absolute;
	width:155px;
	height:115px;
	z-index:2;
	left: 337px;
	top: 530px;
}
#apDiv6 {
	position:absolute;
	width:155px;
	height:110px;
	z-index:3;
	left: 850px;
	top: 530px;
}
#apDiv7 {
	position:absolute;
	width:155px;
	height:110px;
	z-index:4;
	left: 600px;
	top: 530px;
}



<style type="text/css">
  a.classe1:link {text-decoration: none}
  a.classe1:visited {text-decoration: none}
  a.classe1:hover {
  text-decoration: underline; 
  color: #C8D6F0;
  }
  a.classe1:active {text-decoration: none}

  a.classe2:link {
  text-decoration: underline overline
  }
  a.classe2:visited {
  text-decoration: underline overline
  }
  a.classe2:hover {text-decoration: underline; 
  color: #C8D6F0;
  }
  a.classe2:active {
  text-decoration: underline overline
  }  
  
  li.circle {
  list-style-image:url(../imagens/hihi.JPG)
  color:#6CC;

}

#reduzida {
	width: 120px; 
	height: 100px; 
};

#redu {
	width: 100px; 
	height: 100px; 
};




</style>
<script type="text/javascript" src="includes/Creative_Menus/menuDisplay.js"></script>
<script type="text/javascript" src="includes/Creative_Menus/swfobject.js"></script>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>







</head>

<body>



<div class="container">


  <div class="header"><a href="#"></a>
    <!-- end .header -->
    <table width="100%" height="119" background="img/header.jpg" border="0" cellpadding="1">
      <tr>
        <td width="17%" rowspan="4">&nbsp;</td>
        <td width="50%">&nbsp;</td>

               
       
      </tr>
      <tr>
        <td>&nbsp;</td>


       
        
      </tr>
      <tr>
       
        
        
      <tr>
        <td valign="bottom">&nbsp;</td>
        <td colspan="3" align="center" valign="middle">&nbsp;</td>
        <td height="21"><a href="index.php" class="classe1"><font color="FBF8F3">____________</font>Inicio |</a> <a href="institucional.php" class="classe1">Institucional	 |</a><a href="contato.php" class="classe1"> Contato</a></td>
      </tr>
    </table>
  </div>
  <div class="sidebar1">
  <br />
  <center>
    <img src="img/prod_sacramento.png" width="170" height="24" />
    
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
</ul>

<br />

 

<img src="img/prod_parceiros.png" width="170" height="22" border="0" />
  <ul id="nav">
  <li><a href="parceiros.php">Conheça-os</a>
   </ul>
  </li>
</ul><br />



<br />
	
<img src="img/prod_catalogo.png" width="170" height="22" />
<ul id="nav">
  <li><a href="catalogos.php">Catálogos</a>
   </ul>
  </li>
</ul>
     

  <!-- end .sidebar1 --> </div>
  
  
  
  <div class="content">
  
    <div id="apDiv3" style="display:none">
          <center>	
        
        <form method="post" action="valida.php">
		<font size="-3">
		<label>Usuário</label>
		<br />
		<input name="usuario" type="text" size="15" maxlength="50"  />
		<label><br />
	
				Senha<br />
		</label>
		<input name="senha" type="password" size="15" maxlength="50" />
	
				<br />	<br />
			
            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="57" height="23" id="botao" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="botao.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="botao.swf" quality="high" bgcolor="#ffffff" width="57" height="23" name="botao" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
		</font>
      </form>
        
		<br />

		<font size="-3"><a href="selec_pessoa.php">Cadastre-se </a></font><br />
		<font size="-3">Esqueceu a senha?</font>
		
    </div>   
        
      
      
      

    <table width="794" height="38" border="0" cellpadding="2">
      <tr>
        <td width="706" bgcolor="#C8D6F0">
        
        <table width="296" id="locate" border="0">
          <tr>
            <td width="194">
            
                     <form name="localizar_prod" action="localizar.php" method="post">
      
     	<input name="localizar_prod" type="text" id="redondo" value="" size="30" /></td>

            <td width="141">
            
            <input name="enviar" type="image" id="enviar" src="img/bt_buscar.jpg" alt="Enviar">
         </form> 
            
            
            </td>
          </tr>
        </table>
        
       
        
        
        <td width="190" background: background="img/meu_cad.png" >
        
       

        
        
		
<script language=javascript>    
function toggle(obj) {
var el = document.getElementById(obj);
if ( el.style.display != 'none' ) {
el.style.display = 'none';
}
else {
el.style.display = '';
}
}
</script>


<a href="#" onclick="toggle('apDiv3');"><font size="2" color="#FFFFFF">Meu cadastro </font></a>        </td>
      
      </tr>
    </table>
    <p>&nbsp;</p>
    <p><strong>Institucional<img src="img/listra.png" width="760" height="15" /><br />
    </strong></p>
    <p>Atuamos na produção de vassouras, rodos, pás de lixo, esfregões, desentu-pidores, escovas e também na distribuição de utilidades domésticas; a mais de 12 anos de mercado, nossa empresa vem produzindo e distribuindo produtos de qualidade, que dão total segurança e garantia a nossos clientes.<br />
      <br />
    A Sacramento é uma marca conhecida com produtos de design moderno e com alta durabilidade que dá boas margens de lucro e giro rápido, mantendo ainda um excelente preço de mercado. Temos uma distribuição segura com 10 representantes espalhados em toda região metropolitana de Belo Horizonte e também em cidades vizinhas; com nossa entrega rápida em veículos próprios, garantimos o atendimento de  nossos clientes com a total segurança e qualidade dos nossos produtos.        
<p>Entre em contato com a nossa central por meio do portal online ou pelo telefone: (31) 3354.8250.
  <h1>
</div>
  <div class="footer">
    <table width="833" border="0" cellpadding="0">
      <tr> 
        <td bgcolor="#FFFFFF"><table width="986" height="80px" border="0">
          <tr>
            <td width="207">&nbsp;</td>
            <td width="529">&nbsp;</td>
            <td width="345">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><center>© Sacramento Industria e Comércio Ltda - ME<br />
Rua General Clark, 1030
  <!-- end #footer -->
- Novo Progresso | Contagem | MG - <strong>(31) 3354.8250</strong></td>
            <td><center><img src="img/footer-twitter.jpg" width="57" height="64" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><strong></td>
          </tr>
        </table></td>
        
        
        
        
        
      </tr>
    </table>
  </div>
  <!-- end .container -->
</div>
<script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
</body>
</html>
