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

function pegaValor($operacao){
    switch ($operacao) {
        case 'saque':
            $valor = $_POST['valor_saque'];
            return $valor;
            break;
        case 'deposito':
            $valor = $_POST['valor_deposito'];
            return $valor;
            break;
        default:
            throw new Exception("Error Processing Request", 1);
            break;
    }
}
function executarOperacao($opcao, $operacao, $valor, $saldo_poupanca, $saldo_corrente){
    // Informações para operação em conta poupança.
    if ($opcao == "poupança"){
        switch ($operacao) {
            case 'deposito':
            depositar($valor, $saldo_poupanca, $opcao);
                break;
            case 'saque':
                sacar($saldo_poupanca, $valor, $opcao);
                break;
            default:
                throw new Exception("Error Processing Request", 1);
                break;
        }

    // Informações para operação em conta corrente.
    } elseif ($opcao == "corrente") {
        switch ($operacao) {
            case 'deposito':
                depositar($valor, $saldo_corrente, $opcao);
                break;
                case 'saque':
                    sacar($saldo_corrente, $valor, $opcao);
                    break;
                    default:
                    throw new Exception("Error Processing Request", 1);
                    break;
                }            
            } else {
                echo "selecione o tipo de conta";
            }
        }
        
        function app(){
            //pegar variáveis necessárias
            $opcao = $_POST['opcao'];
            $operacao = $_POST['operacao'];
            $saldo_corrente = lerSaldoContaCorrente();
            $saldo_poupanca = lerSaldoContaPoupanca();
            //pegar valor por operação
            $valor = pegaValor($operacao);
            //direcionar a operação conforme a opção
            executarOperacao($opcao, $operacao, $valor, $saldo_poupanca, $saldo_corrente);
}

?>