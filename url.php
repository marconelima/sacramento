<?php 
if(@$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'http'){
	$protocolo = "https://";
	header( "Location: ".$protocolo.$_SERVER['SERVER_NAME']);
}  
 
//a variavel atual, vai receber o que estiver na variável pag
//se não tiver nada, ela recebe o valor: principal""
$atual = (isset($_GET['pagina']) ? $_GET['pagina'] : 'home');

//aqui setamos um diretório onde ficarão as páginas internas do site
$pasta = 'paginas';

//vamos testar se a variável pag possui alguma "/"
//ou seja, caso a url seja: /noticia/2
if (substr_count($atual, '/') > 0) {
	//utilizamos o explode para separar os valores depois de cada "/"
	$atual = explode('/', $atual);

	/*testamos se depois do endereço do site, o valor da página é um arquivo existente
	caso não exista, iremos atribuir o valor "erro" que será uma página de erro
	 personalizada que existirá dentro da pasta '$pasta', esse arquivo será incluido sempre que um endereço invalido for digitado */
	$pagina = (file_exists("{$pasta}/" . $atual[0] . '.php')) ? $atual[0] : '404';

	//ao que tiver depois da segunda "/" atribuiremos a variavel $tela
	$tela = @$atual[1];
	//ao que tiver depois da terceira "/" atribuiremos a variavel $pag
	$numpagina = @$atual[2];
	//ao que tiver depois da quarta "/" atribuiremos a variavel $vw
	$vw = @$atual[3];
	//ao que tiver depois da quinto "/" atribuiremos a variavel $categ
	$categ = @$atual[4];
	//ao que tiver depois da sexto "/" atribuiremos a variavel $aut
	$aut = @$atual[5];
	//ao que tiver depois da setimo "/" atribuiremos a variavel $emailcadastro
	$emailcadastro = @$atual[6];
	//ao que tiver depois da oitavo "/" atribuiremos a variavel $palavra
	$palavra = @$atual[7];
	//ao que tiver depois da nono "/" atribuiremos a variavel $subcateg
	$subcateg = @$atual[8];
	//ao que tiver depois da decimo "/" atribuiremos a variavel $marca
	$marca = @$atual[9];
	//ao que tiver depois da decimo primeiro "/" atribuiremos a variavel $sair
	$sair = @$atual[10];
	//ao que tiver depois da decimo segundo "/" atribuiremos a variavel $remove
	$remove = @$atual[11];
	//ao que tiver depois da decimo terceiro "/" atribuiremos a variavel $montadora
	$montadora = @$atual[12];
	//ao que tiver depois da decimo quarto "/" atribuiremos a variavel $modelo
	$modelo = @$atual[13];
	//ao que tiver depois da decimo quinto "/" atribuiremos a variavel $ano
	$ano = @$atual[14];
	//ao que tiver depois da decimo sexto "/" atribuiremos a variavel $versao
	$versao = @$atual[15];
	//ao que tiver depois da decimo setimo "/" atribuiremos a variavel $fornecedor
	$fornecedor = @$atual[16];

	if(@$atual[17] != '') {
		$search = $atual[17];
	}


	$tela = ($tela == '' ? 0 : $tela);
	$numpagina = ($numpagina == '' ? 0 : $numpagina);
	$vw = ($vw == '' ? 0: $vw);
	$categ = ($categ == '' ? 0 : $categ);
	$aut = ($aut == '' ? 0 : $aut);
	$emailcadastro = ($emailcadastro == '' ? 0 : $emailcadastro);
	$palavra = ($palavra == '' ? 0 : $palavra);
	$subcateg = ($subcateg == '' ? 0 : $subcateg);
	$marca = ($marca == '' ? 0 : $marca);
	$sair = ($sair == '' ? 0 : $sair);
	$remove = ($remove == '' ? 0 : $remove);
	$montadora = ($montadora == '' ? 0 : $montadora);
	$modelo = ($modelo == '' ? 0 : $modelo);
	$ano = ($ano == '' ? 0 : $ano);
	$versao = ($versao == '' ? 0 : $versao);
	$fornecedor = ($fornecedor == '' ? 0 : $fornecedor);


} else {

	$pagina = (file_exists("{$pasta}/" . $atual . '.php')) ? $atual : '404';

	$pagina = '';
	$tela = '';
	$vw = '';
	$pag = '';

}

$siteUrl = "https://www.industriasacramento.com.br/testenovo/";

//com o uso de URL amigáveis se torna necessário que arquivos sejam chamados
//com o seu caminho completo, isso porque as imagens levam em consideração a URL
/* ex: <img src="<?=$siteUrl?>/pasta/arquivo.png" />*/


?>
