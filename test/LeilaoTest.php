<?php
use PHPUnit\Framework\TestCase;
require_once"../Usuario.php";
require_once"../Leilao.php";
require_once"../Avaliador.php";
require_once"../Lance.php";
require_once"CriaLeilao.php";
	final class LeilaoTest extends TestCase{
		public function testNaoDeveAceitarDoisLancesSeguidosDoMesmoUsuario() {
		    //$leilao = new Leilao("Macbook Pro 15");

		    $criador = new CriaLeilao();
		    $leilao = $criador->para("Macbook Pro 15")->lance("Jose",2000)->lance("Jose",3000)->constroi();

		    $this->assertEquals(1, count($leilao->getLances()));
		    $this->assertEquals(2000, $leilao->getLances()[0]->getValor(), 0.00001);
		}

		public function testNaoDeveAceitarMaisDoQue5LancesDeUmMesmoUsuario() {
	        $leilao = new Leilao("Macbook Pro 15");

	        $steveJobs = new Usuario("Steve Jobs");
	        $billGates = new Usuario("Bill Gates");

	        $leilao->propoe(new Lance($steveJobs, 2000));
	        $leilao->propoe(new Lance($billGates, 3000));
	        $leilao->propoe(new Lance($steveJobs, 4000));
	        $leilao->propoe(new Lance($billGates, 5000));
	        $leilao->propoe(new Lance($steveJobs, 6000));
	        $leilao->propoe(new Lance($billGates, 7000));
	        $leilao->propoe(new Lance($steveJobs, 8000));
	        $leilao->propoe(new Lance($billGates, 9000));
	        $leilao->propoe(new Lance($steveJobs, 10000));
	        $leilao->propoe(new Lance($billGates, 11000));

	        // deve ser ignorado
	        $leilao->propoe(new Lance($steveJobs, 12000));

	        $this->assertEquals(10, count($leilao->getLances()));
	        $ultimo = count($leilao->getLances()) - 1;
	        $ultimoLance = $leilao->getLances()[$ultimo];
	        $this->assertEquals(11000.0, $ultimoLance->getValor(), 0.00001);
    	}

		public function testDobraLanceAnterior() {
		    $leilao = new Leilao("Macbook Pro 15");

		    $steveJobs = new Usuario("Steve Jobs");
		    $anaJobs = new Usuario("ana Jobs");

		    $leilao->propoe(new Lance($steveJobs, 2000));
		    $leilao->propoe(new Lance($anaJobs, 3000));
		    
		    $leilao->dobraLance($steveJobs);
		    $leilao->dobraLance($anaJobs);

		    $this->assertEquals(4, count($leilao->getLances()));
		    $this->assertEquals(4000, $leilao->getLances()[2]->getValor(), 0.00001);
		    $this->assertEquals(6000, $leilao->getLances()[3]->getValor(), 0.00001);
		}

		public function testNaoDeveDobrarCasoNaoHajaLanceAnterior(){
	        $leilao = new Leilao("Macbook Pro 15");
	        $steveJobs = new Usuario("Steve Jobs");

	        $leilao->dobraLance($steveJobs);

	        $this->assertEquals(0, count($leilao->getLances()));
    	}


	}
?>