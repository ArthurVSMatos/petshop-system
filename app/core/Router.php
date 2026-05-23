<?php

namespace App\Core;

class Router {
    // Define o controlador e o método padrão (caso o usuário acesse só /public/)
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // 1. Verifica se o Controller requisitado existe na pasta
        if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        // Importa e instancia o Controller
        require_once '../app/controllers/' . $this->controller . '.php';
        $fullControllerName = "\\App\\Controllers\\" . $this->controller;
        $this->controller = new $fullControllerName;

        // 2. Verifica se o Método existe dentro do Controller
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. Pega os parâmetros extras da URL (ex: id do cliente)
        $this->params = $url ? array_values($url) : [];

        // Executa o método do Controller passando os parâmetros
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Função que "fatia" a URL
    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return []; 
    }
}