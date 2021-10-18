<?php

	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$turnoRecebido = $_POST['turno'];
    $universidadeRecebido = $_POST['universidadeID'];

	include ("../conexao/conexao_mobile.php");
	include_once ("consultaRota.php");

	$resultado = array();
	$resultadoID = array();
	$resultadoNegativo;
	
    $sql_rota = "SELECT rot_id, ponto0, ponto1, ponto2, ponto3, ponto4, ponto5 from rota WHERE rot_turno='$turnoRecebido' AND uni_id = $universidadeRecebido"; //where rot_turno = $turno and uni_id = $universidade;
	$dadosRota = $PDO->query($sql_rota);  
	
    while($rota = $dadosRota->fetch(PDO::FETCH_OBJ)) {
		
		//ponto0
		$ponto0 = str_replace("(", "", $rota->ponto0);
        $ponto0 = str_replace(")", "", $ponto0);
		$ponto0 = str_replace(" ", "", $ponto0);
		$ponto0 = explode(',', $ponto0);
		
		//ponto1
		$ponto1 = str_replace("(", "", $rota->ponto1);
        $ponto1 = str_replace(")", "", $ponto1);
		$ponto1 = str_replace(" ", "", $ponto1);
		$ponto1 = explode(',', $ponto1);
		
		//ponto2
		$ponto2 = str_replace("(", "", $rota->ponto2);
        $ponto2 = str_replace(")", "", $ponto2);
		$ponto2 = str_replace(" ", "", $ponto2);
		$ponto2 = explode(',', $ponto2);
		
		//ponto3
		$ponto3 = str_replace("(", "", $rota->ponto3);
        $ponto3 = str_replace(")", "", $ponto3);
		$ponto3 = str_replace(" ", "", $ponto3);
		$ponto3 = explode(',', $ponto3);
		
		//ponto4
		$ponto4 = str_replace("(", "", $rota->ponto4);
        $ponto4 = str_replace(")", "", $ponto4);
		$ponto4 = str_replace(" ", "", $ponto4);
		$ponto4 = explode(',', $ponto4);
		
		//ponto5
		$ponto5 = str_replace("(", "", $rota->ponto5);
        $ponto5 = str_replace(")", "", $ponto5);
		$ponto5 = str_replace(" ", "", $ponto5);
		$ponto5 = explode(',', $ponto5);		
		
		//Preparar os parametros para a chamada da função
		$vertices_x = array($ponto0[1], $ponto1[1], $ponto2[1], $ponto3[1], $ponto4[1], $ponto5[1]);
		$vertices_y = array($ponto0[0], $ponto1[0], $ponto2[0], $ponto3[0], $ponto4[0], $ponto5[0]);
		$points_polygon = count($vertices_x);
		//$longitude_x = -22.832991;
		//$latitude_y =  -47.052115;

		$longitude_x = $longitude;
		$latitude_y = $latitude;

		//Chamada da função
		if (is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y))
		{
			$resultadoID[] = $rota->rot_id;			
		}
		else 
		{
			$resultadoNegativo = 0;
		}
	}
	
	//Prepara todos os ids encontrados e concatena em uma String
	$idRota = implode(",", $resultadoID);

	if($idRota > 0)
	{
		$flag = "S";
	}
	else {
		$flag = "N";
	}

//Executa a query para listar as empresas 
if ($flag == "S")
{
	$sql_rota = ("SELECT ponto0, ponto1, ponto2, ponto3, ponto4, ponto5, rot_id, vei_id, mot_id, rot_turno, uni_id, emp_id, rot_qtdLivre, rot_preco FROM rota WHERE rot_turno='$turnoRecebido' AND rot_id IN (".$idRota.")"); //and uni_id='$universidadeRecebido'";
	$dadosRota = $PDO->query($sql_rota);    

    while($rota = $dadosRota->fetch(PDO::FETCH_OBJ)) {
		
		$emp_id = $rota->emp_id;
		$vei_id = $rota->vei_id;
		$mot_id = $rota->mot_id;
		$rot_turno = $rota->rot_turno;
		$uni_id = $rota->uni_id;	

		//ponto0
		$ponto0Rota = str_replace("(", "", $rota->ponto0);
        $ponto0Rota = str_replace(")", "", $ponto0Rota);
		$ponto0Rota = str_replace(" ", "", $ponto0Rota);
		$ponto0Rota = explode(',', $ponto0Rota);
		
		//ponto1
		$ponto1Rota = str_replace("(", "", $rota->ponto1);
        $ponto1Rota = str_replace(")", "", $ponto1Rota);
		$ponto1Rota = str_replace(" ", "", $ponto1Rota);
		$ponto1Rota = explode(',', $ponto1Rota);
		
		//ponto2
		$ponto2Rota = str_replace("(", "", $rota->ponto2);
        $ponto2Rota = str_replace(")", "", $ponto2Rota);
		$ponto2Rota = str_replace(" ", "", $ponto2Rota);
		$ponto2Rota = explode(',', $ponto2Rota);
		
		//ponto3
		$ponto3Rota = str_replace("(", "", $rota->ponto3);
        $ponto3Rota = str_replace(")", "", $ponto3Rota);
		$ponto3Rota = str_replace(" ", "", $ponto3Rota);
		$ponto3Rota = explode(',', $ponto3Rota);
		
		//ponto4
		$ponto4Rota = str_replace("(", "", $rota->ponto4);
        $ponto4Rota = str_replace(")", "", $ponto4Rota);
		$ponto4Rota = str_replace(" ", "", $ponto4Rota);
		$ponto4Rota = explode(',', $ponto4Rota);
		
		//ponto5
		$ponto5Rota = str_replace("(", "", $rota->ponto5);
        $ponto5Rota = str_replace(")", "", $ponto5Rota);
		$ponto5Rota = str_replace(" ", "", $ponto5Rota);
		$ponto5Rota = explode(',', $ponto5Rota);

		$turno;
		
		if($rota->rot_turno == 'M'){
			$turno = 'Matutino';
		} else if ($rota->rot_turno == 'V'){
			$turno = ' Vespertino';
		} else 
			$turno = 'Noturno';
		
		$sql_moto = "SELECT mot_nome from motorista where mot_id =$mot_id";
		$dadosMoto = $PDO->query($sql_moto);
		$motorista = $dadosMoto->fetch(PDO::FETCH_OBJ);
		
		$sql_uni = "SELECT uni_nome from universidade where uni_id =$uni_id";
		$dadosUni = $PDO->query($sql_uni);
		$universidade = $dadosUni->fetch(PDO::FETCH_OBJ);
		
		$sql_emp = "SELECT us_id, emp_nome_fantasia, emp_telefone from empresa where emp_id =$emp_id";
		$dadosEmp = $PDO->query($sql_emp);
		$empresa = $dadosEmp->fetch(PDO::FETCH_OBJ);
		$us_id = $empresa->us_id;
		
		$sql_usuario = "SELECT us_email from usuario where us_id =$us_id";
		$dadosUsuario = $PDO->query($sql_usuario);
		$usuario = $dadosUsuario->fetch(PDO::FETCH_OBJ);
		
		$sql_veiculo = "SELECT vei_nome from veiculo where vei_id =$vei_id";
		$dadosVeiculo = $PDO->query($sql_veiculo);
		$veiculo = $dadosVeiculo->fetch(PDO::FETCH_OBJ);

		$resultado[] = array("rot_id"=>$rota->rot_id, "emp_id"=>$rota->emp_id, "nomeFantasia"=>$empresa->emp_nome_fantasia, "nomeMotorista"=>$motorista->mot_nome, "nomeVeiculo"=>$veiculo->vei_nome, "nomeUniversidade"=>$universidade->uni_nome, "turno"=>$turno, "email"=>$usuario->us_email, "telefone"=>$empresa->emp_telefone, "qtdLugar"=>$rota->rot_qtdLivre, "preco"=>$rota->rot_preco,
		"ponto0Lat"=>$ponto0Rota[0], "ponto1Lat"=>$ponto1Rota[0], "ponto2Lat"=>$ponto2Rota[0], "ponto3Lat"=>$ponto3Rota[0], "ponto4Lat"=>$ponto4Rota[0], "ponto5Lat"=>$ponto5Rota[0], "ponto0Lng"=>$ponto0Rota[1], "ponto1Lng"=>$ponto1Rota[1], "ponto2Lng"=>$ponto2Rota[1], "ponto3Lng"=>$ponto3Rota[1], "ponto4Lng"=>$ponto4Rota[1], "ponto5Lng"=>$ponto5Rota[1]);
    }
}	
else {
	$resultado = 0;
}
	//$resultado[] = array("nomeFantasia", "motorista", "veiculo", "universidade", "turno", "email", "telefone");

	echo json_encode($resultado);
	
?>