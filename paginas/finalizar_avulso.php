<?php

if(@$_SESSION['cliente'] != '' && isset($_SESSION['pecas'])) {
		$name = $_SESSION['nome_cliente'];
		$mail = $_SESSION['email_cliente'];

		$dadospedido['tbpedido_avulso']['cliente_id'] = $_SESSION['cliente'];
		$dadospedido['tbpedido_avulso']['data_pedido'] =  date('Y-m-d');
		$dadospedido['tbpedido_avulso']['status_pedido'] = 0;

		$idPedido = $conecta->inserirID($dadospedido);

		$date = date("d/m/Y h:i");

			// FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)
			$assunto =  "Pedido de Orçamento de Peças Avulsas";
			$cabecalho_da_mensagem_original="From: $mail\n";
			$configuracao_da_mensagem_original="<strong>Orçamento ".$rs_configuracao['nomeloja'].":</strong><br>
			<br>
			De: ".$name."<br>
			Responder para: ".$mail."<br>
			Assunto: Pedido de Orçamento de Peças Avulsas<br>
			<br>
			<strong>Peças Solicitadas:</strong><br>
			<br>
			<table width='100%' border='1'>
			  <tr>
				<td>Nome</td>
				<td>Quantidade</td>
				<td>Observação</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>";
			  $i = 0;
			foreach($_SESSION['pecas'] as $peca):
			  $configuracao_da_mensagem_original.="<tr>
				<td>".$peca['name']."</td>
				<td>".$peca['quantity']."</td>
				<td>".$peca['message']."</td>
			  </tr>";


			$dadosproduto['tbpecas_avulsas']['pedido_avulso_id'] = $idPedido;
			$dadosproduto['tbpecas_avulsas']['nome'] = $peca['name'];
			$dadosproduto['tbpecas_avulsas']['quantidade'] = $peca['quantity'];
			$dadosproduto['tbpecas_avulsas']['observacao'] = $peca['message'];

			$idPedidoProduto = $conecta->inserir($dadosproduto);

			  $i++;
			endforeach;
			$configuracao_da_mensagem_original.="</table><br>
			<br>
			Enviada em $date por:<br>
			<br>
			Industria Sacramento
			
			";

			//ENVIO DE MENSAGEM ORIGINAL
			$headers = "$cabecalho_da_mensagem_original";
			$headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";

			if(mail($rs_configuracao['emailloja'],$assunto,$configuracao_da_mensagem_original,$headers)){

				echo '<!-- Pedido recebido com sucesso -->
					<section class="page-section" style="padding-top: 0">
						<div class="container">
							<h3>Sue pedido de Orçamento de peças avulsas foi recebido com sucesso!<br/>Em breve iremos entrar em contato para lhe enviar a sua Orçamento!</h3>
							<p>Obrigado por escolher a '.$rs_configuracao['nomeloja'].'!</p>
						</div>
					</section>

		<!-- /Pedido Recebido com sucesso -->';

				//CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
				$assunto_da_mensagem_de_resposta = "Recebemos seu pedido de Orçamento de peças avulsas";
				$cabecalho_da_mensagem_de_resposta = "From: ".$rs_configuracao['nomeloja']." <".$rs_configuracao['emailloja'].">\n";
				$configuracao_da_mensagem_de_resposta="Prezado(a) ".$name.",<br>
				Obrigado por entrar em contato, sue pedido de Orçamento foi enviada para ".$rs_configuracao['nomeloja'].".<br>
				Em breve lhe responderemos.<br>
				<br>
				Atenciosamente,<br>
				".$rs_configuracao['nomeloja']."<br>
				<br>
				<a href='".$rs_configuracao['linkloja']."'>".$rs_configuracao['linkloja']."</a><br>
<br>
Recebido em: $date<br>
				Industria Sacramento
				
				";

				//ENVIO DE MENSAGEM RESPOSTA
				$headers = "$cabecalho_da_mensagem_de_resposta";
				$headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";

				mail($mail,$assunto_da_mensagem_de_resposta,$configuracao_da_mensagem_de_resposta,$headers);


				unset($_SESSION['pecas'], $dadospedido, $dadosproduto);


			} else {
				echo '<div class="alert alert-danger">Problema ao enviar Pedido!</div>';
			}

} else {
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="ModalLabelL">Por favor, entre na sua conta</h4>
        </div>
        <div class="modal-body">
            <p>  </p>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Email</label>
                    <input id="txtEmail" class="form-control" name="email" required="required" type="email" placeholder="">
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input id="txtPassword" class="form-control" name="senha" required="required" type="password" placeholder="">
                </div>
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-success pull-right" type="submit" name="entrar" value="Login">Entrar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <p>Esqueceu a senha? <a href="#" data-toggle="modal" data-target="#ModalLembrar">Clique aqui para recupera-la.</a></p><br />
<p><a href="#" data-toggle="modal" data-target="#ModalRegister">Cadastra-se</a></p>
        </div>
    </div>
</div>

<?php
}
?>
