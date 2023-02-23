<?php



$_SG['conectaServidor'] = true;    // Abre uma conexгo com o servidor MySQL?
$_SG['abreSessao'] = true;         // Inicia a sessгo com um session_start()? 
$_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' й diferente de 'THIAGO'
$_SG['validaSempre'] = true;       // Deseja validar o usuбrio e a senha a cada carregamento de pбgina?


// Evita que, ao mudar os dados do usuбrio no banco de dado o mesmo contiue logado.

 
$_SG['servidor'] = 'mysql.iwi.com.br';    // Servidor MySQL
$_SG['usuario'] = 'sacramento';          // Usuбrio MySQL
$_SG['senha'] = 'saroot';                // Senha MySQL
$_SG['banco'] = 'sacramento';            // Banco de dados MySQL
$_SG['paginaLogin'] = 'index.php'; // Pбgina de login
$_SG['tabela'] = 'usuarios_validar';       // Nome da tabela onde os usuбrios sгo salvos


// Verifica se precisa fazer a conexгo com o MySQL

if ($_SG['conectaServidor'] == true) {

$_SG['link'] = mysql_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or die("MySQL: Nгo foi possнvel conectar-se ao servidor [".$_SG['servidor']."].");

mysql_select_db($_SG['banco'], $_SG['link']) or die("MySQL: Nгo foi possнvel conectar-se ao banco de dados [".$_SG['banco']."].");

}

// Verifica se precisa iniciar a sessгo



 

/**

* Funзгo que valida um usuбrio e senha

*

* @param string $usuario - O usuбrio a ser validado

* @param string $senha - A senha a ser validada

*

* @return bool - Se o usuбrio foi validado ou nгo (true/false)

*/

function validaUsuario($usuario, $senha) {

global $_SG;

 

$cS = ($_SG['caseSensitive']) ? 'BINARY' : '';

 

// Usa a funзгo addslashes para escapar as aspas

$nusuario = addslashes($usuario);

$nsenha = addslashes($senha);

// Monta uma consulta SQL (query) para procurar um usuбrio

$sql = "SELECT `id`, `nome` FROM `".$_SG['tabela']."` WHERE ".$cS." `usuario` = '".$nusuario."' AND ".$cS." `senha` = '".$nsenha."' LIMIT 1";

$query = mysql_query($sql);

$resultado = mysql_fetch_assoc($query);

// Verifica se encontrou algum registro

if (empty($resultado)) {

// Nenhum registro foi encontrado => o usuбrio й invбlido

return false;
 

} else {

// O registro foi encontrado => o usuбrio й valido

 

// Definimos dois valores na sessгo com os dados do usuбrio

$_SESSION['usuarioID'] = $resultado['id']; // Pega o valor da coluna 'id do registro encontrado no MySQL

$_SESSION['usuarioNome'] = $resultado['nome']; // Pega o valor da coluna 'nome' do registro encontrado no MySQL


// Verifica a opзгo se sempre validar o login

if ($_SG['validaSempre'] == true) {

// Definimos dois valores na sessгo com os dados do login

$_SESSION['usuarioLogin'] = $usuario;

$_SESSION['usuarioSenha'] = $senha;

}

 

return true;

}

}

 

/**

* Funзгo que protege uma pбgina

*/

function protegePagina() {

global $_SG;

 

if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {

// Nгo hб usuбrio logado, manda pra pбgina de login

expulsaVisitante();

} else if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {

// Hб usuбrio logado, verifica se precisa validar o login novamente

if ($_SG['validaSempre'] == true) {

// Verifica se os dados salvos na sessгo batem com os dados do banco de dados

if (!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])) {

// Os dados nгo batem, manda pra tela de login

expulsaVisitante();

}

}

}

}

 

/**

* Funзгo para expulsar um visitante

*/

function expulsaVisitante() {

global $_SG;

 

// Remove as variбveis da sessгo (caso elas existam)

unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);

 

// Manda pra tela de login

header("Location: ".$_SG['paginaLogin']);

}


?>