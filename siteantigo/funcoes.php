<?php



//previnir ataque sql injection 

function verificar_dados($string) {

	 $string = get_magic_quotes_gpc() ? stripslashes($string) : $string ;

	 $string = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($string) : mysql_escape_string($string) ;

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

	   if(preg_match("#http://(.*)\.youtube\.com/watch\?v=(.*)(&(.*))?#", $url, $matches)){

		  if(isset($matches[2]) && $matches[2]!=''){

			 $vec = explode('&', $matches[2]);

			 $img = 'http://img.youtube.com/vi/'.$vec[0].'/default.jpg';

	

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



// Função para transformar strings em Maiúscula ou Minúscula com acentos

// $palavra = a string propriamente dita 

// $tp = tipo da conversão: 1 para maiúsculas e 0 para minúsculas 

function convertem($term, $tp) { 

    if ($tp == "1") $palavra = strtr(strtoupper($term),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 

    elseif ($tp == "0") $palavra = strtr(strtolower($term),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ"); 

    return $palavra; 

} 


function sendMail2($para,$de,$mensagem,$assunto)
{
	
    //DADOS SMTP
    $smtp = "smtp.industriasacramento.com.br";
    $usuario = "contato@industriasacramento.com.br";
    $senha = "s4c4m3t9nrsb";

    require_once 'smtp/smtp.php';

    $mail = new SMTP;
    $mail->Delivery('relay');
    $mail->Relay($smtp, $usuario, $senha, 587, 'login', false);
    $mail->TimeOut(10);
    $mail->Priority('high');
    $mail->From($de,"Sacramento");
    $mail->AddTo($para);
    $mail->Html($mensagem);

    if($mail->Send($assunto))
        return true;
    else
        return false;
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
	
	if(!$mail->Send()) {
		//$mensagemRetorno = 'Erro ao enviar e-mail: '. print($mail->ErrorInfo);
		return false;
	} else {
		//$mensagemRetorno = 'E-mail enviado com sucesso!';
		return true;
	}
	//return $mensagemRetorno;
}

?>