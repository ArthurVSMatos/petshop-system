<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Cliente {
    
    // Lista todos os clientes ordenados pelo nome
    public static function listarTodos() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM clientes ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca um cliente específico pelo CPF (útil para validações)
    public static function buscarPorCpf($cpf) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM clientes WHERE cpf = :cpf");
        $stmt->execute(['cpf' => $cpf]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Salva um novo cliente no banco de dados
    public static function salvar($dados) {
        $db = Database::getConnection();
        
        $sql = "INSERT INTO clientes (nome, cpf, telefone, email, endereco) 
                VALUES (:nome, :cpf, :telefone, :email, :endereco)";
                
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'nome'     => $dados['nome'],
            'cpf'      => $dados['cpf'],
            'telefone' => $dados['telefone'],
            'email'    => $dados['email'],
            'endereco' => $dados['endereco']
        ]);
    }

    // ==========================================
    // MÉTODO ADICIONADO: Buscar cliente por ID
    // ==========================================
    public static function buscarPorId($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM clientes WHERE id_cliente = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ==========================================
    // MÉTODO ADICIONADO: Atualizar dados (UPDATE)
    // ==========================================
    public static function atualizar($id, $dados) {
        $db = Database::getConnection();
        
        $stmt = $db->prepare("UPDATE clientes 
                              SET nome = :nome, 
                                  cpf = :cpf, 
                                  telefone = :telefone, 
                                  email = :email, 
                                  endereco = :endereco 
                              WHERE id_cliente = :id");
        
        return $stmt->execute([
            'nome'     => $dados['nome'],
            'cpf'      => $dados['cpf'],
            'telefone' => $dados['telefone'],
            'email'    => $dados['email'],
            'endereco' => $dados['endereco'],
            'id'       => $id
        ]);
    }

    // ==========================================
    // MÉTODO ADICIONADO: Deletar cliente (DELETE)
    // ==========================================
    public static function excluir($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM clientes WHERE id_cliente = :id");
        return $stmt->execute(['id' => $id]);
    }
}