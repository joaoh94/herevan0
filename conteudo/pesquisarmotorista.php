<?php
	session_start();
   include("../conexao/conexao.php");
   
   
    
    $pesquisar = $_POST['pesquisar'];
    $result_cursos = "SELECT * FROM motorista WHERE mot_nome LIKE '%$pesquisar%' ";
    $resultado_cursos = mysqli_query($conn, $result_cursos);
    
    while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
        echo "Motoristas: ".$rows_cursos['nome']."<br>";
    }
?>