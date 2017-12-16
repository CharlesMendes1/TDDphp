<?php 

use PHPUnit\Framework\TestCase;
require_once"CriaLeilao.php";

final class LanceTest extends TestCase{
	/**
     * @expectedException     Exception
     */
	public function testLancesQueSaoMenorOuIgualAZero(){
		
		$criador = new CriaLeilao();
		$leilao = $criador->para("Playstation 3 Novo")->lance("jose",-2)->constroi();

	}
}


 ?>