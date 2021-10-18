<?php
  session_start();
  include("../../conexao/conexao.php");
  $sql_code = "SELECT * FROM empresa WHERE emp_status_solicitacao = 'A'"; // Variável emp_solicitacao - P->Pendente | A->Aprovada | R->Reprovada
  $sql_query = $mysqli->query($sql_code) or die ($mysqli->erro);
  
  $linha = $sql_query->fetch_assoc();
  $var = $linha['emp_id'];
?>

<html>
  <head>
  <link rel="shortcut icon" href="../../assets/imagens/favicon.png" />
  <title>Lista Empresas Cadastradas</title>
  </head>
  <body class="hold-transition skin-green sidebar-mini">

    <?php include 'headeradm.php';?>
    <?php include 'sideadm.php';?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Empresas
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
          <li><a href="#">Usuários Cadastrados</a></li>
          <li class="active">Empresas</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Empresas</h3>
              </div>
              <div class="box-body">
                <table id="example" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Nome Fantasia</th>
                    <th>CNPJ</th>
                    <th>Razão Social</th>
                    <th>Inscrição Estadual</th>
                    <th>Ação</th>
                  </tr>
                  </thead>
                  <?php
                  if ($linha['emp_nome_fantasia'] != null) {
                  do{
                  ?>
                  <tr>
                    <td><?php echo $linha['emp_nome_fantasia']; ?></td>
                    <td><?php echo $linha['emp_cnpj']; ?></td>
                    <td><?php echo $linha['emp_razao_social']; ?></td>
                    <td><?php echo $linha['emp_inscricao_estadual']; ?></td>
                    <td>
                    <a href="javascript: if(confirm('Tem certeza que deseja deletar esta empresa?'))
                  location.href='deletarempresa.php?emp_id=<?php echo $linha['emp_id']; ?>';">Deletar &emsp;</a>
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