<?php
  session_start();
  include("../conexao/conexao.php");
   $sql = "SELECT * 
   FROM motorista 
   inner JOIN rota 
   ON motorista.mot_id=rota.mot_id 
   WHERE rota.emp_id =".$_SESSION['emp_id'].' order by mot_nome ';
  $sql_query = $mysqli->query($sql) or die ($mysqli->erro);
  $linha = $sql_query->fetch_assoc();  
?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Relatório Motoristas com veiculos</title>
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
                <h3 class="box-title">Motoristas</h3>
				
              </div>
              <div class="box-body">
			  <h4>
				<a title='Imprimir conteúdo' href='javascript:window.print()'><span class="glyphicon glyphicon-print"></span></a> </h4>
				
<div id="screenshot"></div>
                <table id="example" class="table table-bordered table-hover">

                    <div class="box-header">  
                      <h3 class="box-title"><b><u>Motoristas com veículos</u></b></h3>  
                      <div class="box-body">
                        <table id="example" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Veículo</th>
                            <th>Turno</th>                            
                            <th>Telefone</th>
                            <th>E-mail</th>
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

                              $vei_id = $linha['vei_id'];

                              $sqlvei = "SELECT * FROM veiculo WHERE vei_id = $vei_id";
                              $sql_queryvei = $mysqli->query($sqlvei) or die ($mysqli->erro);
                              $veiculo = $sql_queryvei->fetch_assoc();
                          ?>
                          <tr>
                            <td><?php echo $linha['mot_nome']; ?></td>
                            <td><?php echo $veiculo['vei_nome']; ?></td>
                            <td><?php echo $linha['rot_turno']; ?></td>                            
                            <td><?php echo $linha['mot_telefone']; ?></td>
                            <td><?php echo $linha['mot_email']; ?></td>
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