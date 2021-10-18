<?php
  session_start();
  include("../conexao/conexao.php");
  include("../geraLog.php");

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    foreach ($_POST as $chave => $valor) 
        $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    
    $placa = strtoupper($_SESSION[placa]);

    $sql_veiculo = "INSERT INTO Veiculo (
		emp_id,
    vei_nome, 
		vei_marca,
    vei_ano_modelo,
    vei_placa )
    VALUES (
		$_SESSION[emp_id],
    '$_SESSION[nomeautomovel]',
		'$_SESSION[marcaveic]',
    '$_SESSION[modeloveic]',
    '$placa' )";

        //$confirma = $mysqli->query($sql_veiculo) or die ($mysqli->error);

        if($mysqli->query($sql_veiculo) === TRUE){
          $veiculo = $_SESSION['placa'];
          $emp_id = $_SESSION['emp_id'];
          logMsg( "Cadastrar Veiculos: O veiculo da placa $veiculo acabou de ser cadastrado na aplicação pela empresa (ID: $emp_id)", 'info', '../logs/herevan.log' );
          echo '<script type="text/javascript"> window.location = "listaveiculo.php" </script>';
          foreach ($_POST as $chave => $valor) 
            $_SESSION[$chave] = "";

        }
        else
          echo $mysqli->error;
  }
  else{
	
$sql_motoristas = "SELECT * FROM Motorista WHERE emp_id = ".$_SESSION['emp_id'];
    $query_motoristas = $mysqli->query($sql_motoristas) or die ($mysqli->erro);
    $linha_motoristas = $query_motoristas->fetch_assoc();	
  }
?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Cadastro Veiculos</title>
  </head>
  <body class="hold-transition skin-green sidebar-mini">

  <?php include 'headeradm.php';?>
  <?php include 'sideadm.php';?>

  <script src ="../assets/js/jquery-3.3.1.min.js" type ="text/javascript"></script>
  <script src ="../assets/js/jquery.mask.min.js" type ="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() {
    $("#modeloveic").mask("0000");
    $("#placa").mask("AAA-0000"); })
  </script>

    <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Cadastro Veiculo
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
        <li><a href="#">Veiculos</a></li>
        <li class="active">Cadastrar Veiculos</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
      <div class="col-md-6">
        <div class="box box">
          <div class="box-header">
            <h3 class="box-title">Dados Veicular</h3>
          </div>
          <p>&ensp;(*) Campos de preenchimento obrigatório.</p>
          <form role="form" method="POST">
            <div class="box-body">
			
			  
              <div class="form-group">
                <label for="nomeautomovel">Nome do Automóvel</label>
                <p></p>
                <input type="text" name="nomeautomovel" size="30" id="nomeautomovel" value="<?php echo @$_SESSION[nomeautomovel]; ?>" required>
              </div>
			   
			  
			<label for="marcaveic">Marca</label>
			<p></p>
			    <select name="marcaveic" required>
	<option value="">Selecione...</option>
   <option value="Besta">Besta</option>
    <option value="Citroen">Citröen</option>
    <option value="Fiat">Fiat</option>
    <option value="Iveco">Iveco</option>
	<option value="Jin Bei">Jin Bei</option>
	<option value="Mercedes">Mercedes-Benz</option>
	<option value="Peugeot">Peugeot</option>
	<option value="Renault">Renault</option>
	<option value="Outro">Outro</option>
  </select>

  
  <br><br>
			  

              <div class="form-group">
                <label for="modeloveic">Ano/Modelo</label>
                <p></p>
                <input type="text" name="modeloveic" id="modeloveic" value="<?php echo @$_SESSION[modeloveic]; ?>" required >
              </div>
	<!--<div class="form-group">		   
                <label for="qtdlugar">Quantidade de lugares</label>
                <p></p>
              
			  <input type="number" name="qtdlugar" id="qtdlugar" min="0" value="<?php echo @$_SESSION[qtdlugar]; ?>" required>
              </div>-->
              <div class="form-group">

                <label for="placa">Placa</label>
                <p></p>
                <input type="text" name="placa" placeholder="ABC-1234" size="8" maxlength="8" id="placa" value="<?php echo @$_SESSION[placa]; ?>" required style="text-transform:uppercase;"> 
              </div>
			   <!--<label for="motorista">Motorista</label><p></p>
          <div class="form-group">                   
				   <select name="motorista" required>
              <?php
              if ($linha_motoristas['mot_nome'] != null) {
              do{
              ?>
              <option value="">Selecione...</option>
              <option> <?php echo $linha_motoristas['mot_nome'] ?> </option>
              <?php } while ($linha_motoristas = $query_motoristas->fetch_assoc()); }
              else { ?>              
              <option value="">Selecione...</option>
              <?php } ?>
            </select>
          </div>-->
              <input type="submit" class="btn" name="confirmar" id="confirmar" value="Confirmar">
              <input type="reset" class="btn" name="limpar" id="limpar" value="Limpar">
        </div>
        
        </form>
    </section>
    </div>


  </body>
</html>