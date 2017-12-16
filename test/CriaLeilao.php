<?php 
require_once"../Usuario.php";
require_once"../Leilao.php";
require_once"../Lance.php";

class CriaLeilao{
	private $leilao;

	public function para($descricao){
		$this->leilao = new Leilao($descricao);
		return $this;
	}
	public function lance($usuario,$lance){
		$this->leilao->propoe(new Lance(new Usuario($usuario),$lance));
		return $this;
	}
	public function constroi(){
		return $this->leilao;
	}




}

 ?>