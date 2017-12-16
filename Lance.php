<?php
	class Lance {
		private $usuario;
		private $valor;
		
		function __construct(Usuario $usuario,$valor) {
			if($valor <= 0){
				throw new Exception("Valor de um lance não pode ser menor ou igual a 0 zero ");	
			}else{
				$this->usuario = $usuario;
				$this->valor = $valor;
			}
			
		}
		
		public function getUsuario() {
			return $this->usuario;
		}
		
		public function getValor() {
			return $this->valor;
		}
	}
?>