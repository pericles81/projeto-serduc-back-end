<?php

namespace App\Models;

final class SchoolsModel{

    /**  
    *@var int
    */
    private int $id;
    
    /**  
    *@var string
    */
    private string $nome;

    /**  
    *@var string
    */
    private string $endereco;

    public function getId(): int{
        return $this->id;
    }
    public function setId(int $id): SchoolsModel {
        $this->id = $id;
        return $this;
    }
    public function getNome(): string{
        return $this->nome;
    }
    public function setNome(string $nome): SchoolsModel{
        $this->nome = $nome;
        return $this;
    }
    public function getEndereco(): string{
        return $this->endereco;
    }
    public function setEndereco(string $endereco): SchoolsModel{
        $this->endereco = $endereco;
        return $this;
    }
}