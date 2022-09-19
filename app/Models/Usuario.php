<?php

class Usuario{
    
    private $id;
    private $nome;
    private $cpf;
    private $idade;
    private $voto;
    private $msg;
    private $erro = [];

	public function getId() {
		return $this-> id;
	}

	public function setId($id) {
		return $this-> id = $id;
	}

	public function getNome() {
		return $this-> nome;
	}

	public function setNome($nome) {
		return $this-> nome = $nome;
	}

	public function getCpf() {
		return $this-> cpf;
	}

	public function setCpf($cpf) {
		return $this-> cpf = $cpf;
	}

	public function getIdade() {
		return $this-> idade;
	}

	public function setIdade($idade) {
		return $this-> idade = $idade;
	}

    public function getVoto() {
		return $this-> voto;
	}

	public function setVoto($voto) {
		return $this-> voto = $voto;
	}

	public function getMsg() {
		return $this-> msg;
	}

    public function __construct($nome, $cpf, $idade, $voto){
        $this-> nome = $nome;
        $this-> cpf = $cpf;
        $this-> idade = $idade;
        $this-> voto = $voto;
    }

    public function validarDados(){
        if(empty($this->nome)){
            $this->erro["erro_nome"] = "O campo nome está vazio!";
        }
        else if($this->idade < 16 || $this->idade > 150 || !is_numeric($this->idade)){
            $this->erro["erro_idade"] = "Idade Inválida!";
            $this->msg = "Idade Inválida!";
        }
        else if(!is_numeric($this->cpf)){
            $this->erro["erro_cpf"] = "CPF Inválido!";
            $this->msg = "CPF Inválido!";
        }
        else if(empty($this->erro)){
            $this->msg = "Votação efetuada com sucesso!";
        }
    }

    
    
}



?>