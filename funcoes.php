<?php
function calcula_frete($servico,$CEPorigem,$CEPdestino,$peso,$altura='4',$largura='12',$comprimento='16',$valor='1.00'){
    ////////////////////////////////////////////////
    // Código dos Serviços dos Correios
    // 41106 PAC
    // 40010 SEDEX
    // 40045 SEDEX a Cobrar
    // 40215 SEDEX 10
    ////////////////////////////////////////////////
    // URL do WebService
    $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$CEPorigem."&sCepDestino=".$CEPdestino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=".$valor."&sCdAvisoRecebimento=n&nCdServico=".$servico."&nVlDiametro=0&StrRetorno=xml";
    // Carrega o XML de Retorno
    $xml = simplexml_load_file($correios);
    // Verifica se não há erros
    if($xml->cServico->Erro == '0'){
        return $xml->cServico->Valor;
    }else{
        return false;
    }
}

//previnir ataque sql injection
function verificar_dados($con,$string) {
	 $string = get_magic_quotes_gpc() ? stripslashes($string) : $string ;
	 $string = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($con,$string) : mysqli_escape_string($con,$string) ;
	 return $string ;
}
function verificar_dados2($fonte)    {
	$inject=0;
	$fonte=strtolower($fonte);
	$badword1= array("' or 0=0 --",'" or 0=0 --',"or 0=0 --","' or 0=0 #","admin'--",'" or 0=0 #',"or 0=0 #","' or 'x'='x",'" or "x"="x',"') or ('x'='x","' or 1=1--",'" or 1=1--',"or 1=1--","' or a=a--",'" or "a"="a',"') or ('a'='a",'") or ("a"="a','hi" or "a"="a','hi" or 1=1 --',"hi' or 1=1 --","hi' or 'a'='a","hi') or ('a'='a",'hi") or ("a"="a',"or '1=1'");
		 for($i=0;$i<sizeof($badword1);$i++)    {
			  if(substr_count($fonte,$badword1[$i])!=0)    {
			   $inject=1;
			  }
		 }
	$badword2 = array(" select","select "," insert"," update","update "," delete","delete "," drop","drop "," destroy","destroy ");
		 for($i=0;$i<sizeof($badword2);$i++)    {
			  if(substr_count($fonte,$badword2[$i])!=0)    {
			   $inject=1;
			  }
		 }
	$charvalidos = "abcdefghijklmnopqrstuvwxyz0123456789ÁÀÃÂÇÉÈÊÍÌÓÒÔÕÚÙÜÑáàãâçéèêíìóòôõúùüñ!?@#$%&(){}[]:;,.- ";
	 for($i=0;$i<strlen($fonte);$i++)    {
		$char = substr($fonte,$i,1);
			if(substr_count($charvalidos,$char)==0)    {
			   $inject=1;
			  }
		 }
	return($inject);
}//end function


function youtubeImage($url) {
		$url = str_replace('https','http',$url);
	   if(preg_match("#http://(.*)\.youtube\.com/watch\?v=(.*)(&(.*))?#", $url, $matches)){
		  if(isset($matches[2]) && $matches[2]!=''){
			 $vec = explode('&', $matches[2]);
			 $img = 'http://img.youtube.com/vi/'.$vec[0].'/mqdefault.jpg';

			 return $img;
			 //return '';
		  } else {
				  return false;
		  }
	   } else {
			   return false;
	   }
	}


	function embedVideo($url,$width,$height){
		$url = str_replace('https','http',$url);
	   /*
		* RETORNA VIDEOS DO YOUTUBE E METACAFE
		*
		* É POSSÍVEL IMPLEMENTAR MAIS EXPRESSÕES REGULARES
		*
		* é possível adaptar um retorno em string também,
		* aí fica a critério de quem usar a função
		*
		*/

	   if(preg_match("#http://(.*)\.youtube\.com/watch\?v=(.*)(&(.*))?#", $url, $matches)){
		  echo '
				<object id="objeto" width="'.$width.'" height="'.$height.'">
				   <param name="movie" id="movie" value="http://www.youtube.com/v/'.$matches[2].'&hl=pt-br&fs=1"></param>
				   <param name="allowFullScreen" value="true"></param>
				   <param
				   <param name="allowscriptaccess" value="always"></param>
				   <embed src="http://www.youtube.com/v/'.$matches[2].'&hl=pt-br&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" wmode="transparent" allowfullscreen="true" width="'.$width.'" height="'.$height.'"></embed>
				</object>
				';
	   }elseif(preg_match("#http://www\.metacafe\.com/watch/(([^/].*)/([^/].*))/?#", $url, $matches)){
		  echo '<embed flashVars="playerVars=showStats=no|autoPlay=no|videoTitle="  src="http://www.metacafe.com/fplayer/'.$matches[1].'.swf" width="'.$width.'" height="'.$height.'" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>';
	   }
	}


function limitarTexto($texto, $limite){
	$texto = substr($texto, 0, strrpos(substr($texto, 0 , $limite), ' ')).'...';
	return $texto;
}

function limita_caracteres($texto, $limite, $quebra = true) {
    $tamanho = strlen($texto);

    // Verifica se o tamanho do texto é menor ou igual ao limite
    if ($tamanho <= $limite) {
        $novo_texto = $texto;
    // Se o tamanho do texto for maior que o limite
    } else {
        // Verifica a opção de quebrar o texto
        if ($quebra == true) {
            $novo_texto = trim(substr($texto, 0, $limite)).'...';
        // Se não, corta $texto na última palavra antes do limite
        } else {
            // Localiza o útlimo espaço antes de $limite
            $ultimo_espaco = strrpos(substr($texto, 0, $limite), ' ');
            // Corta o $texto até a posição localizada
            $novo_texto = trim(substr($texto, 0, $ultimo_espaco)).'...';

            // Retira imagem
            $novo_texto = retira_imagens($novo_texto);
        }
    }

    // Retorna o valor formatado
    return $novo_texto;
}

function retira_imagens($texto){

    // Localiza a primeira imagem dentro do texto
    $primeira_imagem = strpos($texto, '<img');
    // Corta o texto até a posição Localizada 2
    $novo_texto = trim(substr($texto, 0, $primeira_imagem));

    return $novo_texto;

}

function convertem($term, $tp) {
    if ($tp == "1") $palavra = strtr(strtoupper($term),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
    elseif ($tp == "0") $palavra = strtr(strtolower($term),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ");
    return $palavra;
}

function sem_especiais($palavra){

    // assume $str esteja em UTF-8
    $from = "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ";
    $to = "aaaaeeiooouucAAAAEEIOOOUUC";

    $keys = array();
    $values = array();
    preg_match_all('/./u', $from, $keys);
    preg_match_all('/./u', $to, $values);
    $mapping = array_combine($keys[0], $values[0]);
    return strtr($palavra, $mapping);
}


?>

<?php
define("TRUNC_BEFORE_LENGHT", 0);
define("TRUNC_AFTER_LENGHT", 1);
function str_truncate($str, $length, $rep=TRUNC_BEFORE_LENGHT)
{
if(strlen($str)<=$length) return $str;
if($rep == TRUNC_BEFORE_LENGHT) $oc = strrpos(substr($str,0,$length),' ');
if($rep == TRUNC_AFTER_LENGHT) $oc = strpos(substr($str,$length),' ') + $length;
return substr($str, 0, $oc);
}


function calculatempo($data){
	$d1=new DateTime($data);
	$d2=new DateTime(date("Y-m-d H:i:s"));
	$di=$d2->diff($d1);

	//var_dump($diff);

	$diff = (array)$di;


	if($diff['y'] > 0 && $diff['y'] == 1){
		$retorno = $diff['y']." ano ";
	} elseif($diff['y'] > 1){
		$retorno = $diff['y']." anos ";
	} elseif($diff['m'] > 0 && $diff['m'] == 1){
		$retorno = $diff['m']." mês ";
	} elseif($diff['m'] > 1){
		$retorno = $diff['m']." meses ";
	} elseif($diff['d'] > 0 && $diff['d'] == 1){
		$retorno = $diff['d']." dia ";
	} elseif($diff['d'] > 1){
		$retorno = $diff['d']." dias ";
	} elseif($diff['h'] > 0 && $diff['h'] == 1){
		$retorno = $diff['h']." hora ";
	} elseif($diff['h'] > 1){
		$retorno = $diff['h']." horas ";
	} elseif($diff['i'] > 0 && $diff['i'] == 1){
		$retorno = $diff['i']." minuto ";
	} elseif($diff['i'] > 1){
		$retorno = $diff['i']." minutos ";
	}

	return $retorno;
}

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

function sendMail($destinatarios,$nomeDestinatario,$mensagem,$assunto){

	$usuario = "contato@industriasacramento.com.br";
	$senha = "s4c4m3t9nrsb";

	include_once("phpmailer/class.smtp.php");
	include_once("phpmailer/class.phpmailer.php");

	$To = $destinatarios;
	$Subject = $assunto;
	$Message = $mensagem;

	$Host = 'smtp.'.substr(strstr($usuario, '@'), 1);
	$Username = $usuario;
	$Password = $senha;
	$Port = "587";

	$mail = new PHPMailer();
	$body = $Message;
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host = $Host; // SMTP server
	$mail->SMTPDebug = 0; // enables SMTP debug information (for testing)
	// 1 = errors and messages
	// 2 = messages only
	$mail->SMTPAuth = true; // enable SMTP authentication
	$mail->Port = $Port; // set the SMTP port for the service server
	$mail->Username = $Username; // account username
	$mail->Password = $Password; // account password

	$mail->SetFrom($usuario, $nomeDestinatario);
	$mail->Subject = $Subject;
	$mail->MsgHTML($body);
	$mail->AddAddress($To, "");

    echo "teste teste teste";

	if(!$mail->Send()) {
		$mensagemRetorno = 'Erro ao enviar e-mail: '. print($mail->ErrorInfo);
        echo $mensagemRetorno;
		return false;
	} else {
		//$mensagemRetorno = 'E-mail enviado com sucesso!';
		return true;
	}
	//return $mensagemRetorno;
}
?>
