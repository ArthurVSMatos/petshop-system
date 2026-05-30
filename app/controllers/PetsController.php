<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Cliente; 
use App\Models\Pet;

require_once __DIR__ . '/../models/Pet.php';
require_once __DIR__ . '/../models/Cliente.php';

class PetsController extends Controller {

    // Tela principal: lista todos os pets e seus respectivos donos
    public function index() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: http://localhost/petshop-system/public/login');
            exit;
        }

        // Busca a lista de pets através do Model
        $pets = Pet::listarTodos();
        
        // Renderiza a view correta mandando a lista de pets
        $this->view('pets/index', ['pets' => $pets]);
    }

    // Tela de formulário: mostra os campos do pet e o dropdown de clientes
    public function novo() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: http://localhost/petshop-system/public/login');
            exit;
        }

        // Busca manual e limpa dos clientes direto do banco para evitar caminhos de pasta
        $db = \App\Core\Database::getConnection();
        $stmt = $db->query("SELECT id_cliente, nome, cpf FROM clientes ORDER BY nome ASC");
        $clientes = $stmt->fetchAll();

        $this->view('pets/criar', ['clientes' => $clientes]);
    }

    // Processa o envio do formulário e salva o pet
    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $dados = [
                'nome'       => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
                'especie'    => filter_input(INPUT_POST, 'especie', FILTER_SANITIZE_SPECIAL_CHARS),
                'raca'       => filter_input(INPUT_POST, 'raca', FILTER_SANITIZE_SPECIAL_CHARS),
                'idade'      => filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT),
                'porte'      => filter_input(INPUT_POST, 'porte', FILTER_SANITIZE_SPECIAL_CHARS),
                'peso'       => filter_input(INPUT_POST, 'peso', FILTER_VALIDATE_FLOAT),
                'cliente_id' => filter_input(INPUT_POST, 'cliente_id', FILTER_VALIDATE_INT)
            ];

            if ($dados['idade'] === false || $dados['idade'] < 0 || !$dados['porte']) {
                $db = \App\Core\Database::getConnection();
                $clientes = $db->query("SELECT id_cliente, nome, cpf FROM clientes ORDER BY nome ASC")->fetchAll();
                
                $this->view('pets/criar', [
                    'clientes' => $clientes, 
                    'erro' => 'Por favor, preencha todos os campos corretamente.'
                ]);
                return;
            }

            if (Pet::salvar($dados)) {
                header('Location: http://localhost/petshop-system/public/pets?sucesso=1');
                exit;
            } else {
                $db = \App\Core\Database::getConnection();
                $clientes = $db->query("SELECT id_cliente, nome, cpf FROM clientes ORDER BY nome ASC")->fetchAll();
                
                $this->view('pets/criar', [
                    'clientes' => $clientes, 
                    'erro' => 'Erro interno ao cadastrar o pet no banco.'
                ]);
            }
        }
    }

    // ==========================================================
    // MÉTODO ADICIONADO: Carrega a tela com os dados atuais do pet
    // ==========================================================
    public function editar($id) {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: http://localhost/petshop-system/public/login');
            exit;
        }

        // Busca o pet específico pelo id_pet
        $pet = Pet::buscarPorId($id); 

        // Puxa os clientes para preencher o dropdown de tutores
        $db = \App\Core\Database::getConnection();
        $clientes = $db->query("SELECT id_cliente, nome, cpf FROM clientes ORDER BY nome ASC")->fetchAll();

        // Se o pet sumiu ou não existe, evita tela quebrada
        if (!$pet) {
            header('Location: http://localhost/petshop-system/public/pets?erro=pet_nao_encontrado');
            exit;
        }

        // Passa os dados empacotados para a view editar.php
        $this->view('pets/editar', [
            'pet' => $pet, 
            'clientes' => $clientes
        ]);
    }

    // Processa a atualização do pet
    public function actualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome'       => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
                'especie'    => filter_input(INPUT_POST, 'especie', FILTER_SANITIZE_SPECIAL_CHARS),
                'raca'       => filter_input(INPUT_POST, 'raca', FILTER_SANITIZE_SPECIAL_CHARS),
                'idade'      => filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT),
                'porte'      => filter_input(INPUT_POST, 'porte', FILTER_SANITIZE_SPECIAL_CHARS),
                'peso'       => filter_input(INPUT_POST, 'peso', FILTER_VALIDATE_FLOAT),
                'cliente_id' => filter_input(INPUT_POST, 'cliente_id', FILTER_VALIDATE_INT)
            ];

            if (Pet::atualizar($id, $dados)) {
                header('Location: http://localhost/petshop-system/public/pets?sucesso=edicao');
                exit;
            } else {
                header("Location: http://localhost/petshop-system/public/pets/editar/$id?erro=1");
                exit;
            }
        }
    }

    // Processa a exclusão do pet
    public function deletar($id) {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: http://localhost/petshop-system/public/login');
            exit;
        }

        if (Pet::excluir($id)) {
            header('Location: http://localhost/petshop-system/public/pets?sucesso=delecao');
            exit;
        } else {
            header('Location: http://localhost/petshop-system/public/pets?erro=delecao');
            exit;
        }
    }

}