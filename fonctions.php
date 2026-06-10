<?php 
    function dbconnect() {
        static $connect = null;
        if ($connect === null) {
            $connect = mysqli_connect('localhost', 'root', '', 'employees');
            if (!$connect) {
                die('Erreur de connnexion $a la base de donnees : '.mysqli_connect_error());
            }
            mysqli_set_charset($connect, 'utf8mb4');
        }
        return $connect;
    }
?>