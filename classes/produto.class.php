<?php
class Produto{
	private $id;
	private $nome;
	private $referencia;
	private $marca;
	private $modelo;
	private $preco;
	private $descricao;
	private $foto;
	private $quantidade;
	private $peso;
	private $altura;
	private $comprimento;
	private $largura;
	private $complemento;
	private $medida;
    private $codigo;

	public function Produto($id, $nome, $referencia, $marca, $modelo, $preco, $descricao, $foto, $quantidade=1, $peso, $altura, $comprimento, $largura, $complemento, $medida, $codigo){
		$this->id = $id;
		$this->nome = $nome;
		$this->referencia = $referencia;
		$this->marca = $marca;
		$this->modelo = $modelo;
		$this->preco = $preco;
		$this->descricao = $descricao;
		$this->foto = $foto;
		$this->quantidade = $quantidade;
		$this->peso = $peso;
		$this->altura = $altura;
		$this->comprimento = $comprimento;
		$this->largura = $largura;
		$this->complemento = $complemento;
		$this->medida = $medida;
        $this->codigo = $codigo;
	}

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function getReferencia() {
		return $this->referencia;
	}
	public function setReferencia($referencia) {
		$this->referencia = $referencia;
	}

	public function getMarca() {
		return $this->marca;
	}
	public function setMarca($marca) {
		$this->marca = $marca;
	}

	public function getModelo() {
		return $this->modelo;
	}
	public function setModelo($modelo) {
		$this->modelo = $modelo;
	}

	public function getPreco() {
		return $this->preco;
	}
	public function setPreco($preco) {
		$this->preco = $preco;
	}

	public function getDescricao() {
		return $this->descricao;
	}
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}

	public function getFoto() {
		return $this->foto;
	}
	public function setFoto($foto) {
		$this->foto = $foto;
	}

	public function getQuantidade() {
		return $this->quantidade;
	}
	public function setQuantidade($quantidade) {
		$this->quantidade = $quantidade;
	}

	public function getPeso() {
		return $this->peso;
	}
	public function setPeso($peso) {
		$this->peso = $peso;
	}

	public function getAltura() {
		return $this->altura;
	}
	public function setAltura($altura) {
		$this->altura = $altura;
	}

	public function getComprimento() {
		return $this->comprimento;
	}
	public function setComprimento($comprimento) {
		$this->comprimento = $comprimento;
	}

	public function getLargura() {
		return $this->largura;
	}
	public function setLargura($largura) {
		$this->largura = $largura;
	}

	public function getComplemento() {
		return $this->complemento;
	}
	public function setComplemento($complemento) {
		$this->complemento = $complemento;
	}

	public function getMedida() {
		return $this->medida;
	}
	public function setMedida($medida) {
		$this->medida = $medida;
	}
    public function getCodigo()
    {
        return $this->codigo;
    }
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }
}
?>
