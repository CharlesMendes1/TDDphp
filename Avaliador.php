<?php 
class Avaliador{
	private $maiorValor = -INF;
	private $menorValor = INF;
	private $media = 0;
	private $tresMaiores;
	public function avalia(Leilao $leilao){

		if(count($leilao->getLances()) <= 0) {
            throw new Exception("Um leilão precisa ter pelo menos um lance");
        }

		$total = 0;
		foreach($leilao->getLances() as $lance){
			if($lance->getValor() > $this->maiorValor){
				$this->maiorValor = $lance->getValor();
			}
			if($lance->getValor() < $this->menorValor){
				$this->menorValor = $lance->getValor();
			}

			$total += $lance->getValor();
		}

		$this->media = $total / count($leilao->getLances());
	}

	public function pegaTresMaioresDo(Leilao $leilao){
		$lances = $leilao->getLances();

		
		usort($lances,function($a, $b){
			if($a->getValor() == $b->getValor()) return 0;
			return ($a->getValor() < $b->getValor()) ? 1 : -1;
		});

		$this->tresMaiores = array_slice($lances, 0, 3);
	}

	public function getMaiorLance(){
	    return $this->maiorValor;
	}
	public function getMenorLance(){
	    return $this->menorValor;
	}
	public function getMediaLance(){
	    return $this->media;
	}
	public function getTresMaioresLances(){
	    return $this->tresMaiores;
	}
	
	

}
	

?>