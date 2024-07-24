<?php

namespace App\Models;

final class TeachersModel{
    
    /**  
    *@var string
    */
    private string $cpf;
    
    /**  
    *@var string
    */
    private string $nome;

    /**  
    *@var string
    */
    private string $senha;

    /** 
    *@var \DateTime
    */
    private \DateTime $data_nasc;

    /**  
    *@var string
    */
    private string $escola_id;

    /**  
    *@var string
    */
    private string $cpf_users;


    public function getCpf(): string {
        return $this->cpf;

    }

    public function setCpf(string $cpf): TeachersModel {
        $this->cpf = $cpf;
        return $this;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): TeachersModel {
        $this->nome = $nome;
        return $this;
    }

    public function getSenha(): string {
        return $this->senha;

    }

    public function setSenha(string $senha): TeachersModel {
        $this->senha = $senha;
        return $this;
    }

    public function getDataNasc(): \DateTime {
        return $this->data_nasc;
    }

    public function setDataNasc(\DateTime $data_nasc): TeachersModel {
        $this->data_nasc = $data_nasc;
        return $this;
    }

    public function getEscolaId(): string {
        return $this->escola_id;
    }

    public function setEscolaId(string $escola_id): TeachersModel {
        $this->escola_id = $escola_id;
        return $this;
    }

    public function getCpfUsers(): string {
        return $this->cpf_users;
    }

    public function setCpfUsers(string $cpf_users): TeachersModel {
        $this->cpf_users = $cpf_users;
        return $this;
    }
    
}