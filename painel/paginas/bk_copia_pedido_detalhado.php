$html_pdf = '<div class="table-responsive">
        <table class="table table-hover tabela_ficha">
        	<tr>
            	<td colspan="3" align="center"><strong>CLIENTE</strong></td>
            </tr>
        	<tr>
            	<td colspan="3">'.$rs_cliente['id']." - ".$rs_cliente['nome'].'</td>
            </tr>
            <tr>
            	<td>'.$rs_cliente['email'].'</td>
                <td>'.$rs_cliente['telefone'].'</td>
                <td>'.$rs_cliente['celular'].'</td>
            </tr>
        </table>';
        
        $i = 1; while($rs_endereco = mysqli_fetch_array($resultado_endereco)){ 
        $html_pdf .= '<table class="table table-hover tabela_ficha">
            <tr>
            	<td colspan="3" align="center"><strong>ENDEREÇOS '.$i.'</strong></td>
            </tr>
            <tr>
            	<td colspan="3">'.$rs_endereco['logradouro'].", ".$rs_endereco['numero']." - ".$rs_endereco['complemento'].'</td>
            </tr>
            <tr>
                <td>'.$rs_endereco['bairro'].'</td>
                <td>'.$rs_endereco['cidade'].'</td>
                <td>'.$rs_endereco['estado'].'</td>
            </tr>
            <tr>
                <td>'.$rs_endereco['cep'].'</td>
                <td colspan="2">'.$rs_endereco['referencia'].'</td>
            </tr>
        </table>';
         $i++; }
        $html_pdf .= '</div>';
        
        $html_pdf .= '<div class="table-responsive">
        <table class="table table-hover tabela_ficha">
        	<tr>
            	<td colspan="3" align="center"><strong>PEDIDO</strong></td>
            </tr>
            <tr>
            	<td><strong>Código: '.$rs['id'].'</strong></td>
                <td>'.substr($rs['data_pedido'],8,2)."/".substr($rs['data_pedido'],5,2)."/".substr($rs['data_pedido'],0,4).'</td>
                <td><strong>'.$status_pedido[$rs['status_pedido']].'</strong></td>
            </tr>';
            while($rs_pedido_produto = mysqli_fetch_array($resultado_pedido_produto)){ 
            $html_pdf .= '<tr>
            	<td>'.$rs_pedido_produto['produto']." - ".$rs_pedido_produto['nome'].'</td>
                <td align="center">'.$rs_pedido_produto['quantidade']."x".'</td>
                <td>'.$rs_pedido_produto['cor']." | ".$rs_pedido_produto['tamanho'].'</td>
            </tr>';
            } 
            $html_pdf .= '<tr>
            	<td width="50%"></td>
                <td width="25%" align="right"><strong>Valor do pedido R$ '.number_format($rs['valor_pedido'],2,",",".").'</strong></td>
                <td width="25%" align="right"><strong>Valor do frete R$ '.number_format($rs['valor_frete'],2,",",".").'</strong></td>
            </tr>
        </table>
        </div>';
        
        $html_pdf .= '<div class="table-responsive">
        <table class="table table-hover tabela_ficha">
        	<tr>
            	<td align="center">';
				if($rs['status_pedido'] > 0){ $html_pdf .= '<span class="glyphicon glyphicon-ok" style="color:#090;"></span>'; } 
                $html_pdf .= '</td>';
                $html_pdf .= '<td align="center">';
				if($rs['status_pedido'] > 1){$html_pdf .= '<span class="glyphicon glyphicon-ok" style="color:#090;"></span>'; } 
                $html_pdf .= '</td>';
                $html_pdf .= '<td align="center">';
				if($rs['status_pedido'] > 2){$html_pdf .= '<span class="glyphicon glyphicon-ok" style="color:#090;"></span>'; } 
                $html_pdf .= '</td>';
                $html_pdf .= '<td align="center">';
				if($rs['status_pedido'] > 3){$html_pdf .= '<span class="glyphicon glyphicon-ok" style="color:#090;"></span>'; } 
                $html_pdf .= '</td>';
                $html_pdf .= '<td align="center">';
				if($rs['status_pedido'] > 4){$html_pdf .= '<span class="glyphicon glyphicon-ok" style="color:#090;"></span>'; } 
                $html_pdf .= '</td>';
                $html_pdf .= '<td align="center">';
				if($rs['status_pedido'] > 5){$html_pdf .= '<span class="glyphicon glyphicon-ok" style="color:#090;"></span>'; } 
                $html_pdf .= '</td>';
                
            $html_pdf .= '<tr>
            <tr>
            	<td align="center">'.$status_pedido[1].'</td>
                <td align="center">'.$status_pedido[2].'</td>
                <td align="center">'.$status_pedido[3].'</td>
                <td align="center">'.$status_pedido[4].'</td>
                <td align="center">'.$status_pedido[5].'</td>
                <td align="center">'.$status_pedido[6].'</td>
            <tr>
        </table>
        </div>';