<?php
require ('funcoes.php');

$saldo_corrente = lerSaldoContaCorrente();
$saldo_poupanca = lerSaldoContaPoupanca();


$opcao = $_POST['opcao'];
$operacao = $_POST['operacao'];

switch ($operacao) {
    case 'saque':
        $valor_saque = $_POST['valor_saque'];
        break;
    case 'deposito':
        $valor_deposito = $_POST['valor_deposito'];
        break;
    default:
        throw new Exception("Error Processing Request", 1);
        
        break;
}


// Informações para operação em conta poupança.
    if ($opcao == "poupança"){
        switch ($operacao) {
            case 'deposito':
               depositar($valor_deposito, $saldo_poupanca, $opcao);
                break;
            case 'saque':
                sacar($saldo_poupanca, $valor_saque, $opcao);
                break;
            default:
                throw new Exception("Error Processing Request", 1);
            
                break;
        }
    

// Informações para operação em conta corrente.
    } elseif ($opcao == "corrente") {
        switch ($operacao) {
            case 'deposito':
               depositar($valor_deposito, $saldo_corrente, $opcao);
                break;
            case 'saque':
                sacar($saldo_corrente, $valor_saque, $opcao);
                break;
            default:
                throw new Exception("Error Processing Request", 1);
            
                break;
        }
        
        
        
    } else {
        echo "selecione o tipo de conta";
    }
    

?>