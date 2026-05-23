<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    
  public function index() {
        // SEGURANÇA (RN05): Se NÃO existir a sessão do usuário, expulsa para o login
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: http://localhost/petshop-system/public/login');
            exit;
        }

        $dados = [
            'titulo' => 'Painel Principal',
            'mensagem' => 'Bem-vindo ao sistema de gerenciamento do Petshop, ' . $_SESSION['usuario_nome'] . '!'
        ];

        // Passando a variável $dados para a view
        $this->view('home', $dados);
    }
}