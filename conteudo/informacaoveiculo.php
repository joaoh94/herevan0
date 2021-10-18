<?php
session_start();
include("../conexao/conexao.php");

$veiculo_id = intval(@$_GET['mot_id']);
$sql_code = "SELECT * FROM veiculo WHERE vei_id = $veiculo_id";
$sql_query = $mysqli->query($sql_code) or die ($mysqli->erro);
$linha = $sql_query->fetch_assoc();
?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Detalhes Veiculo</title>
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <?php include 'headeradm.php';?>
    <?php include 'sideadm.php';?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Informação do Veiculo
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
          <li><a href="#">Veiculos</a></li>
          <li class="active">Informação do Veiculo</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
            
              <div class="box-body">
                <table id="example" class="table table-bordered table-hover">
                  <thead>
                  
                    <strong> Nome: </strong> <?php echo $linha['vei_nome']; ?><br>
					          <strong> Marca: </strong><?php echo $linha['vei_marca']; ?><br>
                    <strong> Ano/Modelo: </strong> <?php echo $linha['vei_ano_modelo']; ?><br>
                    <!--<strong> Lugares: </strong> <?php echo $linha['vei_lugares']; ?><br>-->
                    <strong> Placa: </strong> <?php echo $linha['vei_placa']; ?><br>
					          <!--<strong> Motorista: </strong> <?php echo $linha['vei_motorista'];?><br>-->
                    <br>
					          <a href="listaveiculo.php">Voltar &emsp;</a>
                    <a href="javascript:location.href='editarveiculo.php?vei_id=<?php echo $linha['vei_id']; ?>';">Editar &emsp;</a>
                    <a href="javascript: if(confirm('Tem certeza que deseja deletar o Motorista <?php echo $linha['vei_nome']; ?>?'))
                  location.href='deletarveiculo.php?vei_id=<?php echo $linha['vei_id']; ?>';">Deletar &emsp;</a>
                  </thead>
                </table>
              </div>
            </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </body>
</html>