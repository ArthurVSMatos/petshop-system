<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static $instance = null;

    public static function getConnection() {
        if (self::$instance === null) {
            // SEMPRE UTILIZAR O  TRY CATCH PARA TRATAR ERROS DE CONEXÃO COM O BANCO DE DADOS (RNF01)
            try {
                $host = 'localhost';
                $dbname = 'petshop_system';
                $username = 'root';
                $password = ''; // Padrão do XAMPP é sem senha

                $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
                
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false, // Proteção contra SQL Injection (RNF01)
                ];

                self::$instance = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}