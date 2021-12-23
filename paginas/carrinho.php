<?php

?>
<script type="text/javascript">
    function submitform() {
        document.formCarrinho.submit();
    }
</script>


<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
    <div class="container">
        <h2 class="section-title">Produtos para Orçamento</h2>
        <!-- Breadcrumbs 

		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl; ?>">Home</a></li>
			<li class="active">Produtos</li>
			<li class="active">Carrinho</li>
		</ul><!-- /.breadcrumb -->
        <!-- /Breadcrumbs -->
    </div>
</section>
<!-- /Header and Breadcrumbs  -->


</header><!-- /.header -->
<!-- /Header -->

<div class="content-area content content_corpo">

    <section class="page-section" id="pecas_avulsas_section">
        <div class="container">
            <div class="row">


                <?php if (@$_SESSION['qtde'] > 0) { ?>
                    <h5 style="margin-bottom:20px;">Selecionar se a quantidade é em Unidade ou em Dúzias</h5>

                    <form method="post" name="formCarrinho" enctype="multipart/form-data" action="<?php echo $siteUrl; ?>finalizar/49">
                        <?php
                        if (@$_SESSION['cliente'] > 0) { 
                            $carrinhoSessao->listar_cotacao_logado();
                        } else {
                            $carrinhoSessao->listar_cotacao();
                        }
                        ?>

                    </form>

                <?php } else {
                    echo "<div class='alert alert-info'>Não existem produtos no seu carrinho</div>";
                }
                $_SESSION["carrinho"] = serialize($carrinhoSessao);
                ?>
            </div>
        </div>
    </section>