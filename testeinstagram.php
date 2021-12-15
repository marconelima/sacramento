<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Como exibir a ultima foto do Instagram no site</title>


<style type="text/css">
.conteudo {
	width:960px;
	text-align:justify;
	margin:0 auto;
	
}
h1 { text-align:center }

.rodape {
	width:940px;
	margin:0 auto;
	height:30px;
	line-height:30px;
	color:#FFF;
	font-weight:bold;
	background-color:#000;
	padding:0 10px;
}

#content {
	width:960px;
	margin:0 auto;	
}

</style>
</head>

<body>
<div id="content">
<h1>Como exibir a ultima foto do Instagram no site</h1>
<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
<h4>Exemplo com imagens 300px X 300px com usuário "wonderful_places".</h4>
	<?php
		// Gets our data
		function fetchData($url){
		     $ch = curl_init();
		     curl_setopt($ch, CURLOPT_URL, $url);
		     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		     curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		     $result = curl_exec($ch);
		     curl_close($ch); 
		     return $result;
		}

        //17841413321059764  -- 13278116035
		// Após o /users/ adicione o ID do usuário.
		// access_token=AQUI-VAI-O-ACCESS-TOKEN
		// &count=3 define o numero de imagens a serem exibidas
		$result = fetchData("https://api.instagram.com/v1/users/300c42da543648fc9524f45ea3967ad2/media/recent/?access_token=25410602.ba4c844.5dd9fb7ce9c242d8b58981be704b52e9&count=3");
		$result = json_decode($result);


        var_dump($result);
	?>



	<?php foreach ($result->data as $post): ?>
    <?php 
	// Pega os caminhos das imagens com HTTP
	$insegura = $post->images->standard_resolution->url;
	// Transforma os caminhos das imagens em HTTPS
	$segura = preg_replace("/^http:/i", "https:", $insegura);
	?>
		<!-- Link para o perfil do instagram -->
		<a href="https://instagram.com/wonderful_places" target="_blank"><img src="<?php echo $segura;?>" width="300px" height="300px"></a>
	<?php endforeach ?>

</div>
</body>
</html>