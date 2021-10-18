<?php
  session_start();
  include("../conexao/conexao.php");

  $a = $_GET['a'];
 

if ($a == "buscar") {
 
	$palavra = trim($_POST['palavra']);
 
	
	$sql = mysql_query("SELECT * FROM Motorista WHERE mot_nome LIKE '%".$palavra."%' ORDER BY mot_nome");
 
	
	$numRegistros = mysql_num_rows($sql);
 
	/
	if ($numRegistros != 0) {
		while ($produto = mysql_fetch_object($sql)) {
			echo $produto->mot_nome;
		}
	// Se não houver registros
	} else {
		echo "Nenhum motorista foi encontrado ".$palavra."";
	}
}
  $sql_query = $mysqli->query($sql) or die ($mysqli->erro);
$linha = $sql_query->fetch_assoc();

?>

<html>
  <head>
 <body class="hold-transition skin-green sidebar-mini">
    <?php include 'headeradm.php';?>
    <?php include 'sideadm.php';?>
 <form name="form1" method="post" action="">
  <label>
  <input name="cxnome" type="text" id="cxnome" value="" size="30">
  </label>
  <label></label>
 
  <label>
  &nbsp;&nbsp;
  <input type="submit" name="pesquisar" value="Pesquisar">
  </label>
&nbsp;
<label>
<input type="reset" name="Submit2" value="Limpar">
</label>
</form>
	
	
	
	
	
	
	</body>

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
          <li class="active">Buscar Motoristas</li>
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
                  do{
                  ?>
                  <tr>
                    <td><?php echo $linha['mot_nome']; ?></td>
                    <td><?php echo $linha['mot_nasc']; ?></td>
					<td><?php echo $linha['mot_rg']; ?></td>
                    <td><?php echo $linha['mot_sexo']; ?></td>
                    <td><?php echo $linha['mot_telefone']; ?></td>
                    <td><?php echo $linha['mot_email']; ?></td>
                    <td>
                    <a href="javascript:location.href='editarmotorista.php?mot_id=<?php echo $linha['mot_id']; ?>';">Editar &emsp;</a>
                  location.href='deletarmotorista.php?mot_id=<?php echo $linha['mot_id']; ?>';">Deletar &emsp;</a>
                    <a href="javascript: if(confirm('Tem certeza que deseja deletar o Motorista <?php echo $linha['mot_nome']; ?>?'))
                  </td>
                </tr>
                </tbody>
                <?php } while ($linha = $sql_query->fetch_assoc()); ?>
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