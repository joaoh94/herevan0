<?php
session_start();
include("../conexao/conexao.php");
include("../geraLog.php");

$veiculo_id = intval(@$_GET['vei_id']);
$sql_code = "SELECT * FROM Veiculo WHERE vei_id = $veiculo_id";
$sql_query = $mysqli->query($sql_code) or die ($mysqli->erro);
$linha = $sql_query->fetch_assoc();

$sql_motoristas = "SELECT * FROM Motorista WHERE emp_id = ".$_SESSION['emp_id'];
$query_motoristas = $mysqli->query($sql_motoristas) or die ($mysqli->erro);
$linha_motoristas = $query_motoristas->fetch_assoc();
	 
if(@$_GET['go'] == 'confirmar') {

      if (!isset($_SESSION)) 
      session_start();

      foreach ($_POST as $chave => $valor) 
        $_SESSION[$chave] = $mysqli->real_escape_string($valor); 

      $erronome = false;
      $erromarca = false;
      $erromodelo = false;
      $erroano = false;
      //$erroqtdlugar = false;
      $erroplaca = false;
	    //$erromotorista = false;
      
      if (strlen($_SESSION['nomeautomovel']) == 0)  
        $erronome[] = "Preencha o campo Nome Automóvel.";

      if (strlen($_SESSION['marca']) == 0)  
        $erromarca[] = "Preencha o campo Marca.";  

      if (strlen($_SESSION['modelo']) == 0)  
        $erromodelo[] = "Preencha o campo Modelo.";

      if (strlen($_SESSION['placa']) == 0)  
        $erroplaca[] = "Preencha o campo Placa.";
      
      if (!$erronome && !$erromarca && !$erromodelo && !$erroano && !$erroplaca) {

        $sql_veiculo = "UPDATE veiculo 
          SET
          vei_nome='$_SESSION[nomeautomovel]',
          vei_marca='$_SESSION[marca]',
          vei_ano_modelo='$_SESSION[modelo]',
          vei_placa='$_SESSION[placa]'
          WHERE 
          veiculo.vei_id = $veiculo_id";

        $confirma = $mysqli->query($sql_veiculo) or die ($mysqli->error);

        if ($confirma) {
          $veiculo = $_SESSION['placa'];
          $emp_id = $_SESSION['emp_id'];
          logMsg( "Listar Veiculos: O cadastro do veiculo de placa $veiculo foi editado pela empresa (ID: $emp_id)", 'info', '../logs/herevan.log' );
          echo "<script>alert('Veiculo alterado com sucesso.');location.href = 'listaveiculo.php';</script>";  

        }

        else
          $erro[] = $confirma;
}
	  
}

?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Editar Veiculo</title>
  </head>
  <body class="hold-transition skin-green sidebar-mini">

  <?php include 'headeradm.php';?>
  <?php include 'sideadm.php';?>

    <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Editar Veiculo <!-- <?php echo $linha['vei_nome']; ?>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
        <li><a href="#">Veiculos</a></li>
        <li class="active">Editar Veiculo</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
      <div class="col-md-6">
        <div class="box box">
          <div class="box-header">
            <h3 class="box-title">Dados Veicular</h3>
          </div>
          <p></p>
          <form role="form" method="POST" action="?go=confirmar&vei_id=<?php echo $veiculo_id?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="nomeautomovel">Nome do Automóvel</label><p></p>
                  <input type="text" name="nomeautomovel" value="<?php  echo $linha['vei_nome'] ?>" size="30" id="nomeautomovel" required>
                </div>
                <div class="form-group">
                  <label for="marca">Marca</label><p></p>
                  <input type="text" name="marca" value="<?php  echo $linha['vei_marca'] ?>" id="marca" required >
                </div>
                <div class="form-group">
                  <label for="modelo">Ano/Modelo</label><p></p>
                  <input type="text" name="modelo" value="<?php  echo $linha['vei_ano_modelo'] ?>" id="modelo" required >
                </div>
                <!--<div class="form-group">
                  <label for="qtdlugar">Quantidade de lugares</label><p></p>
                  <input type="number" name="qtdlugar" value="<?php  echo $linha['vei_lugares'] ?>" id="qtdlugar" required>
                </div>-->
                <div class="form-group">
                  <label for="placa">Placa</label><p></p>
                  <input type="text" name="placa" value="<?php  echo $linha['vei_placa'] ?>" size="8" maxlength="8" id="placa" required> 
                </div>
				        <!--<label for="motorista">Motorista</label><p></p>
                  <div class="form-group">                   
				            <select name="motorista">
                      <?php
                         do{
                      ?>

                      <option value=<?php echo $linha_motoristas['mot_nome'] ?> <?php if($linha['vei_motorista'] == $linha_motoristas['mot_nome']) echo "selected" ?> > <?php echo $linha['vei_motorista'] ?> </option>

                      <?php 
                        } while ($linha_motoristas = $query_motoristas->fetch_assoc())
                      ?>
                    </select>
                  </div>-->
          </div>
        </div>
      <input type="submit" class="btn" name="confirmar" id="confirmar" value="Confirmar">
      <input type="reset" class="btn" name="cancelar" id="cancelar" value="Cancelar">
    </form>
    </section>
    </div>


  </body>
</html>