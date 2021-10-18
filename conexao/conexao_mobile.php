<?php   
    $dsn = "mysql:host=localhost;dbname=bdb projeto;charset=utf8";
    $usuario = "root";
    $senha = "";

    try {

        $PDO = new PDO($dsn, $usuario, $senha);
        //echo "SUCESSO NA CONEXAO";

    } catch (PDOException $erro) {

        echo "Erro: " .$erro->getMessage();
        exit;
    }

?>