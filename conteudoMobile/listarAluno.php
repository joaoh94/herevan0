<?php 

    $psg_id = $_POST['psg_id'];

    include ("../conexao/conexao_mobile.php");

    $sql_edit = "SELECT nome, cpf, endereco, cidade, numeroEnd, cep, estado, sexo, telefone FROM passageiro WHERE psg_id=$psg_id";

    $dados = $PDO->query($sql_edit);

    $resultado = array();

    while($psg = $dados->fetch(PDO::FETCH_OBJ)) {

        $resultado[] = array("nome"=>$psg->nome, "cpf"=>$psg->cpf, "endereco"=>$psg->endereco, "cidade"=>$psg->cidade, "numeroEnd"=>$psg->numeroEnd, "cep"=>$psg->cep, "estado"=>$psg->estado, "sexo"=>$psg->sexo, "telefone"=>$psg->telefone );
    }

    echo json_encode($resultado);
?>