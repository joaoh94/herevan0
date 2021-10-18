<?php
session_start();
include("../conexao/conexao.php");

$msg = intval(@$_GET['msg_id']);
$sql_code = "SELECT * FROM mensagem WHERE msg_id = $msg";
$sql_query = $mysqli->query($sql_code) or die ($mysqli->erro);
$linha = $sql_query->fetch_assoc();
?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Detalhes Mensagem</title>
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <?php include 'headeradm.php';?>
    <?php include 'sideadm.php';?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Informação da Mensagem
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
          <li><a href="#">Mensagens</a></li>
          <li class="active">Informação da Mensagem</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">            
              <div class="box-body">
                <table id="example" class="table table-bordered table-hover">
                <thead>
                <strong> Numero: </strong> <?php echo $linha['msg_id']; ?><br>
                <strong> Titulo: </strong> <?php echo $linha['titulo']; ?><br>
                <strong> Mensagem: </strong> <?php echo $linha['msg_text']; ?><br><br>                   
                  <a href="listacontato.php">Voltar &emsp;</a>
				          <a href="javascript: if(confirm('Tem certeza que deseja deletar a mensagem <?php echo $linha['titulo']; ?>?'))
                  location.href='deletamensagem.php?msg_id=<?php echo $linha['msg_id']; ?>';">Deletar &emsp;</a>
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