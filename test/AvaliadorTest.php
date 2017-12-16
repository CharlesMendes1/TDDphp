<?php
//require_once 'PHPUnit/Autoload.php';
//require_once ('PHPUnit/Framework/TestCase.php');
use PHPUnit\Framework\TestCase;
require_once"../Usuario.php";
require_once"../Leilao.php";
require_once"../Avaliador.php";
require_once"../Lance.php";
require_once"CriaLeilao.php";

final class AvaliadorTest extends TestCase{
//class AvaliadorTest extends PHPUnit_Framework_TestCase{

	public function testDeveVerificarLancesEmOrdemDecrescente(){
		$jose = new Usuario("Jóse",1);
		$ana = new Usuario("Ana",2);
		$marcos = new Usuario("Marcos",3);

		$leilao = new Leilao("Violao do Justin Bieber");


		$leilao->propoe(new Lance($marcos,500.0));
		$leilao->propoe(new Lance($ana,400.0));
		$leilao->propoe(new Lance($jose,300.0));
		
		

		$leiloeiro = new Avaliador();
		$leiloeiro->avalia($leilao);

		// comparando a saida com o esperado
        $maiorEsperado = 500;
        $menorEsperado = 300;

        $this->assertEquals($maiorEsperado,$leiloeiro->getMaiorLance());
        $this->assertEquals($menorEsperado,$leiloeiro->getMenorLance());
        $this->assertEquals(400,$leiloeiro->getMediaLance(), 0.000001);

	}

	public function testDeveVerificarLancesEmOrdemCrescente(){
		$jose = new Usuario("Jóse",1);
		$ana = new Usuario("Ana",2);
		$marcos = new Usuario("Marcos",3);

		$leilao = new Leilao("Violao do Justin Bieber");

		$leilao->propoe(new Lance($jose,300.0));
		$leilao->propoe(new Lance($ana,400.0));
		$leilao->propoe(new Lance($marcos,500.0));
		
		
		
		

		$leiloeiro = new Avaliador();
		$leiloeiro->avalia($leilao);

		// comparando a saida com o esperado
        $maiorEsperado = 500;
        $menorEsperado = 300;

        $this->assertEquals($maiorEsperado,$leiloeiro->getMaiorLance());
        $this->assertEquals($menorEsperado,$leiloeiro->getMenorLance());

	}

	public function testDeveAceitarApenasUmLance(){
		$charles = new Usuario("Charles",1);

		$leilao = new Leilao("Nave Espacial de Brinquedo");
		$leilao->propoe(new Lance($charles,2000));

		$leiloeiro = new Avaliador();
		$leiloeiro->avalia($leilao);

		$maiorEsperado = 2000;
        $menorEsperado = 2000;
		
		$this->assertEquals($maiorEsperado,$leiloeiro->getMaiorLance());
        $this->assertEquals($menorEsperado,$leiloeiro->getMenorLance());

	}

	public function testDeveEntenderLeilaoComLancesEmOrdemRandomica(){
	    $joao   = new Usuario("Joao"); 
	    $maria  = new Usuario("Maria"); 

	    $leilao = new Leilao("Playstation 3 Novo");

	    $leilao->propoe( new Lance( $joao , 200.0) );
	    $leilao->propoe( new Lance( $maria, 450.0) );
	    $leilao->propoe( new Lance( $joao , 120.0) );
	    $leilao->propoe( new Lance( $maria, 700.0) );
	    $leilao->propoe( new Lance( $joao , 630.0) );
	    $leilao->propoe( new Lance( $maria, 230.0) );

	    $leiloeiro = new Avaliador();
	    $leiloeiro->avalia($leilao);

	    $this->assertEquals(700.0, $leiloeiro->getMaiorLance(), 0.0001);
	    $this->assertEquals(120.0, $leiloeiro->getMenorLance(), 0.0001);
	}

	public function testPegaOsTresMaioresLances(){
		$charles = new Usuario("Charles",1);
		$ana = new Usuario("Ana",2);
		$leilao = new Leilao("Televisão");

		$leilao->propoe(new Lance($charles,100));
		$leilao->propoe(new Lance($ana,102));
		$leilao->propoe(new Lance($charles,150));
		$leilao->propoe(new Lance($ana,300));
		$leilao->propoe(new Lance($charles,310));

		$leiloeiro = new Avaliador();
		$leiloeiro->pegaTresMaioresDo($leilao);

		$this->assertEquals(3, count($leiloeiro->getTresMaioresLances()));
		$this->assertEquals(310, $leiloeiro->getTresMaioresLances()[0]->getValor());
		$this->assertEquals(300, $leiloeiro->getTresMaioresLances()[1]->getValor());
		$this->assertEquals(150, $leiloeiro->getTresMaioresLances()[2]->getValor());

	}

	public function testDevolver2Lances(){
		$charles = new Usuario("Charles");
		$ana = new Usuario("Ana");
		$leilao = new Leilao("Carro do Batman");
		$leilao->propoe(new Lance($charles,200));
		$leilao->propoe(new Lance($ana,500));

		$leiloeiro= new Avaliador();
		$leiloeiro->pegaTresMaioresDo($leilao);

		$this->assertEquals(2,count($leiloeiro->getTresMaioresLances()));
		$this->assertEquals(500,$leiloeiro->getTresMaioresLances()[0]->getValor());
		$this->assertEquals(200,$leiloeiro->getTresMaioresLances()[1]->getValor());
	}
	
	public function testDevolverNenhumLance(){
		$charles = new Usuario("Charles");
		$ana = new Usuario("Ana");
		$leilao = new Leilao("Carro do Didi");

		$leiloeiro= new Avaliador();
		$leiloeiro->pegaTresMaioresDo($leilao);

		$this->assertEquals(0,count($leiloeiro->getTresMaioresLances()));
	}

	/**
     * @expectedException     Exception
     */
	public function testNaoDeveAvaliarLeiloesSemNenhumLanceDado() {
	    $criador = new CriaLeilao();
	    $leilao = $criador->para("Playstation 3 Novo")->constroi();
	    $leiloeiro= new Avaliador();
	    $leiloeiro->avalia($leilao);
	}

	
}

?>