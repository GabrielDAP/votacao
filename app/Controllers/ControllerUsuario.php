<?php

require_once('app/Database/ConexaoDB.php');

class ControllerUsuario
{
    public function createUsuario(Usuario $usuario){
        try{
            $insertUsuario = "INSERT INTO usuarios (nome, cpf, idade, voto) VALUES (:nome, :cpf, :idade, :voto)";
            $stmt = ConexaoDB::getConn()->prepare($insertUsuario);
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':cpf', $usuario->getCpf());
            $stmt->bindValue(':idade', $usuario->getIdade());
            $stmt->bindValue(':voto', $usuario->getVoto());
            $stmt->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function readUsuario(){
        try{
            $queryUsuario = "SELECT * FROM usuarios";
            $stmt = ConexaoDB::getConn()->prepare($queryUsuario);
            $stmt->execute();

            if($stmt->rowCount()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function updateUsuario(Usuario $usuario){

    }

    public function deleteUsuario(int $id){

    }
}


class Votos
{
    public function resultadoVoto($result){
        try{
            $queryVoto = "SELECT COUNT(voto) AS totalVotos FROM usuarios WHERE voto='$result'";
            $stmt = ConexaoDB::getConn()->prepare($queryVoto);
            $stmt->execute();
            if($stmt->rowCount()){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result["totalVotos"];
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function totalVotos(){
        try{
            $queryVoto = "SELECT COUNT(voto) AS totalVotos FROM usuarios";
            $stmt = ConexaoDB::getConn()->prepare($queryVoto);
            $stmt->execute();
            if($stmt->rowCount()){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result["totalVotos"];
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

?>