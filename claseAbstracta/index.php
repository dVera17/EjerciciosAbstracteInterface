<?php
declare(strict_types = 1);

abstract class CuentaBancaria{
    public function __construct(protected float $saldo){
        $this->saldo = $saldo;
    }

    abstract public function depositar(float $monto);
    abstract public function retirar(float $monto);

}

class CuentaCorriente extends CuentaBancaria{
    public function depositar(float $monto){
        return $this->saldo += $monto;
    }

    public function retirar(float $monto){
        return ($monto > $this->saldo) ? $this->saldo-=($monto + ($monto*0.10)) : $this->saldo-=$monto;
    }
}

class CuentaAhorro extends CuentaBancaria{
    public function depositar(float $monto){
        return $this->saldo += $monto;
    }

    public function retirar(float $monto){
        if($monto > $this->saldo) echo 'Saldo Insuficiente!';
        else{
            $this->saldo -= $monto;
            echo 'Saldo Actual: ' . $this->saldo;
        }
    }
}

$_DATA = json_decode(file_get_contents('php://input'), true);
$obj = new CuentaAhorro($_DATA['saldo']);
var_dump($obj);
echo $obj->retirar(50);

?>