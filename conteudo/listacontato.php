<?php
  session_start();
  include("../conexao/conexao.php");


  
$sql = "SELECT * FROM mensagem where emp_id=".$_SESSION['emp_id'].' order by msg_id';
  
$sql_query = $mysqli->query($sql) or die ($mysqli->erro);
$linha = $sql_query->fetch_assoc();

?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Mensagens enviadas</title>
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <?php include 'headeradm.php';?>
    <?php include 'sideadm.php';?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Mensagens
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
          <li><a href="#">Outros</a></li>
          <li class="active">Mensagens</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              
              <div class="box-body">
                <table id="example" class="table table-bordered table-hover">
                  <thead>
				  
				  <tr>
				  <th>Número</th>
				  <th>Titulo</th>
          <th>Ação</th>
				  </tr>
				  </thead>
            <?php
              if ($linha['msg_id'] != null) {
              do{
              ?>
              <tr>
				        <td><?php echo $linha['msg_id'];?>
                <td><?php echo $linha['titulo']; ?></td>                   
					      <td>
					      <a href="javascript:location.href='informacaomensagem.php?msg_id=<?php echo $linha['msg_id']; ?>';">Ver &emsp;</a>
                <a href="javascript: if(confirm('Tem certeza que deseja deletar a mensagem <?php echo $linha['titulo']; ?>?'))
                  location.href='deletamensagem.php?msg_id=<?php echo $linha['msg_id']; ?>';">Deletar &emsp;</a>
                </td>                  
              </tr>
                <?php } while ($linha = $sql_query->fetch_assoc()); } ?>
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