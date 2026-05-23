<?php

namespace App\Core;

class Controller {
    /**
     * Carrega a View correspondente e passa os dados para ela
     */
    public function view($view, $data = []) {

        extract($data);
        $arquivo = '../app/views/' . $view . '.php';
        
        if (file_exists($arquivo)) {
            require_once $arquivo;
        } else {
            die("A view {$view} não existe.");
        }
    }
}