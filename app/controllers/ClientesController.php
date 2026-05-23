<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Cliente;

class ClientesController extends Controller {

    // Carrega a tela inicial com a tabela de clientes
    public function index() {
        // Bloqueia o acesso de quem não estiver logado
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: http://localhost/petshop-system/public/login');
            exit;
        }

        // Pede ao Model para buscar todos os clientes no banco de dados
        $clientes = Cliente::listarTodos();

        // Manda os dados para a View que você acabou de arrumar
        $this->view('clientes/index', ['clientes' => $clientes]);
    }

    // Carrega a tela do formulário de cadastro (Novo Cliente)
    public function novo() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: http://localhost/petshop-system/public/login');
            exit;
        }

        $this->view('clientes/criar');
    }

    // Recebe os dados do formulário quando o usuário clica em "Salvar"
    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Pega os dados digitados e faz uma limpeza básica contra scripts maliciosos
            $dados = [
                'nome'     => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
                'cpf'      => filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS),
                'telefone' => filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS),
                'email'    => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
                'endereco' => filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS)
            ];

            // RN03: Verifica se o CPF já está cadastrado no banco antes de salvar
            if (Cliente::buscarPorCpf($dados['cpf'])) {
                $this->view('clientes/criar', ['erro' => 'Este CPF já está cadastrado no sistema!']);
                return;
            }

            // Manda o Model salvar. Se der certo, volta para a tabela com mensagem de sucesso
            if (Cliente::salvar($dados)) {
                header('Location: http://localhost/petshop-system/public/clientes?sucesso=1');
                exit;
            } else {
                $this->view('clientes/criar', ['erro' => 'Erro interno ao salvar o cliente.']);
            }
        }
    }
}