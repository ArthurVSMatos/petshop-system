<?php
// public/index.php

// 1. Inicia a sessão para controle de login no futuro (RNF01)
session_start();

// 2. Ativa a exibição de erros na tela
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 3. AUTOLOADER: Carrega qualquer classe do projeto automaticamente com base no Namespace
spl_autoload_register(function ($class) {
    // Divide o namespace pelas barras invertidas (ex: App\Core\Database)
    $parts = explode('\\', $class);
    
    // Se a classe começar com "App", sabemos que está dentro da nossa pasta /app
    if ($parts[0] === 'App') {
        $parts[0] = 'app'; // Força a pasta raiz a ser minúscula
        
        // Garante que as subpastas (core, controllers, models, views) fiquem em minúsculo
        if (isset($parts[1])) {
            $parts[1] = strtolower($parts[1]);
        }
        
        // Monta o caminho real do arquivo (ex: ../app/core/Database.php)
        $caminhoArquivo = __DIR__ . '/../' . implode('/', $parts) . '.php';
        
        // Se o arquivo existir fisicamente, inclui ele no sistema
        if (file_exists($caminhoArquivo)) {
            require_once $caminhoArquivo;
        }
    }
});

// 4. Removemos os "require_once" manuais antigos daqui! 
// O Autoloader acima vai carregar o Router, a Database e o Controller sozinho.
$app = new \App\Core\Router();