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
            "senha" => "teste"
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

            $resposta = json_decode($response);

            if (isset($resposta->status) && $resposta->status === 401) {

                var_dump($_SESSION['token_api']);
                $this->getToken('http://sistemas.spacearea.com.br/homologacao/ecommerceapi/v1/autenticacao/entrar');

                $_SESSION['token_api'] = $this->token;

                var_dump($_SESSION['token_api']);

                //$this->requestAPI($url, $tpRequisicao, $data = false, $cabecalho = array());
            } 

        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $response;
    }

    public function getProdutoTodos() 
    {

        $endpoint = 'http://sistemas.spacearea.com.br/homologacao/ecommerceapi/v1/produto/estoquepreco';
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

        $endpoint = 'http://sistemas.spacearea.com.br/homologacao/ecommerceapi/v1/produto/' . $idproduto;
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
        $endpoint = 'http://sistemas.spacearea.com.br/homologacao/ecommerceapi/v1/produto/' . $idproduto . '/estoquepreco';
        
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

        $endpoint = 'http://sistemas.spacearea.com.br/homologacao/ecommerceapi/v1/cliente/' . $cliente . '/situacao';
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
        $endpoint = 'http://sistemas.spacearea.com.br/homologacao/ecommerceapi/v1/pedido';
        $header = [
            'Content-Type: application/json',
            'Authorization: Space:' . $this->token,
            'Connection: keep-alive'
        ];
        /*$data = '{
            "numeroOrigem": "222548",
            "enderecoEntrega": {
                "codigo": 0,
                "logradouro": "Rua ingas Entrega II",
                "numero": "127d",
                "cep": "32315120",
                "bairro": "Eldorado",
                "cidade": "Contagem",
                "ufSigla": "MG"
            },
            "enderecoCobranca": {
                "codigo": 0,
                "logradouro": "Rua ingas",
                "numero": "127B",
                "cep": "32315120",
                "bairro": "Eldorado",
                "cidade": "Contagem",
                "ufSigla": "MG"
            },
            "cliente": {
                "codigo": 0,
                "razaoSocial": "Teste de Pedido II",
                "cnpj": "81.834.885/0001-26",
                "inscricaoEstadual": "854.824.949/0257",
                "email": "testeIV@teste.com",
                "tipo": "J",
                "sexo": "M",
                "telefone": "(31) 3198-0201",
                "telefone2": "(31) 3198-0201",
                "celular": "(31) 98422-1313",
                "enderecos": [
                    {
                        "codigo": 0,
                        "logradouro": "Rua ingas",
                        "numero": "127",
                        "cep": "32315120",
                        "bairro": "Eldorado",
                        "cidade": "Contagem",
                        "ufSigla": "MG"
                    }
                ]
            },
            "valorLiquido": 855,
            "valorFrete": 7,
            "observacao": "Entregar a noite",
            "naturezaOperacao": "WEB",
            "valorDesconto": 5.69,
            "dataEmissao": "18/06/2018",
            "horaEmissao": "13:20:30",
            "observacaoFiscal1": "Obs fiscal 1",
            "items": [
                {
                    "produtoCodigo": 98,
                    "quantidade": 10,
                    "valorLiquido": 243.9,
                    "valorUnitario": 24.39,
                    "valorDesconto": 0,
                    "unidade": "DZ",
                    "unidadeQuantidade": 12
                },
                {
                    "produtoCodigo": 100,
                    "quantidade": 10,
                    "valorLiquido": 389.9,
                    "valorUnitario": 38.99,
                    "valorDesconto": 0
                },
                {
                    "produtoCodigo": 102,
                    "quantidade": 11,
                    "valorLiquido": 219.89,
                    "valorUnitario": 19.99,
                    "valorDesconto": 0,
                    "unidade": "UN",
                    "unidadeQuantidade": 1
                }
            ],
            "pagamentos": [
                {
                    "formaPagamento": "boleto",
                    "numeroParcelas": 1,
                    "valorPago": 855
                }
            ]
        }';*/


        $pedido = $this->requestAPI($endpoint, 'POST', $data, $header);

        return $pedido;
    }
}