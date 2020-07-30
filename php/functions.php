<?php require 'php/database.php';


function pwd_verify(string $password , string $hash) : bool {
        $result = password_verify($password, $hash);
        return $result;
    }

    function hash_pwd(string $password, int $algo = PASSWORD_DEFAULT) : string {
        $hash = password_hash($password, $algo);
        return $hash;
    }

    function connected() : bool {
        //start or resume session
        session_start();
        return isset($_SESSION["admin"]);
    }