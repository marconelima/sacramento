<?php
$sql_banner_cabecalho = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 1 ORDER BY rand()";
$resultado_banner_cabecalho = $conecta->selecionar($conecta->conn, $sql_banner_cabecalho);

$sql_banner_meio = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 2 ORDER BY rand()";
$resultado_banner_meio = $conecta->selecionar($conecta->conn, $sql_banner_meio);

$sql_produto_box1 = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND p.box1 = 1 ORDER BY modificado DESC LIMIT 0,3";
$resultado_produto_box1 = $conecta->selecionar($conecta->conn, $sql_produto_box1);

$sql_produto_box2 = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND p.box2 = 1 ORDER BY modificado DESC LIMIT 0,3";
$resultado_produto_box2 = $conecta->selecionar($conecta->conn, $sql_produto_box2);

$sql_produto_box3 = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND p.box3 = 1 ORDER BY modificado DESC LIMIT 0,3";
$resultado_produto_box3 = $conecta->selecionar($conecta->conn, $sql_produto_box3);


$sql_destaque = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND destaque_home = 1 ORDER BY modificado DESC LIMIT 0,20";
$resultado_destaque = $conecta->selecionar($conecta->conn, $sql_destaque);

$sql_kits = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND kit = 1 ORDER BY modificado DESC LIMIT 0,18";
$resultado_kits = $conecta->selecionar($conecta->conn, $sql_kits);

$sql_praceiro = "SELECT DISTINCT m.* FROM tbprod_marca m INNER JOIN tbproduto p ON p.marca = m.id WHERE m.destaque = 1 ORDER BY rand() ASC";
$resultado_parceiro = $conecta->selecionar($conecta->conn, $sql_praceiro);

$sql_categoria = "SELECT DISTINCT c.* FROM tbprod_categoria c INNER JOIN tbprod_subcategoria sc ON sc.categoria_id = c.id INNER JOIN tbproduto p ON p.subcategoria_id = sc.id ORDER BY rand() LIMIT 0,8";
$resultado_categoria = $conecta->selecionar($conecta->conn, $sql_categoria);

$sql_blog = "SELECT t.*, a.titulo as autor, c.titulo as categoria FROM tbgrupo_noticia t INNER JOIN tbautor a ON a.id = t.autor_id INNER JOIN tbcategoria c ON c.id = t.categoria_id WHERE t.status = 1 ORDER BY t.data DESC LIMIT 0,8";
$resultado_blog = $conecta->selecionar($conecta->conn, $sql_blog);

$sql_depoimento = "SELECT * FROM tbdepoimento WHERE status = 1 ORDER BY rand() DESC, id DESC LIMIT 0,12";
$resultado_depoimento = $conecta->selecionar($conecta->conn, $sql_depoimento);

$sql_fotos = "SELECT f.foto, f.legenda, g.titulo, g.conteudo FROM tbgaleria g INNER JOIN tbfoto f ON f.galeria_id = g.id WHERE g.status = 1 ORDER BY rand() DESC LIMIT 0,12";
$resultado_fotos = $conecta->selecionar($conecta->conn, $sql_fotos);


$where_marca = "";
if (@$marca != '') {
    $where_marca = " AND p.marca = " . $marca;
}

$sql_premium = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 ORDER BY modificado DESC LIMIT 0,18";
$resultado_premium = $conecta->selecionar($conecta->conn, $sql_premium);

$sql_ultimos = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND p.box1 = 1 ORDER BY modificado DESC LIMIT 0,18";
$resultado_ultimos = $conecta->selecionar($conecta->conn, $sql_ultimos);


$sql_banner_esquerda = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 3 ORDER BY rand()";
$resultado_banner_esquerda = $conecta->selecionar($conecta->conn, $sql_banner_esquerda);

$sql_banner_direita = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 4 ORDER BY rand()";
$resultado_banner_direita = $conecta->selecionar($conecta->conn, $sql_banner_direita);

$sql_praceiro2 = "SELECT * FROM tbparceiro WHERE status = 1 ORDER BY rand() ASC";
$resultado_parceiro2 = $conecta->selecionar($conecta->conn, $sql_praceiro2);


$sql_banner_rodape = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 5 ORDER BY rand() LIMIT 0,5";
$resultado_banner_rodape = $conecta->selecionar($conecta->conn, $sql_banner_rodape);



$sql_banner_rodape_logo = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 6 ORDER BY rand() LIMIT 0,5";
$resultado_banner_rodape_logo = $conecta->selecionar($conecta->conn, $sql_banner_rodape_logo);

?>


<section>
    <div class="container">
        <div class="row empresa_mobile">
            <div class="col-12 aempresa">
                <h1>Mais de 25 anos <br />de mercado</h1>
                <h5>A Indústria Sacramento está há mais de 25 anos produzindo e distribuindo produtos de qualidade para mercearias, mercados e supermercados.</h5>
                <img src="/imagens/Forma Foto.png" alt="" title="" />
                <span class="btn-empresa"><a href="https://www.industriasacramento.com.br/quem-somos/10">A Empresa</a></span>
            </div>
        </div>
        <div class="row empresa_computer">
            <div class="col-6 aempresa">
                <img src="/imagens/Forma Foto.png" alt="" title="" />
            </div>
            <div class="col-6 aempresa ">
                <h1>Mais de 25 anos <br />de mercado</h1>
                <h5>A Indústria Sacramento está há mais de 25 anos produzindo e distribuindo produtos de qualidade para mercearias, mercados e supermercados.</h5>

                <span class="btn-empresa"><a href="https://www.industriasacramento.com.br/quem-somos/10">A Empresa</a></span>
            </div>
        </div>

    </div>
</section>
<section>
    <div class="produtos">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-2">
                    <h2>Produtos de qualidade, de alto giro e boa margem para seu negócio lucrar mais!</h2>
                    <h6>São mais de 1.500 produtos no nosso catálogo. Além da nossa linha de fabricação própria de vassouras, rodos, pás de lixo, esfregões, desentupidores, escovas, dentre outros, você também encontra uma gama de produtos de utilidade doméstica.</h6>
                    <div class="input-group mb-3 campo-search">
                        <form action="<?php echo $siteUrl; ?>busca/21" method="post" enctype="multipart/form-data" name="formSearch" style="width: 100%; display: inherit;">

                            <input type="text" name="search" class="form-control" placeholder="Pesquisar por todo o site" aria-label="Pesquisar por todo o site" aria-describedby="button-addon2" style="height: 44px;">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-search" type="submit" id="button-addon2"><img src="/images/iconelupa.png"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="carousel1">
    <div class="container">
        <div class="row">
            <div class="col-12 vitrine">
                <h3>Fabricação Própria</h3>

                <div id="carouselVitrine1" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
                        <div class="row">

                            <?php $i = 0;
                            while ($rs_destaque = mysqli_fetch_array($resultado_destaque)) { ?>
                                <div class="carousel-item <?php if ($i == 0) {
                                                                echo 'active';
                                                            } ?>">
                                    <div class="col-6 col-md-3 produto-vitrine">
                                        <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_destaque['id']; ?>">
                                            <img src="<?php echo $siteUrl . "source/Produtos/" . $rs_destaque['foto']; ?>" alt="<?php echo $rs_destaque['nome']; ?>" title="<?php echo $rs_destaque['nome']; ?>" />
                                            <span class="nomeVitrine"><?php echo $rs_destaque['nome']; ?><br /> <?php echo $rs_destaque['modelo']; ?></span>
                                        </a>
                                    </div>
                                    <?php $rs_destaque = mysqli_fetch_array($resultado_destaque); ?>
                                    <div class="col-6 col-md-3 produto-vitrine">
                                        <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_destaque['id']; ?>">
                                            <img src="<?php echo $siteUrl . "source/Produtos/" . $rs_destaque['foto']; ?>" alt="<?php echo $rs_destaque['nome']; ?>" title="<?php echo $rs_destaque['nome']; ?>" />
                                            <span class="nomeVitrine"><?php echo $rs_destaque['nome']; ?><br /> <?php echo $rs_destaque['modelo']; ?></span>
                                        </a>
                                    </div>
                                </div>
                            <?php $i++;
                            } ?>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselVitrine1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselVitrine1" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12 vitrine vitrine-baixo">
                <h3>Utilidades Domésticas</h3>

                <div id="carouselVitrine2" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
                        <div class="row">
                            <?php $i = 0;
                            while ($rs_destaque = mysqli_fetch_array($resultado_ultimos)) { ?>
                                <div class="carousel-item <?php if ($i == 0) {
                                                                echo 'active';
                                                            } ?>">
                                    <div class="col-6 col-md-3 produto-vitrine">
                                        <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_destaque['id']; ?>">
                                            <img src="<?php echo $siteUrl . "source/Produtos/" . $rs_destaque['foto']; ?>" alt="<?php echo $rs_destaque['nome']; ?>" title="<?php echo $rs_destaque['nome']; ?>" />
                                            <span class="nomeVitrine"><?php echo $rs_destaque['nome']; ?><br /> <?php echo $rs_destaque['modelo']; ?></span>
                                        </a>
                                    </div>
                                    <?php $rs_destaque = mysqli_fetch_array($resultado_ultimos); ?>
                                    <div class="col-6 col-md-3 produto-vitrine">
                                        <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_destaque['id']; ?>">
                                            <img src="<?php echo $siteUrl . "source/Produtos/" . $rs_destaque['foto']; ?>" alt="<?php echo $rs_destaque['nome']; ?>" title="<?php echo $rs_destaque['nome']; ?>" />
                                            <span class="nomeVitrine"><?php echo $rs_destaque['nome']; ?><br /> <?php echo $rs_destaque['modelo']; ?></span>
                                        </a>
                                    </div>
                                </div>
                            <?php $i++;
                            } ?>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselVitrine2" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselVitrine2" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </div>

                <span class="btn-produtos"><a href="https://www.industriasacramento.com.br/catalogo/21">Ver todos os produtos</a></span>
            </div>
        </div>
    </div>
</section>

<section class="carousel2">
    <div class="container">
        <div class="row">
            <div class="col-12 vitrine">
                <h3>Fabricação Própria</h3>

                <div id="carouselVitrine11" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
                        <div class="row">

                            <?php $i = 0;
                            $resultado_destaque = $conecta->selecionar($conecta->conn, $sql_destaque);
                            while ($rs_destaque = mysqli_fetch_array($resultado_destaque)) { ?>
                                <div class="carousel-item <?php if ($i == 0) {
                                                                echo 'active';
                                                            } ?>">
                                    <div class="col-6 col-md-3 produto-vitrine">
                                        <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_destaque['id']; ?>">
                                            <img src="<?php echo $siteUrl . "source/Produtos/" . $rs_destaque['foto']; ?>" alt="<?php echo $rs_destaque['nome']; ?>" title="<?php echo $rs_destaque['nome']; ?>" />
                                            <span class="nomeVitrine"><?php echo $rs_destaque['nome']; ?><br /> <?php echo $rs_destaque['modelo']; ?></span>
                                        </a>
                                    </div>
                                    <?php $rs_destaque = mysqli_fetch_array($resultado_destaque); ?>
                                    <div class="col-6 col-md-3 produto-vitrine">
                                        <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_destaque['id']; ?>">
                                            <img src="<?php echo $siteUrl . "source/Produtos/" . $rs_destaque['foto']; ?>" alt="<?php echo $rs_destaque['nome']; ?>" title="<?php echo $rs_destaque['nome']; ?>" />
                                            <span class="nomeVitrine"><?php echo $rs_destaque['nome']; ?><br /> <?php echo $rs_destaque['modelo']; ?></span>
                                        </a>
                                    </div>
                                    <?php $rs_destaque = mysqli_fetch_array($resultado_destaque); ?>
                                    <div class="col-6 col-md-3 produto-vitrine">
                                        <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_destaque['id']; ?>">
                                            <img src="<?php echo $siteUrl . "source/Produtos/" . $rs_destaque['foto']; ?>" alt="<?php echo $rs_destaque['nome']; ?>" title="<?php echo $rs_destaque['nome']; ?>" />
                                            <span class="nomeVitrine"><?php echo $rs_destaque['nome']; ?><br /> <?php echo $rs_destaque['modelo']; ?></span>
                                        </a>
                                    </div>
                                    <?php $rs_destaque = mysqli_fetch_array($resultado_destaque); ?>
                                    <div class="col-6 col-md-3 produto-vitrine">
                                        <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_destaque['id']; ?>">
                                            <img src="<?php echo $siteUrl . "source/Produtos/" . $rs_destaque['foto']; ?>" alt="<?php echo $rs_destaque['nome']; ?>" title="<?php echo $rs_destaque['nome']; ?>" />
                                            <span class="nomeVitrine"><?php echo $rs_destaque['nome']; ?><br /> <?php echo $rs_destaque['modelo']; ?></span>
                                        </a>
                                    </div>
                                </div>
                            <?php $i++;
                            } ?>


                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselVitrine11" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselVitrine11" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12 vitrine">
                <h3>Utilidades Domésticas</h3>
                <div id="carouselVitrine21" class="carousel slide" data-ride="carousel" style="margin-bottom: 2%;">

                    <div class="carousel-inner">
                        <div class="row">

                            <?php $i = 0;
                            $resultado_ultimos = $conecta->selecionar($conecta->conn, $sql_ultimos);
                            while ($rs_destaque = mysqli_fetch_array($resultado_ultimos)) { ?>
                                <div class="carousel-item <?php if ($i == 0) {
                                                                echo 'active';
                                                            } ?>">
                                    <div class="col-6 col-md-3 produto-vitrine">
                                        <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_destaque['id']; ?>">
                                            <img src="<?php echo $siteUrl . "source/Produtos/" . $rs_destaque['foto']; ?>" alt="<?php echo $rs_destaque['nome']; ?>" title="<?php echo $rs_destaque['nome']; ?>" />
                                            <span class="nomeVitrine"><?php echo $rs_destaque['nome']; ?><br /> <?php echo $rs_destaque['modelo']; ?></span>
                                        </a>
                                    </div>
                                    <?php $rs_destaque = mysqli_fetch_array($resultado_ultimos); ?>
                                    <div class="col-6 col-md-3 produto-vitrine">
                                        <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_destaque['id']; ?>">
                                            <img src="<?php echo $siteUrl . "source/Produtos/" . $rs_destaque['foto']; ?>" alt="<?php echo $rs_destaque['nome']; ?>" title="<?php echo $rs_destaque['nome']; ?>" />
                                            <span class="nomeVitrine"><?php echo $rs_destaque['nome']; ?><br /> <?php echo $rs_destaque['modelo']; ?></span>
                                        </a>
                                    </div>
                                    <?php $rs_destaque = mysqli_fetch_array($resultado_ultimos); ?>
                                    <div class="col-6 col-md-3 produto-vitrine">
                                        <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_destaque['id']; ?>">
                                            <img src="<?php echo $siteUrl . "source/Produtos/" . $rs_destaque['foto']; ?>" alt="<?php echo $rs_destaque['nome']; ?>" title="<?php echo $rs_destaque['nome']; ?>" />
                                            <span class="nomeVitrine"><?php echo $rs_destaque['nome']; ?><br /> <?php echo $rs_destaque['modelo']; ?></span>
                                        </a>
                                    </div>
                                    <?php $rs_destaque = mysqli_fetch_array($resultado_ultimos); ?>
                                    <div class="col-6 col-md-3 produto-vitrine">
                                        <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_destaque['id']; ?>">
                                            <img src="<?php echo $siteUrl . "source/Produtos/" . $rs_destaque['foto']; ?>" alt="<?php echo $rs_destaque['nome']; ?>" title="<?php echo $rs_destaque['nome']; ?>" />
                                            <span class="nomeVitrine"><?php echo $rs_destaque['nome']; ?><br /> <?php echo $rs_destaque['modelo']; ?></span>
                                        </a>
                                    </div>
                                </div>
                            <?php $i++;
                            } ?>

                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselVitrine21" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselVitrine21" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </div>
                <span class="btn-produtos"><a href="https://www.industriasacramento.com.br/catalogo/21">Ver todos os produtos</a></span>

            </div>

        </div>
    </div>
</section>

<section class="backimgcinza">

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5 offset-md-1 redes">
                <h4>Siga nas <br />Redes Sociais</h4>
                <h7>Conecte-se conosco nas redes sociais e acompanhe nossos lançamentos e ofertas. Lá compartilhamos também conteúdos que vão facilitar seu dia a dia nos trabalhos domésticos!</h7>
                <div class="row mt-5 mb-2 icones_redes">
                    <div class="col-0 col-md-7"></div>
                    <div class="col-6 col-md-3 text-center colorbranco"><?php if ($rs_configuracao['instagram'] != '') { ?><a href="<?php echo $rs_configuracao['instagram']; ?>" target="_blank"><img src="/images/instagram.png"></a><?php } ?></div>
                    <div class="col-6 col-md-2 text-center colorbranco"><?php if ($rs_configuracao['facebook'] != '') { ?><a href="<?php echo $rs_configuracao['facebook']; ?>" target="_blank"><img src="/images/facebook.png"></a><?php } ?></div>

                </div>
            </div>
            <div class="col-12 col-md-6 box_foto_insta">
                <div class="row mb-5 plugininsta" style="background:url('/imagens/imagem_rede.png'); background-repeat:no-repeat; background-size:contain; background-position:center; 1;;;">
                    <div id="insta"></div>
                </div>

            </div>
        </div>
    </div>

</section>

<section class="backcinza">

    <div class="container">
        <div class="row">
            <div class="col-12 vitrine parceiros backcinza">
                <h9>Parceiros</h9>

                <div id="carouselParceiros" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
                        <div style="background: #FFF;
    padding: 15px;
    border-radius: 15px;
    width: 100%;
    margin: 0;" class="row align-items-center">

                            <?php $i = 0;
                            while ($rs_destaque = mysqli_fetch_array($resultado_parceiro2)) { ?>
                                <div class="carousel-item <?php if ($i == 0) {
                                                                echo 'active';
                                                            } ?>">
                                    <div class="col-4 col-md-2 produto-vitrine mx-auto text-center d-flex justify-content-center">
                                        <a href="<?php echo $rs_destaque['link'] ?>" target="_blank"><img src="<?php echo $rs_destaque['arquivo']; ?>" height="40" class="img-responsive" alt="" title="" /></a>
                                    </div>
                                    <?php $rs_destaque = mysqli_fetch_array($resultado_parceiro2);
                                    if ($rs_destaque['arquivo'] != '') { ?>
                                        <div class="col-4 col-md-2 produto-vitrine mx-auto text-center d-flex justify-content-center">
                                            <a href="<?php echo $rs_destaque['link'] ?>" target="_blank"><img src="<?php echo $rs_destaque['arquivo']; ?>" height="40" class="img-responsive" alt="" title="" /></a>
                                        </div>
                                    <?php }
                                    $rs_destaque = mysqli_fetch_array($resultado_parceiro2);
                                    if ($rs_destaque['arquivo'] != '') { ?>
                                        <div class="col-4 col-md-2 produto-vitrine mx-auto text-center d-flex justify-content-center">
                                            <a href="<?php echo $rs_destaque['link'] ?>" target="_blank"><img src="<?php echo $rs_destaque['arquivo']; ?>" height="40" class="img-responsive" alt="" title="" /></a>
                                        </div>
                                    <?php }
                                    $rs_destaque = mysqli_fetch_array($resultado_parceiro2);
                                    if ($rs_destaque['arquivo'] != '') { ?>
                                        <div class="col-4 col-md-2 produto-vitrine mx-auto text-center d-flex justify-content-center desktop">
                                            <a href="<?php echo $rs_destaque['link'] ?>" target="_blank"><img src="<?php echo $rs_destaque['arquivo']; ?>" height="40" class="img-responsive" alt="" title="" /></a>
                                        </div>
                                    <?php }
                                    $rs_destaque = mysqli_fetch_array($resultado_parceiro2);
                                    if ($rs_destaque['arquivo'] != '') { ?>
                                        <div class="col-4 col-md-2 produto-vitrine mx-auto text-center d-flex justify-content-center desktop">
                                            <a href="<?php echo $rs_destaque['link'] ?>" target="_blank"><img src="<?php echo $rs_destaque['arquivo']; ?>" height="40" class="img-responsive" alt="" title="" /></a>
                                        </div>
                                    <?php }
                                    $rs_destaque = mysqli_fetch_array($resultado_parceiro2);
                                    if ($rs_destaque['arquivo'] != '') { ?>
                                        <div class="col-4 col-md-2 produto-vitrine mx-auto text-center d-flex justify-content-center desktop">
                                            <a href="<?php echo $rs_destaque['link'] ?>" target="_blank"><img src="<?php echo $rs_destaque['arquivo']; ?>" height="40" class="img-responsive" alt="" title="" /></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php $i++;
                            } ?>


                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselParceiros" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselParceiros" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</section>