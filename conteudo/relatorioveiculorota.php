<?php
  session_start();
  include("../conexao/conexao.php");
  $sql = "SELECT * 
   FROM veiculo 
   inner JOIN rota 
   ON veiculo.vei_id=rota.vei_id 
   WHERE rota.emp_id =".$_SESSION['emp_id'].' order by vei_nome';
  $sql_query = $mysqli->query($sql) or die ($mysqli->erro);
  $linha = $sql_query->fetch_assoc();
?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Relatório Veiculos com rotas</title>
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
                <h3 class="box-title">Veículos</h3>
				
              </div>
              <div class="box-body">
			  <h4>
				<a title='Imprimir conteúdo' href='javascript:window.print()'><span class="glyphicon glyphicon-print"></span></a> </h4>
				
        <div id="screenshot"></div>
                <table id="example" class="table table-bordered table-hover">

                    <div class="box-header">  
                      <h3 class="box-title"><b><u>Veículos com rotas</u></b></h3>  
                      <div class="box-body">
                        <table id="example" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Veículo</th>
                            <th>Motorista</th>                            
                            <th>Universidade</th>
                            <th>Turno</th>
                          </tr>
                          </thead>
                          <?php
                          do{
                            if ($linha['rot_turno']=='M')
                            {
                              $linha['rot_turno'] = 'Matutino';
                            }
                            else if ($linha['rot_turno']=='V')
                            {
                              $linha['rot_turno'] = 'Vespertino';
                            }
                            else 
                              $linha['rot_turno'] = 'Noturno';

                              $mot_id = $linha['mot_id'];
                              $sqlmot = "SELECT * FROM motorista WHERE mot_id = $mot_id";
                              $sql_querymot = $mysqli->query($sqlmot) or die ($mysqli->erro);
                              $motorista = $sql_querymot->fetch_assoc();
                            
                              $uni_id = $linha['uni_id'];
                              $sqluni = "SELECT * FROM universidade WHERE uni_id = $uni_id";
                              $sql_queryuni = $mysqli->query($sqluni) or die ($mysqli->erro);
                              $universidade = $sql_queryuni->fetch_assoc();
                          ?>
                          <tr>
                            <td><?php echo $linha['rot_nome']; ?></td>
                            <td><?php echo $linha['vei_nome']; ?></td>
                            <td><?php echo $motorista['mot_nome']; ?></td>
                            <td><?php echo $universidade['uni_nome']; ?></td>
                            <td><?php echo $linha['rot_turno']; ?></td>
                        </tr>
                        </tbody>
                        <?php } while ($linha = $sql_query->fetch_assoc()); ?>
                        </table>
                      </div>
                    </tr>
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