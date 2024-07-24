<?php

namespace App\Models;

final class StudentsModel{

    /**  
    *@var string
    */
    private string $cpf;
    
    /**  
    *@var string
    */
    private string $senha;
    
    /**  
    *@var string
    */
    private string $nome;

    /** 
    *@var \DateTime
    */
    private \DateTime $data_nasc;

    /** 
    *@var string
    */
    private string $cpf_teachers;

    public function getCpf(): string{
        return $this->cpf;
    }
    public function setCpf(string $cpf): StudentsModel {
        $this->cpf = $cpf;
        return $this;
    }
    public function getNome(): string{
        return $this->nome;
    }
    public function setNome(string $nome): StudentsModel{
        $this->nome = $nome;
        return $this;
    }
    public function getSenha(): string{
        return $this->senha;
    }
    public function setSenha(string $senha): StudentsModel{
        $this->senha = $senha;
        return $this;
    }

    public function getDataNasc(): \DateTime {
        return $this->data_nasc;
    }

    public function setDataNasc(\DateTime $data_nasc): StudentsModel {
        $this->data_nasc = $data_nasc;
        return $this;
    }

    public function getCpfTeachers(): string {
        return $this->cpf_teachers;
    }

    public function setCpfTeachers(string $cpf_teachers): StudentsModel {
        $this->cpf_teachers = $cpf_teachers;
        return $this;
    }
}