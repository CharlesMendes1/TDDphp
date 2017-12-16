<?php
	class Leilao {
		private $descricao;
		private $lances;
		
		function __construct($descricao) {
			$this->descricao = $descricao;
			$this->lances = [];
		}
		
		public function propoe(Lance $lance) {
			$total = 0;
			foreach($this->lances as $lanceGuardado){
				if($lanceGuardado->getUsuario()->getNome() == $lance->getUsuario()->getNome()){
					$total ++;
				}
			}
			
			if((count($this->lances) == 0) || ($this->ultimoLance()->getUsuario()->getNome() != $lance->getUsuario()->getNome() && $total < 5)){
				$this->lances[] = $lance;
		
			}
		}

		public function dobraLance(Usuario $usuario){
			foreach($this->lances as $lance){
				if($lance->getUsuario()->getNome() == $usuario->getNome()){
					$this->propoe(new Lance($usuario,($lance->getValor()) * 2));
				}
			}
		}
		private function ultimoLance(){
			return $this->lances[count($this->lances)-1];
		}
		public function getDescricao() {
			return $this->descricao;
		}

		public function getLances() {
			return $this->lances;
		}
	}
?>