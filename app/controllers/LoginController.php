<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class LoginController extends Controller {
    
    // Mostra a tela de login
    public function index() {
        // Se o usuário já estiver logado, manda direto para a Home
        if (isset($_SESSION['usuario_id'])) {
            header('Location: http://localhost/petshop-system/public/home');
            exit;
        }
        
        $this->view('login');
    }

    // Processa o formulário de login
    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'];

            // Conecta ao banco para buscar o funcionário
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT * FROM funcionarios WHERE email = :email AND status = 'Ativo'");
            $stmt->execute(['email' => $email]);
            $funcionario = $stmt->fetch();

            // Verifica se o funcionário existe e se a senha está correta (usando password_verify para segurança)
            if ($funcionario && password_verify($senha, $funcionario['senha'])) {
                // Salva os dados na sessão do PHP
                $_SESSION['usuario_id']   = $funcionario['id_funcionario'];
                $_SESSION['usuario_nome'] = $funcionario['nome'];
                $_SESSION['usuario_cargo'] = $funcionario['cargo'];

                // Redireciona para o painel principal
                header('Location: http://localhost/petshop-system/public/home');
                exit;
            } else {
                // Se der errado, volta para o login com uma mensagem de erro
                $this->view('login', ['erro' => 'E-mail ou senha incorretos!']);
            }
        }
    }

    // Desloga do sistema
    public function sair() {
        session_destroy();
        header('Location: http://localhost/petshop-system/public/login');
        exit;
    }
}