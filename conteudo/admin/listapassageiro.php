<?php
  session_start();
  include("../../conexao/conexao.php");
  $sql_code = "SELECT * FROM passageiro";
  $sql_query = $mysqli->query($sql_code) or die ($mysqli->erro);
  
  $linha = $sql_query->fetch_assoc();
  $var = $linha['psg_id'];
?>

<html>
  <head>
  <link rel="shortcut icon" href="../../assets/imagens/favicon.png" />
  <title>Lista Passageiros Cadastrados</title>
  </head>
  <body class="hold-transition skin-green sidebar-mini">

    <?php include 'headeradm.php';?>
    <?php include 'sideadm.php';?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Passageiros
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
          <li><a href="#">Usuários Cadastrados</a></li>
          <li class="active">Passageiros</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Passageiros</h3>
              </div>
              <div class="box-body">
                <table id="example" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Cidade</th>
                    <th>Sexo</th>
                    <th>Telefone</th>
                    <th>Ação</th>
                  </tr>
                  </thead>
                  <?php
                  if ($linha['nome'] != null) {
                  do{
                  ?>
                  <tr>
                    <td><?php echo $linha['nome']; ?></td>
                    <td><?php echo $linha['cpf']; ?></td>
                    <td><?php echo $linha['cidade']; ?></td>
                    <td><?php echo $linha['sexo']; ?></td>
                    <td><?php echo $linha['telefone']; ?></td>
                    <td>
                    <a href="javascript: if(confirm('Tem certeza que deseja deletar este passageiro?'))
                  location.href='deletarpassageiro.php?psg_id=<?php echo $linha['psg_id']; ?>';">Deletar &emsp;</a>
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