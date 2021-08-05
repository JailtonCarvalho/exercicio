<?php
function somar($valorA, $valorB){
    $valorResultante = $valorA + $valorB;
    return $valorResultante;
}

function subtrair($valorA, $valorB){
    $valorResultante = $valorA - $valorB;
    return $valorResultante;
}
function depositar($valor_dep, $saldo_conta, $opcao){
    
    if($valor_dep <= 0) {
        echo("Digite um valor válido para o depósito");
    } else {
        $saldo_conta = somar($saldo_conta, $valor_dep);
        
        if ($opcao == "poupança"){
            file_put_contents('saldo_cp.txt', $saldo_conta);
        } else {
            file_put_contents('saldo_cc.txt', $saldo_conta);
        }
        echo "Depósito realizado com sucesso, seu saldo agora é $saldo_conta";
    } 
}
function sacar($saldo_conta, $valor_saq, $opcao){
    if($valor_saq > $saldo_conta) {
        echo "Saldo insuficiente";
    } else {
        $saldo_conta = subtrair($saldo_conta, $valor_saq);

        if ($opcao == "poupança"){
            file_put_contents('saldo_cp.txt', $saldo_conta);
        } else {
            file_put_contents('saldo_cc.txt', $saldo_conta);
        }
        echo "Saque realizado com sucesso, seu saldo agora é $saldo_conta";
    }
}

function lerSaldoContaCorrente(){
    return file_get_contents('saldo_cc.txt');    
}
function lerSaldoContaPoupanca(){
    return file_get_contents('saldo_cp.txt');
}

?>