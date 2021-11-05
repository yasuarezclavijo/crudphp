<?php
    function connect_database() {
        $connection = mysqli_connect("localhost", "root", "", "sakila");
        if (!$connection) {
            echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
            echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
            echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        return $connection;
    }
