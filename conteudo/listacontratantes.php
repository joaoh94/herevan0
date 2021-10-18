<?php
  session_start();
  include("../conexao/conexao.php");

  $emp_id = $_SESSION['emp_id'];

  $sql_code = "SELECT * FROM Contrato WHERE emp_id = $emp_id";
  $sql_query = $mysqli->query($sql_code) or die ($mysqli->erro);
  $linha = $sql_query->fetch_assoc();  

?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Cadastro</title>
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    
    <?php include 'headeradm.php';?>
    <?php include 'sideadm.php';?>
    
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Contratantes
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
        <li><a href="#">Contratos</a></li>
        <li class="active">Contratantes</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Contratantes</h3>
            </div>
            <div class="box-body">
              <table id="example" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Número do Contrato</th>
                  <th>Nome da Rota</th>
                  <th>Nome do Contrante</th>
                  <th>Valor da Mensalidade</th>
                  <th>Ação</th>
                </tr>
                </thead>
                <?php
                if ($linha['cont_id'] != null) {
                do{
                  $psg_id = $linha['psg_id'];   
                  $sql_passageiro = "SELECT nome FROM Passageiro WHERE psg_id = $psg_id";
                  $sql_passageiroquery = $mysqli->query($sql_passageiro) or die ($mysqli->erro);
                  $passageiro = $sql_passageiroquery->fetch_assoc();
                
                  $rot_id = $linha['rot_id'];
                  $sql_rota = "SELECT rot_preco, rot_nome, emp_id FROM Rota WHERE rot_id = $rot_id";
                  $sql_rotaquery = $mysqli->query($sql_rota) or die ($mysqli->erro);
                  $rota = $sql_rotaquery->fetch_assoc();
                ?>
                <tr>
                  <td><?php echo $linha['cont_id']; ?></td>
                  <td><?php echo $rota['rot_nome']; ?></td>
                  <td><?php echo $passageiro['nome']; ?></td>
                  <td> R$ <?php echo $rota['rot_preco']; ?></td>
                  <td>
                  <a href="#">Excluir</a>
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
