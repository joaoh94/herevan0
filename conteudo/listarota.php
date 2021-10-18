<?php
  session_start();
  include("../conexao/conexao.php");

  $emp_id = $_SESSION['emp_id'];

  //echo $emp_id;

  $sql_code = "SELECT r.emp_id, r.rot_id, r.rot_nome, v.vei_nome, m.mot_nome, u.uni_nome, r.rot_turno, r.rot_preco FROM Rota r, Veiculo v, Motorista m, Universidade u where r.emp_id = $emp_id and r.vei_id = v.vei_id and r.mot_id = m.mot_id and r.uni_id = u.uni_id order by r.rot_nome";

  $sql_query = $mysqli->query($sql_code) or die ($mysqli->erro);
  
  $linha = $sql_query->fetch_assoc();
?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Lista Rotas</title>
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
          <li><a href="#">Rotas</a></li>
          <li class="active">Listar Rotas</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Rotas</h3>
				<form action="listarota_filtro.php" method="get">
				<br>Buscar: <input type="text" name="filtro" required>
				<input type="submit" value="Buscar">
              </div>
              <div class="box-body">
                <table id="example" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Veiculo</th>
                    <th>Motorista</th>
                    <th>Universidade</th>
                    <th>Turno</th>
                    <th>Preço</th>
                    <th>Ação</th>
                  </tr>
                  </thead>
                  <?php
                  if ($linha['rot_nome'] != null) {
                  do{
                  ?>
                  <tr>
                    <td><?php echo $linha['rot_nome']; ?></td>
                    <td><?php echo $linha['vei_nome']; ?></td>
                    <td><?php echo $linha['mot_nome']; ?></td>
                    <td><?php echo $linha['uni_nome']; ?></td>
                    <td><?php if($linha['rot_turno'] == 'M') echo 'Matutino'; else if($linha['rot_turno'] == 'V') echo 'Vespertino'; else if($linha['rot_turno'] == 'N') echo "Noturno" ?></td>
                    <td><?php echo $linha['rot_preco']; ?></td>
                    <td>
                    <a href="javascript:location.href='rota.php?id=<?php echo $linha['rot_id']; ?>';">Editar &emsp;</a>
                    <a href="javascript: if(confirm('Tem certeza que deseja deletar a rota ?'))
                  location.href='deletarrota.php?rot_id=<?php echo $linha['rot_id']; ?>';">Deletar &emsp;</a>
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
