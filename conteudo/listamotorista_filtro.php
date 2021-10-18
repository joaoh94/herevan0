<?php
  session_start();
  include("../conexao/conexao.php");

$nome = $_GET["filtro"];

$emp_id = $_SESSION['emp_id'];
  
$sql = "SELECT * FROM motorista where (mot_nome LIKE '%$nome%' OR mot_nasc LIKE '%$nome%' OR mot_cpf LIKE '%$nome%' OR mot_sexo LIKE '$nome' OR mot_telefone LIKE '%$nome%' OR mot_email LIKE '%$nome%') AND emp_id = $emp_id";
 
$sql_query = $mysqli->query($sql) or die ($mysqli->erro);
$linha = $sql_query->fetch_assoc();
?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Lista Motoristas</title>
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
          <li><a href="#">Motoristas</a></li>
          <li class="active">Listar Motoristas</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Motoristas</h3>
				<br>
				
              </div>
              <div class="box-body">
                <table id="example" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Nascimento</th>
					          <th>Documento Identidade </th>
                    <th>Sexo</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Ação</th>
                  </tr>
                  </thead>
                  <?php
                  if ($linha['mot_nome'] != null) {
                  do{
                  ?>
                  <tr>
                    <td><?php echo $linha['mot_nome']; ?></td>
                    <td><?php echo $linha['mot_nasc']; ?></td>
					          <td><?php echo $linha['mot_cpf']; ?></td>
                    <td><?php echo $linha['mot_sexo']; ?></td>
                    <td><?php echo $linha['mot_telefone']; ?></td>
                    <td><?php echo $linha['mot_email']; ?></td>
                    <td>
					          <a href="javascript:location.href='informacaomotorista.php?mot_id=<?php echo $linha['mot_id']; ?>';">Ver &emsp;</a>
                    <a href="javascript:location.href='editarmotorista.php?mot_id=<?php echo $linha['mot_id']; ?>';">Editar &emsp;</a>
                    <a href="javascript: if(confirm('Tem certeza que deseja deletar o Motorista <?php echo $linha['mot_nome']; ?>?'))
                  location.href='deletarmotorista.php?mot_id=<?php echo $linha['mot_id']; ?>';">Deletar &emsp;</a>
                  </td>
                </tr>
                </tbody>
                <?php } while ($linha = $sql_query->fetch_assoc()); }?>
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