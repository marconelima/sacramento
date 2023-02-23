<?php
include "uteis/bancodados.php";

$conecta = new Recordset;
$conecta->conexao();

/*
echo "-- DADOS TABELAS TBBANNER<br/><br/>";

$sql_banner = "SELECT id, arquivo, posicao, situacao, tipo, link, data, status FROM tbbanner ORDER BY id ASC";
$resultado_banner = $conecta->selecionar($sql_banner);

while($rs_banner = mysql_fetch_array($resultado_banner)){
	echo "INSERT INTO tbbanner (id, arquivo, posicao, situacao, tipo, link, data, status) VALUES (".$rs_banner['id'].",'".$rs_banner['arquivo']."',".$rs_banner['posicao'].",".$rs_banner['situacao'].",'".$rs_banner['tipo']."','".$rs_banner['link']."','".$rs_banner['data']."',".$rs_banner['status'].");<br/>";
}

echo "<br/><br/>-- DADOS TABELAS TBCATALOGO<br/><br/>";

$sql_catalogo = "SELECT id, titulo, documento, arquivo, status FROM tbcatalogo ORDER BY id ASC";
$resultado_catalogo = $conecta->selecionar($sql_catalogo);

while($rs_catalogo = mysql_fetch_array($resultado_catalogo)){
	echo "INSERT INTO tbcatalogo (id, titulo, documento, arquivo, status) VALUES (".$rs_catalogo['id'].",'".$rs_catalogo['titulo']."','".$rs_catalogo['documento']."','".$rs_catalogo['arquivo']."',".$rs_catalogo['status'].");<br/>";
}

echo "<br/><br/>-- DADOS TABELAS TBCATEGORIAPRODUTO<br/><br/>";

$sql_categoria = "SELECT id, titulo FROM tbcategoriaproduto ORDER BY id ASC";
$resultado_categoria = $conecta->selecionar($sql_categoria);

while($rs_categoria = mysql_fetch_array($resultado_categoria)){
	echo "INSERT INTO tbcategoriaproduto (id, titulo) VALUES (".$rs_categoria['id'].",'".$rs_categoria['titulo']."');<br/>";
}

echo "<br/><br/>-- DADOS TABELAS TBFORNECEDOR<br/><br/>";

$sql_fornecedor = "SELECT id, titulo, link, arquivo, status FROM tbfornecedor ORDER BY id ASC";
$resultado_fornecedor = $conecta->selecionar($sql_fornecedor);

while($rs_fornecedor = mysql_fetch_array($resultado_fornecedor)){
	echo "INSERT INTO tbcatalogo (id, titulo, link, arquivo, status) VALUES (".$rs_fornecedor['id'].",'".$rs_fornecedor['titulo']."','".$rs_fornecedor['link']."','".$rs_fornecedor['arquivo']."',".$rs_fornecedor['status'].");<br/>";
}

echo "<br/><br/>-- DADOS TABELAS TBFOTOPRODUTO<br/><br/>";

$sql_foto = "SELECT id, produto_id, foto FROM tbfotoproduto ORDER BY id ASC";
$resultado_foto = $conecta->selecionar($sql_foto);

while($rs_foto = mysql_fetch_array($resultado_foto)){
	echo "INSERT INTO tbfotoproduto (id, produto_id, foto) VALUES (".$rs_foto['id'].",".$rs_foto['produto_id'].",'".$rs_foto['foto']."');<br/>";
}

echo "<br/><br/>-- DADOS TABELAS TBGRUPO<br/><br/>";

$sql_grupo = "SELECT id, nome, status FROM tbgrupo ORDER BY id ASC";
$resultado_grupo = $conecta->selecionar($sql_grupo);

while($rs_grupo = mysql_fetch_array($resultado_grupo)){
	echo "INSERT INTO tbgrupo (id, nome, status) VALUES (".$rs_grupo['id'].",'".$rs_grupo['nome']."',".$rs_grupo['status'].");<br/>";
}

echo "<br/><br/>-- DADOS TABELAS TBGRUPO_QUEM<br/><br/>";

$sql_quem = "SELECT id, titulo, conteudo, tela_id, usuario_id, data, status FROM tbgrupo_quem ORDER BY id ASC";
$resultado_quem = $conecta->selecionar($sql_quem);

while($rs_quem = mysql_fetch_array($resultado_quem)){
	echo "INSERT INTO tbgrupo_quem (id, titulo, conteudo, tela_id, usuario_id, data, status) VALUES (".$rs_quem['id'].",'".$rs_quem['titulo']."',<textarea>".$rs_quem['conteudo']."</textarea>,".$rs_quem['tela_id'].",".$rs_quem['usuario_id'].",'".$rs_quem['data']."',".$rs_quem['status'].");<br/>";
}
/*
echo "<br/><br/>-- DADOS TABELAS TBNEWSLETTER<br/><br/>";

$sql_newsletter = "SELECT nome, email, telefone, celular, endereco, cidade, situacao, status FROM tbnewsletter ORDER BY nome ASC";
$resultado_newsletter = $conecta->selecionar($sql_newsletter);

while($rs_newsletter = mysql_fetch_array($resultado_newsletter)){
	echo "INSERT INTO tbnewsletter (nome, email, telefone, celular, endereco, cidade, situacao, status) VALUES ('".$rs_newsletter['nome']."','".$rs_newsletter['email']."','".$rs_newsletter['telefone']."','".$rs_newsletter['celular']."','".$rs_newsletter['endereco']."','".$rs_newsletter['cidade']."','".$rs_newsletter['situacao']."',".$rs_newsletter['status'].");<br/>";
}

echo "<br/><br/>-- DADOS TABELAS TBPERFIL<br/><br/>";

$sql_perfil = "SELECT id, nome, data, status FROM tbperfil ORDER BY id ASC";
$resultado_perfil = $conecta->selecionar($sql_perfil);

while($rs_perfil = mysql_fetch_array($resultado_perfil)){
	echo "INSERT INTO tbperfil (id, nome, data, status) VALUES (".$rs_perfil['id'].",'".$rs_perfil['nome']."','".$rs_perfil['data']."',".$rs_perfil['status'].");<br/>";
}

echo "<br/><br/>-- DADOS TABELAS TBPERMISSAO<br/><br/>";

$sql_permissao = "SELECT tela_id, perfil_id, status FROM tbpermissao ORDER BY tela_id ASC";
$resultado_permissao = $conecta->selecionar($sql_permissao);

while($rs_permissao = mysql_fetch_array($resultado_permissao)){
	echo "INSERT INTO tbpermissao (tela_id, perfil_id, status) VALUES (".$rs_permissao['tela_id'].",'".$rs_permissao['perfil_id']."',".$rs_permissao['status'].");<br/>";
}

*/
echo "<br/><br/>-- DADOS TABELAS TBPRODUTO<br/><br/>";

$sql_produto = "SELECT id,subcategoria_id, nome, marca, modelo, destaque, vendido, fornecedor_id, descricao, especificacao, dados, inclusos, garantia FROM tbproduto ORDER BY id ASC";
$resultado_produto = $conecta->selecionar($sql_produto);

while($rs_produto = mysql_fetch_array($resultado_produto)){
	echo "INSERT INTO tbproduto (id,subcategoria_id, nome, marca, modelo, destaque, vendido, fornecedor_id, descricao, especificacao, dados, inclusos, garantia) VALUES (".$rs_produto['id'].",".$rs_produto['subcategoria_id'].",'".$rs_produto['nome']."','".$rs_produto['marca']."','".$rs_produto['modelo']."','".$rs_produto['destaque']."','".$rs_produto['vendido']."',".$rs_produto['fornecedor_id'].",'".$rs_produto['descricao']."','".$rs_produto['especificacao']."','".$rs_produto['dados']."','".$rs_produto['inclusos']."','".$rs_produto['garantia']."');<br/>";
}
/*
echo "<br/><br/>-- DADOS TABELAS TBROTULO<br/><br/>";

$sql_rotulo = "SELECT id, titulo FROM tbrotulo ORDER BY id ASC";
$resultado_rotulo = $conecta->selecionar($sql_rotulo);

while($rs_rotulo = mysql_fetch_array($resultado_rotulo)){
	echo "INSERT INTO tbrotulo (id, titulo) VALUES (".$rs_rotulo['id'].",'".$rs_rotulo['titulo']."');<br/>";
}


echo "<br/><br/>-- DADOS TABELAS TBSUBCATEGORIAPRODUTO<br/><br/>";

$sql_sub = "SELECT id, titulo, categoria_id FROM tbsubcategoriaproduto ORDER BY id ASC";
$resultado_sub = $conecta->selecionar($sql_sub);

while($rs_sub = mysql_fetch_array($resultado_sub)){
	echo "INSERT INTO tbsubcategoriaproduto (id, titulo, categoria_id) VALUES (".$rs_sub['id'].",'".$rs_sub['titulo']."',".$rs_sub['categoria_id'].");<br/>";
}

echo "<br/><br/>-- DADOS TABELAS TBSUBPRODUTO<br/><br/>";

$sql_subproduto = "SELECT id, produto_id, codigo, caracteristica, preco FROM tbsubproduto ORDER BY id ASC";
$resultado_subproduto = $conecta->selecionar($sql_subproduto);

while($rs_subproduto = mysql_fetch_array($resultado_subproduto)){
	echo "INSERT INTO tbsubproduto (id, produto_id, codigo, caracteristica, preco) VALUES (".$rs_subproduto['id'].",".$rs_subproduto['produto_id'].",'".$rs_subproduto['codigo']."','".$rs_subproduto['caracateristica']."',".$rs_subproduto['preco'].");<br/>";
}

echo "<br/><br/>-- DADOS TABELAS TBTELA<br/><br/>";

$sql_tela = "SELECT id,grupo_id, nome, pagina, tabela, site, ordem, data, status FROM tbtela ORDER BY id ASC";
$resultado_tela = $conecta->selecionar($sql_tela);

while($rs_tela = mysql_fetch_array($resultado_tela)){
	echo "INSERT INTO tbtela (id, grupo_id, nome, pagina, tabela, site, ordem, data, status) VALUES (".$rs_tela['id'].",".$rs_tela['grupo_id'].",'".$rs_tela['nome']."','".$rs_tela['pagina']."','".$rs_tela['tabela']."',".$rs_tela['site'].",".$rs_tela['ordem'].",'".$rs_tela['data']."',".$rs_tela['status'].");<br/>";
}

echo "<br/><br/>-- DADOS TABELAS TBUSUARIO<br/><br/>";

$sql_usuario = "SELECT id, nome, login, email, senha, ativo, perfil_id, datacadastro, status FROM tbusuario ORDER BY id ASC";
$resultado_usuario = $conecta->selecionar($sql_usuario);

while($rs_usuario = mysql_fetch_array($resultado_usuario)){
	echo "INSERT INTO tbusuario (id, nome, login, email, senha, ativo, perfil_id, datacadastro, status) VALUES (".$rs_usuario['id'].",'".$rs_usuario['nome']."','".$rs_usuario['login']."','".$rs_usuario['email']."',".$rs_usuario['senha'].",".$rs_usuario['ativo'].",'".$rs_usuario['perfil_id']."',".$rs_usuario['datacadastro'].",".$rs_usuario['status'].");<br/>";
}
*/
?>