<?php
class ComunicacaoAPI
{

    private $username = 'apiecommerce';
    private $password = 'teste';
    public $token;

    public function getToken($url)
	{
        $json = [
            "login"=> "apiecommerce", 
            "senha" => "1"
        ];

        $data = json_encode($json);

        try {
            //Inicializa cURL para uma URL.
            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Connection: keep-alive'
            ));

            $response = curl_exec($curl);
            //Fecha a conexão
            curl_close($curl);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $resposta = json_decode($response);
        
        if($resposta->sucesso === true){
            $this->token = $resposta->token;
        } else {
            $this->token = 'erro';
        }
        
    }

    public function requestAPI($url, $tpRequisicao, $data = false, $cabecalho = array())
    {
      
        try {
            //Inicializa cURL para uma URL.
            $curl = curl_init($url);
            //Marca que vai enviar por POST(1=SIM), caso tpRequisicao seja igual a "POST"
            switch ($tpRequisicao) {
                case "POST":
                    curl_setopt($curl, CURLOPT_POST, 1);

                    if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    break;
                    break;
                case "PUT":
                    curl_setopt($curl, CURLOPT_PUT, 1);
                    break;
                default:
                    if ($data)
                        $url = sprintf("%s?%s", $url, http_build_query($data));
            }

            //Se foi passado como parâmetro, adiciona o cabeçalho à requisição
            if (!empty($cabecalho)) {
                curl_setopt($curl, CURLOPT_HTTPHEADER, $cabecalho);
            }
          
            //Marca que vai receber string
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            // Optional Authentication:
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_USERPWD, $this->username.":".$this->password);

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($curl, CURLOPT_HEADER, false);

            /*
            Caso você não receba retorno da API, pode estar com problema de SSL.
            Remova o comentário da linha abaixo para desabilitar a verificação.
            */
            //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //Inicia a conexão
            $response = curl_exec($curl);
            //Fecha a conexão
            curl_close($curl);

            var_dump($response);

            $resposta = json_decode($response);

            var_dump($resposta);

            if (isset($resposta->status) && $resposta->status === 401) {

                $this->getToken('http://sacprx.poweredbyclear.com:8080/ecommerceapi/v1/autenticacao/entrar');

                $_SESSION['token_api'] = $this->token;

                //$this->requestAPI($url, $tpRequisicao, $data = false, $cabecalho = array());
            } 

        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $response;
    }

    public function getProdutoTodos() 
    {

        $endpoint = 'http://sacprx.poweredbyclear.com:8080/ecommerceapi/v1/produto/estoquepreco';
        $header = [
                'Content-Type: application/json',
                'Authorization: Space:' . $this->token,
                'Connection: keep-alive'
            ];
        $data = false;

        $produtos = $this->requestAPI($endpoint, 'GET', $data, $header);
       
        return $produtos;
    }

    public function getProduto($idproduto) 
    {

        $endpoint = 'http://sacprx.poweredbyclear.com:8080/ecommerceapi/v1/produto/' . $idproduto;
        $header = [
                'Content-Type: application/json',
                'Authorization: Space:' . $this->token,
                'Connection: keep-alive'
            ];
        $data = false;

        $produto = $this->requestAPI($endpoint, 'GET', $data, $header);

        return $produto;
    }

    public function getProdutoEstoque($idproduto) {
        $endpoint = 'http://sacprx.poweredbyclear.com:8080/ecommerceapi/v1/produto/' . $idproduto . '/estoquepreco';
        
        $header = [
            'Content-Type: application/json',
            'Authorization: Space:' . $this->token,
            'Connection: keep-alive'
        ];
        $data = false;

        $produto = $this->requestAPI($endpoint, 'GET', $data, $header);
      
        return $produto;
    }

    public function getCliente($cliente) 
    {
        //BUSCAR SITUACAO DO CLIENTE
        $cliente = 'testeIV@teste.com';

        $endpoint = 'http://sacprx.poweredbyclear.com:8080/ecommerceapi/v1/cliente/' . $cliente . '/situacao';
        $header = [
            'Content-Type: application/json',
            'Authorization: Space:' . $this->token,
            'Connection: keep-alive'
        ];

        $data = false;

        $cliente = $this->requestAPI($endpoint, 'GET', [], $header);

        return $cliente;
    }

    public function setPedido($data) {
        $endpoint = 'http://sacprx.poweredbyclear.com:8080/ecommerceapi/v1/pedido';
                     
        $header = [
            'Content-Type: application/json',
            'Authorization: Space:' . $this->token,
            'Connection: keep-alive'
        ];
        
        $pedido = $this->requestAPI($endpoint, 'POST', $data, $header);

        return $pedido;
    }
}