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

    // Carrega a tela com os dados atuais do cliente para edição
    public function editar($id) {
        // Bloqueia o acesso de quem não estiver logado
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: http://localhost/petshop-system/public/login');
            exit;
        }

        // Pede ao Model para buscar o cliente específico pelo ID
        $cliente = Cliente::buscarPorId($id); 

        // Se o cliente não for encontrado, volta para a listagem com uma mensagem de erro
        if (!$cliente) {
            header('Location: http://localhost/petshop-system/public/clientes?erro=cliente_nao_encontrado');
            exit;
        }

        // Passa os dados do tutor encontrado para a view editar.php
        $this->view('clientes/editar', ['cliente' => $cliente]);
    }

    // Recebe os dados do formulário de edição e atualiza no banco
    public function atualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Higieniza os dados enviados pelo formulário de edição
            $dados = [
                'nome'     => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
                'cpf'      => filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS),
                'telefone' => filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS),
                'email'    => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
                'endereco' => filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS)
            ];

            // Manda o Model executar o UPDATE. Se der certo, volta avisando o sucesso da edição
            if (Cliente::atualizar($id, $dados)) {
                header('Location: http://localhost/petshop-system/public/clientes?sucesso=edicao');
                exit;
            } else {
                header("Location: http://localhost/petshop-system/public/clientes/editar/$id?erro=falha_atualizar");
                exit;
            }
        }
    }

    // Processa a exclusão de um cliente
    public function deletar($id) {
        // Bloqueia o acesso de quem não estiver logado
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: http://localhost/petshop-system/public/login');
            exit;
        }

        // Tenta excluir usando um bloco try/catch para capturar possíveis erros de integridade (ex: tutor com pets)
        try {
            if (Cliente::excluir($id)) {
                header('Location: http://localhost/petshop-system/public/clientes?sucesso=delecao');
            } else {
                header('Location: http://localhost/petshop-system/public/clientes?erro=delecao');
            }
        } catch (\Exception $e) {
            // Se o banco de dados rejeitar porque o cliente tem pets cadastrados no nome dele
            header('Location: http://localhost/petshop-system/public/clientes?erro=delecao');
        }
        exit;
    }
}