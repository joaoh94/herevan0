<?php
  session_start();
  include($_SERVER['DOCUMENT_ROOT']."/herevan_proj/entities/motorista/motoristacontroller.php"); 
  $motorista = new MotoristaController();
  $linha = $motorista->getMotoristaById($_GET['mot_id']);
?>


<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Detalhes Motorista</title>
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <?php include 'headeradm.php';?>
    <?php include 'sideadm.php';?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Informação do Motorista
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
          <li><a href="#">Motoristas</a></li>
          <li class="active">Informação do Motoristas</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
            
              <div class="box-body">
                <table id="example" class="table table-bordered table-hover">
                  <thead>
                  
                  <strong>  Nome: </strong> <?php echo $linha['mot_nome']; ?><br>
					        <strong>  Sobrenome: </strong> <?php echo $linha['mot_sobrenome']; ?><br>
                  <strong>  Data de Nascimento: </strong> <?php echo $linha['mot_nasc']; ?><br>
					        <strong>  Documento Identidade: </strong> <?php echo $linha['mot_cpf']; ?><br>
					        <strong>  Numero de Registro da carteira: </strong> <?php echo $linha['mot_reg'];?><br>
					        <strong>  Tipo da Carteira: </strong> <?php echo $linha['mot_cartipo'];?><br>
					        <strong>  Validade da Carteira: </strong> <?php echo $linha['mot_validade']; ?><br>
					        <strong>  Sexo: </strong> <?php echo $linha['mot_sexo']; ?><br>
                  <strong>  Telefone: </strong> <?php echo $linha['mot_telefone']; ?><br>
                  <strong>  E-mail: </strong> <?php echo $linha['mot_email']; ?><br><br>
                    
                  <a href="listamotorista.php">Voltar &emsp;</a>
				          <a href="javascript:location.href='motorista.php?mot_id=<?php echo $linha['mot_id']; ?>';">Editar &emsp;</a>
                  <a href="javascript: if(confirm('Tem certeza que deseja deletar o Motorista <?php echo $linha['mot_nome']; ?>?'))
                  location.href='deletarmotorista.php?mot_id=<?php echo $linha['mot_id']; ?>';">Deletar &emsp;</a>
                  </thead>
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