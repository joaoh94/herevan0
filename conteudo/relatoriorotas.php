<?php
  session_start();
  include("../conexao/conexao.php");
   $sql3 = "SELECT * FROM rota WHERE emp_id=".$_SESSION['emp_id'].' order by vei_id, rot_turno ';
   $sql_query3 = $mysqli->query($sql3) or die ($mysqli->erro);
   $linha3 = $sql_query3->fetch_assoc();   
?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Relatório Rotas</title>
  </head>
  <body class="hold-transition skin-green sidebar-mini">

    <?php include 'headeradm.php';?>
    <?php include 'sideadm.php';?>


    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Relatório
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
          <li><a href="#">Relatório</a></li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Rotas</h3>
				
              </div>
              <div class="box-body">
			  <h4>
				<a title='Imprimir conteúdo' href='javascript:window.print()'><span class="glyphicon glyphicon-print"></span></a> </h4>
				
        <div id="screenshot"></div>
          <table id="example" class="table table-bordered table-hover">
              <div class="box-header">
                <h3 class="box-title"><b><u>Rotas cadastradas</u></b></h3>
              </div>
              <div class="box-body">
                <table id="example" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Rota</th>
                    <th>Veiculo</th>
                    <th>Motorista</th>
                    <th>Universidade</th>
                    <th>Turno</th>
                  </tr>
                  </thead>
                  <?php
                  do{
                    if ($linha3['rot_turno']=='M')
                    {
                      $linha3['rot_turno'] = 'Matutino';
                    }
                    else if ($linha3['rot_turno']=='V')
                    {
                      $linha3['rot_turno'] = 'Vespertino';
                    }
                    else 
                      $linha3['rot_turno'] = 'Noturno';

                      $mot_id = $linha3['mot_id'];
                      $sqlmot = "SELECT * FROM motorista WHERE mot_id = $mot_id";
                      $sql_querymot = $mysqli->query($sqlmot) or die ($mysqli->erro);
                      $motorista = $sql_querymot->fetch_assoc();

                      $uni_id = $linha3['uni_id'];
                      $sqluni = "SELECT * FROM universidade WHERE uni_id = $uni_id";
                      $sql_queryuni = $mysqli->query($sqluni) or die ($mysqli->erro);
                      $universidade = $sql_queryuni->fetch_assoc();
                    
                      $vei_id = $linha3['vei_id'];
                      $sqlvei = "SELECT * FROM veiculo WHERE vei_id = $vei_id";
                      $sql_queryvei = $mysqli->query($sqlvei) or die ($mysqli->erro);
                      $veiculo = $sql_queryvei->fetch_assoc();

                  ?>
                  <tr>
                    <td><?php echo $linha3['rot_nome']; ?></td>
                    <td><?php echo $veiculo['vei_nome']; ?></td>
                    <td><?php echo $motorista['mot_nome']; ?></td>
                    <td><?php echo $universidade['uni_nome']; ?></td>
                    <td><?php echo $linha3['rot_turno'] ?></td>
                  </tr>
                  </tbody>
                  <?php } while ($linha3 = $sql_query3->fetch_assoc()); ?>
                </table>
              </div>
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