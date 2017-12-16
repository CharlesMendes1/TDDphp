<?php
use PHPUnit\Framework\TestCase;
require_once"../Usuario.php";
require_once"../FiltroDeLances.php";
require_once"../Leilao.php";
require_once"../Avaliador.php";
require_once"../Lance.php";
final class FiltroDeLancesTest extends TestCase {

    public function testDeveSelecionarLancesEntre1000E3000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao,2000);
        $lances[] = new Lance($joao,1000);
        $lances[] = new Lance($joao,3000);
        $lances[] = new Lance($joao,800);

        $resultado = $filtro->filtra($lances);

        $this->assertEquals(1, count($resultado));
        $this->assertEquals(2000, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesEntre500E700() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao,600);
        $lances[] = new Lance($joao,500);
        $lances[] = new Lance($joao,700);
        $lances[] = new Lance($joao,800);

        $resultado = $filtro->filtra($lances);
        $this->assertEquals(1, count($resultado));
        $this->assertEquals(600, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesMaioresQue5000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao,5000);
        $lances[] = new Lance($joao,5001);
        $lances[] = new Lance($joao,5050);
        $lances[] = new Lance($joao,6000);
        $lances[] = new Lance($joao,800);

        $resultado = $filtro->filtra($lances);
        $this->assertEquals(3, count($resultado));
        $this->assertEquals(5001, $resultado[0]->getValor(), 0.00001);
        $this->assertEquals(5050, $resultado[1]->getValor(), 0.00001);
        $this->assertEquals(6000, $resultado[2]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesEntre500a700e1000a3000eMaioresQue5000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao,600);
        $lances[] = new Lance($joao,551);
        $lances[] = new Lance($joao,2100);
        $lances[] = new Lance($joao,9000);

        $resultado = $filtro->filtra($lances);
        $this->assertEquals(4, count($resultado));
        $this->assertEquals(600, $resultado[0]->getValor(), 0.00001);
        $this->assertEquals(551, $resultado[1]->getValor(), 0.00001);
        $this->assertEquals(2100, $resultado[2]->getValor(), 0.00001);
        $this->assertEquals(9000, $resultado[3]->getValor(), 0.00001);
    }

    public function testDeveEliminarMenoresQue500(){
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();

        $lances = [];
        $lances[] = new Lance($joao, 400);
        $lances[] = new Lance($joao, 700);

        $resultado = $filtro->filtra($lances);
        $this->assertEquals(0, count($resultado));
    }

    public function testDeveEliminarEntre3000E5000(){
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();

        $lances = [];
        $lances[] = new Lance($joao, 4000);
        $lances[] = new Lance($joao, 3500);

        $resultado = $filtro->filtra($lances);
        $this->assertEquals(0,count($resultado));
    }
}
?>