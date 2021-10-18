<?php
  session_start();
  include("../conexao/conexao.php");
  $sql_code = "SELECT * FROM Veiculo WHERE emp_id = ".$_SESSION['emp_id'];

  $sql_query = $mysqli->query($sql_code) or die ($mysqli->erro);
  $linha = $sql_query->fetch_assoc();

?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Lista Veiculos</title>
  </head>
  <body class="hold-transition skin-green sidebar-mini">

    <?php include 'headeradm.php';?>
    <?php include 'sideadm.php';?>


    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Lista
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
          <li><a href="#">Veiculos</a></li>
          <li class="active">Listar Veiculos</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Veiculos</h3>
              </div>
			  <div class="box-header">
               <form action="listaveiculo_filtro.php" method="get">
				<br>Buscar: <input type="text" name="filtro" required>
				<input type="submit" value="Buscar">
              </div>
              <div class="box-body">
                <table id="example" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Nome do Automóvel</th>
					          <th>Marca</th>
                    <th>Ano</th>
                    <!--<th>Quantidade de lugares</th>-->
                    <th>Placa</th>
					          <!--<th>Motorista</th>-->
                    <th>Ação</th>
                  </tr>
                  </thead>
                  <?php
                  if ($linha['vei_nome'] != null) {
                  do{
                  ?>
                  <tr>
                    <td><?php echo $linha['vei_nome']; ?></td>
					          <td><?php echo $linha['vei_marca']; ?></td>
                    <td><?php echo $linha['vei_ano_modelo']; ?></td>
                    <!--<td><?php echo $linha['vei_lugares']; ?></td>-->
                    <td><?php echo $linha['vei_placa']; ?></td>
					          <!--<td><?php echo $linha['vei_motorista'];?></td>-->
                    <td>
					          <a href="javascript:location.href='informacaoveiculo.php?mot_id=<?php echo $linha['vei_id']; ?>';">Ver &emsp;</a>
                    <a href="javascript: location.href='editarveiculo.php?vei_id=<?php echo $linha['vei_id']; ?>';">Editar &emsp;</a>
                    <a href="javascript: if(confirm('Tem certeza que deseja deletar o Veiculo <?php echo $linha['vei_nome']; ?>?'))
                  location.href='deletarveiculo.php?vei_id=<?php echo $linha['vei_id']; ?>';">Deletar &emsp;</a>
                  </td>
                  </tr>
                  </tbody>
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
