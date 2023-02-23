<?php
class Produto{
	private $id;
	private $nome;
	private $marca;
	private $foto;
	private $tamanho;
	private $cor;
	private $unidade;
	private $quantidade;
	private $codigo;
	private $preco;
	private $idProduto;
	public function Produto($id, $nome, $marca, $foto, $tamanho, $caracteristica, $unidade, $quantidade=1, $codigo, $preco, $idProduto){
		$this->id = $id;
		$this->nome = $nome;
		$this->marca = $marca;
		$this->foto = $foto;
		$this->tamanho = $tamanho;
		$this->caracteristica = $caracteristica;
		$this->unidade = $unidade;
		$this->quantidade = $quantidade;
		$this->codigo = $codigo;
		$this->preco = $preco;
		$this->idProduto = $idProduto;
	}
	public function getQuantidade() {
		return $this->quantidade;
	}
	public function setQuantidade($quantidade) {
		$this->quantidade = $quantidade;
	}
	public function getIdProduto() {
		return $this->idProduto;
	}
	public function setIdProduto($idProduto) {
		$this->idProduto = $idProduto;
	}
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getCodigo() {
		return $this->codigo;
	}
	public function setCodigo($codigo) {
		$this->codigo = $codigo;
	}
	public function getPreco() {
		return $this->preco;
	}
	public function setPreco($preco) {
		$this->preco = $preco;
	}
	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getFoto() {
		return $this->foto;
	}
	public function setFoto($foto) {
		$this->foto = $foto;
	}
	public function getMarca() {
		return $this->marca;
	}
	public function setMarca($marca) {
		$this->marca = $marca;
	}
	public function getTamanho() {
		return $this->tamanho;
	}
	public function setTamanho($tamanho) {
		$this->tamanho = $tamanho;
	}
	public function getCaracteristica() {
		return $this->caracteristica;
	}
	public function setCaracteristica($caracteristica) {
		$this->caracteristica = $caracteristica;
	}
	public function getUnidade() {
		return $this->unidade;
	}
	public function setUnidade($unidade) {
		$this->unidade = $unidade;
	}
}
?>