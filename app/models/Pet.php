<?php

namespace App\Models;

use App\Core\Database;

class Pet {
    
    // Lista todos os pets com o nome do tutor
    public static function listarTodos() {
        $db = Database::getConnection();
        $stmt = $db->query("
            SELECT p.*, c.nome as dono_nome 
            FROM pets p 
            INNER JOIN clientes c ON p.id_cliente = c.id_cliente
            ORDER BY p.id_pet DESC
        ");
        return $stmt->fetchAll();
    }

    // Busca um único pet pelo ID (Necessário para a tela de Edição)
    public static function buscarPorId($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM pets WHERE id_pet = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Salva um novo pet (Agora com porte e peso)
    public static function salvar($dados) {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO pets (nome, especie, raca, idade, porte, peso, id_cliente) 
            VALUES (:nome, :especie, :raca, :idade, :porte, :peso, :id_cliente)
        ");
        return $stmt->execute([
            'nome'       => $dados['nome'],
            'especie'    => $dados['especie'],
            'raca'       => $dados['raca'],
            'idade'      => $dados['idade'],
            'porte'      => $dados['porte'],
            'peso'       => $dados['peso'],
            'id_cliente' => $dados['cliente_id'] // Alinhado com o nome que vem do formulário
        ]);
    }

    // Atualiza os dados do pet (O "U" do CRUD)
    public static function atualizar($id, $dados) {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            UPDATE pets 
            SET nome = :nome, especie = :especie, raca = :raca, idade = :idade, porte = :porte, peso = :peso, id_cliente = :id_cliente 
            WHERE id_pet = :id
        ");
        return $stmt->execute([
            'id'         => $id,
            'nome'       => $dados['nome'],
            'especie'    => $dados['especie'],
            'raca'       => $dados['raca'],
            'idade'      => $dados['idade'],
            'porte'      => $dados['porte'],
            'peso'       => $dados['peso'],
            'id_cliente' => $dados['cliente_id']
        ]);
    }

    // Exclui um pet do banco (O "D" do CRUD)
    public static function excluir($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM pets WHERE id_pet = :id");
        return $stmt->execute(['id' => $id]);
    }
}