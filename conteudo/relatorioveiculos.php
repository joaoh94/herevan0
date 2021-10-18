<?php
  session_start();
  include("../conexao/conexao.php");
  
  $sql2 = "SELECT * FROM veiculo WHERE emp_id =".$_SESSION['emp_id'].' order by vei_nome ';
  $sql_query2 = $mysqli->query($sql2) or die ($mysqli->erro);
  $linha2 = $sql_query2->fetch_assoc();
?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Relatório Veiculos</title>
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
                <h3 class="box-title">  <b><u>Veículos cadastrados</u></b></h3>  
                      <div class="box-body">
                        <table id="example" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                    <th>Nome do Automóvel</th>
                    <th>Marca</th>
                    <th>Ano/Modelo</th>
                    <!--<th>Quantidade de lugares</th>-->
                    <th>Placa</th>
                  </tr>
                  </thead>
                  <?php
                  do{
                  ?>
                  <tr>
                    <td><?php echo $linha2['vei_nome']; ?></td>
                    <td><?php echo $linha2['vei_marca']; ?></td>
                    <td><?php echo $linha2['vei_ano_modelo']; ?></td>
                    <!--<td><?php echo $linha2['vei_lugares']; ?></td>-->
                    <td><?php echo $linha2['vei_placa']; ?></td>
                  </tr>
                        </tbody>
                        <?php } while ($linha2 = $sql_query2->fetch_assoc()); ?>
                        </table>
                      </div>

                      


                    </tr>
                    
         
                  
                </table>
              </div>
              <!-- /.box-body index.php?go=editar&usuario-->
            </div>
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </body>
</html>