<?php

namespace App\Models;

class UsersModels {
    private $cpf;
    private $senha;
    private $nascimento;

    public function __construct($cpf, $senha, $nascimento) {
        $this->cpf = $cpf;
        $this->senha = $senha;
        $this->nascimento = $nascimento;
    }

    // Getters and setters
    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getNascimento() {
        return $this->nascimento;
    }

    public function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
    }
}