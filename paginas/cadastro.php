<?php
if (isset($_SESSION['cliente']) && @$_SESSION['cliente'] != '') {
    $sql_cliente = "SELECT * FROM tbcliente WHERE id = " . $_SESSION['cliente'];
    $resultado_cliente = $conecta->selecionar($conecta->conn, $sql_cliente);
    $rs_cliente = mysqli_fetch_array($resultado_cliente);
}

?>

<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
    <div class="container">
        <h2 class="section-title"><?php echo $rs_tela['nome']; ?></h2>
        <!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl; ?>">Home</a></li>
			<li class="active">Produtos</li>
		</ul><!-- /.breadcrumb -->
        <!-- /Breadcrumbs -->
    </div>
</section>
<!-- /Header and Breadcrumbs  -->

</header><!-- /.header -->
<!-- /Header -->

<div class="content-area content content_corpo">

    <section class="page-section with-sidebar sidebar-right no-top-padding" style="background: #f3f8fa;">
        <div class="container" style="padding:0;">
            <div class="row rowteste">

                <div class="side_busca col-12 menubusca" style="float:left;">



                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" required="required" id="regName" class="form-control" name="regname" value="<?php echo @$rs_cliente['nome']; ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" required="required" id="regEmail" class="form-control" value="<?php echo @$rs_cliente['email']; ?>" name="regemail" placeholder="">
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Senha</label>
                                <input type="password" id="regPassword" class="form-control" value="" name="regpassword" placeholder="" onchange="form.regrepeatpassword.pattern = this.value;">
                            </div>
                            <div class="form-group col-6">
                                <label>Repetir a Senha</label>
                                <input type="password" id="regRepeatPassword" class="form-control" value="" name="regrepeatpassword" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  col-12 col-md-4">
                                <label>Tipo Documento</label>
                                <input type="radio" name="tipodocumento2" class="tipodocumento2" id="tipodocumentocpf2" value="CPF" <?php if(@$rs_cliente['tipodocumento'] == 'cpf'){ echo "CHECKED"; } ?> />&nbsp;CPF&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="tipodocumento2" class="tipodocumento2" id="tipodocumentocnpj2" value="CNPJ" <?php if(@$rs_cliente['tipodocumento'] == 'cnpj'){ echo "CHECKED"; } ?> />&nbsp;CNPJ
                            </div>
                            <div class="form-group  col-12 col-md-4">
                                <label>CPF / CNPJ</label>
                                <input class="form-control" required="required" name="cnpj" id="nucnpj2" value="<?php echo @$rs_cliente['cnpj']; ?>" placeholder="">
                            </div>
                            <div class="form-group col-12 col-md-4" id="inscricaoest2" <?php if(@$rs_cliente['tipodocumento'] == 'cnpj'){ ?>style="display: block;" <?php }  else { ?> style="display: none;" <?php } ?> >
                                <label>Inscrição Estadual</label>
                                <input class="form-control" name="inscricaoestadual" id="inscricaoestadual2" value="<?php echo @$rs_cliente['inscricaoestadual']; ?>" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  col-6">
                                <label>DDD + Telefone</label>
                                <input class="form-control" required="required" value="<?php echo @$rs_cliente['telefone']; ?>" name="regphone" id="phone" placeholder="">
                            </div>

                            <div class="form-group  col-6">
                                <label>DDD + Celular</label>
                                <input class="form-control" required="required" value="<?php echo @$rs_cliente['celular']; ?>" name="regcellphone" id="cellphone" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  col-8">
                                <label>Logradouro</label>
                                <input type="text" id="logradouro" required="required" class="form-control" value="<?php echo @$rs_cliente['logradouro']; ?>" name="logradouro" placeholder="">
                            </div>

                            <div class="form-group  col-4">
                                <label>Número</label>
                                <input type="text" id="numero" required="required" class="form-control" value="<?php echo @$rs_cliente['numero']; ?>" name="numero" placeholder="">
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group  col-6">
                                <label>Bairro</label>
                                <input type="text" id="bairro" required="required" class="form-control" value="<?php echo @$rs_cliente['bairro']; ?>" name="bairro" placeholder="">
                            </div>

                            <div class="form-group  col-6">
                                <label>CEP</label>
                                <input type="text" id="cep" required="required" class="form-control" value="<?php echo @$rs_cliente['cep']; ?>" name="cep" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  col-6">
                                <label>Cidade</label>
                                <input type="text" id="regCity-Estate" required="required" class="form-control" value="<?php echo @$rs_cliente['cidade']; ?>" name="regcidade" placeholder="">
                            </div>

                            <div class="form-group  col-6">
                                <label>Estado</label>
                                <input type="text" id="estado" required="required" class="form-control" value="<?php echo @$rs_cliente['estado']; ?>" name="estado" placeholder="">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="fechar btn btn-secondary pull-right" style='border-radius:9rem !important; padding: .175rem 1.75rem !important; float:right;' data-dismiss="modal" aria-hidden="true">Voltar para o login</button>
                                <button class="btn btn-primary pull-right" style='border-radius:9rem !important; padding: .175rem 1.75rem !important; margin-left:5px!important; float: right;' type="submit" name="alterarcadastrar" value="cadastrar">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>



    <div class="modal"></div>