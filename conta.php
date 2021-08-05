<?php

class contas{
    private $cpf;
    private $nome;
    private $saldo;

    public function getCpf(){
        return $this->cpf;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
}

class conta_corrente extends contas{

}

class conta_poupanca extends contas{
    
}