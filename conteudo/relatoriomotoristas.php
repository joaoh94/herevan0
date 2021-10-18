<?php
  session_start();
  include("../conexao/conexao.php");
 
  $sql = "SELECT * FROM motorista WHERE emp_id=".$_SESSION['emp_id'].' order by mot_nome';
  $sql_query = $mysqli->query($sql) or die ($mysqli->erro);
  $linha = $sql_query->fetch_assoc();
?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Relatório Motoristas</title>
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
                      <h3 class="box-title"><b><u>Motoristas cadastrados</u></b></h3>  
                      <div class="box-body">
                        <table id="example" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>Nome</th>
                            <th>CNH</th>
                            <th>Categoria</th>
                            <th>Data de nascimento</th>
                            <th>Sexo</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                          </tr>
                          </thead>
                          <?php
                          do{
                          ?>
                          <tr>
                            <td><?php echo $linha['mot_nome']; ?></td>                            
                            <td><?php echo $linha['mot_reg']; ?></td>
                            <td><?php echo $linha['mot_cartipo']; ?></td>
                            <td><?php echo $linha['mot_nasc'] ?></td>
                            <td><?php echo $linha['mot_sexo']; ?></td>
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