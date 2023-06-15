<?php
    declare(strict_types = 1);
    abstract class Vehiculo {
        public function __construct(protected String $placa)
        {
            $this->placa = $placa; 
        }

        abstract function getType();
    }

    class Coche extends Vehiculo{
        function getType(){
            return 'Soy un coche';
        }
    }

    class Motocicleta extends Vehiculo{
        function getType(){
            return 'Soy una motocicleta';
        }
    }

    interface ParqueaderoInterface{
        public function estacionar(Vehiculo $vehiculo);
        public function retirar(Vehiculo $vehiculo);
    }

    class Parqueadero implements ParqueaderoInterface{
        public function __construct(public int $vehiculos = 0)
        {
            $this->vehiculos = $vehiculos;
        }

        public function estacionar(Vehiculo $vehiculo){
            return $this->vehiculos += 1;
        }
        public function retirar(Vehiculo $vehiculo){
            return $this->vehiculos -= 1;
        }
    }

    $_DATA = json_decode(file_get_contents('php://input'), true);
    $coche1 = new Coche($_DATA['placa1']);
    $motomoto = new Motocicleta($_DATA['placa2']);
    $parqueadero1 = new Parqueadero($_DATA['vehiculos']);
    print_r('Sale un carro: ' . $parqueadero1->retirar($coche1));
    echo '<br>';
    print_r('Sale una moto: ' . $parqueadero1->retirar($motomoto));
    echo '<br>';
    print_r('Vehiculos actualmente estacionados: ' . $parqueadero1->vehiculos);
    


?>