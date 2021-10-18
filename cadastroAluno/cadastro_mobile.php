<?php 

    include ("../conexao/conexao_mobile.php");

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $numeroEnd = $_POST['numeroEnd'];
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $sexo = $_POST['sexo'];
    $telefone = $_POST['telefone'];
    $email = $_POST['us_email'];
    $senha = $_POST['us_senha'];

    $sql_verifica = "SELECT * FROM usuario WHERE us_email = :EMAIL";
    $stmt = $PDO->prepare($sql_verifica);
    $stmt->bindParam(':EMAIL', $email);
    $stmt->execute();

    $sql_verificacpf = "SELECT * FROM passageiro WHERE cpf = :CPF";
    $stmtcpf = $PDO->prepare($sql_verificacpf);
    $stmtcpf->bindParam(':CPF', $cpf);
    $stmtcpf->execute();

    if($stmt->rowCount() > 0){
        //email cadastrado
        $retornoMobile = array("CADASTRO"=>"Email_Erro");        
    } 
    else if ($stmtcpf->rowCount() > 0){
        //cpf cadastrado
    $retornoMobile = array("CADASTRO"=>"Cpf_Erro");
    }
    else {
        //Cadastrado com sucesso
        //echo "CADASTRADO COM SUCESSO";
        $sql_insert = "INSERT INTO usuario (us_email, us_senha, us_tipo) VALUES (:EMAIL, :SENHA, 'P')";
        $stmt = $PDO->prepare($sql_insert);

        $stmt->bindParam(':EMAIL', $email);
        $stmt->bindParam(':SENHA', $senha);

        if($stmt->execute()){
            
            $last_id = $PDO->lastInsertId();

            $sql_insert1 = "INSERT INTO passageiro (nome, cpf, endereco, cidade, numeroEnd, cep, estado, sexo, telefone, us_id) VALUES (:NOME, :CPF, :ENDERECO, :CIDADE, :NUMEROEND, :CEP, :ESTADO, :SEXO, :TELEFONE, :US_ID)";
            $stmt1 = $PDO->prepare($sql_insert1);

            $stmt1->bindParam(':NOME', $nome);
            $stmt1->bindParam(':CPF', $cpf);  
            $stmt1->bindParam(':ENDERECO', $endereco);
            $stmt1->bindParam(':CIDADE', $cidade);
            $stmt1->bindParam(':NUMEROEND', $numeroEnd);
            $stmt1->bindParam(':CEP', $cep);
            $stmt1->bindParam(':ESTADO', $estado);
            $stmt1->bindParam(':SEXO', $sexo);
            $stmt1->bindParam(':TELEFONE', $telefone);
            $stmt1->bindParam(':US_ID', $last_id);

            if($stmt1->execute()){

                $id_psg = $PDO->lastInsertId();

                $retornoMobile = array("CADASTRO"=>"Sucesso", "ID"=>$id_psg);
            } else {
                $retornoMobile = array("CADASTRO"=>"Email_Erro");
            }            
        } else {
            $retornoMobile = array("CADASTRO"=>"Email_Erro");
        }   
    }

    echo json_encode($retornoMobile)

?>