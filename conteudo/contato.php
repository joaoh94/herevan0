<?php
  session_start();
  include("../conexao/conexao.php");

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    foreach ($_POST as $chave => $valor) 
        $_SESSION[$chave] = $mysqli->real_escape_string($valor); 
  
    $sql_mensagem = "INSERT INTO mensagem (
		emp_id,
		titulo,
		msg_text )
    VALUES(
		$_SESSION[emp_id],
		'$_SESSION[titulomsg]',
		'$_SESSION[mensagem]' )";

        //$confirma = $mysqli->query($sql_veiculo) or die ($mysqli->error);

        if($mysqli->query($sql_mensagem) === TRUE){
          echo '<script type="text/javascript"> window.location = "listacontato.php" </script>';
          foreach ($_POST as $chave => $valor) 
            $_SESSION[$chave] = "";

        }
        else
          echo $mysqli->error;
  }
?>

<html>

  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Fale Conosco</title>
  </head>
  <body class="hold-transition skin-green sidebar-mini">

  <?php include 'headeradm.php';?>
  <?php include 'sideadm.php';?>

    <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Fale Conosco
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
        <li><a href="#">Outros</a></li>
        <li class="active">Fale Conosco</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
      <div class="col-md-6">
        <div class="box box">  
        <div class="box-header">
            <h3 class="box-title">Fale Conosco</h3>
          </div>
          <form role="form" method="POST">
          <div class="box-body">
            <div class="form-group">
				      <label for="titulo"> Titulo:</label>
              <br>
				      <input type="text" name="titulomsg" id="titulomsg" value="<?php echo @$_SESSION[titulomsg]; ?>"required>
              <br>
            </div>
            <div class="form-group">
              <label for="mensagem">Mensagem</label>
              <br>
              <textarea name="mensagem" rows="10" cols="30"><?php echo @$_SESSION[mensagem]; ?></textarea>
              <br>
        </div>
			  <input type="submit" class="btn" name="enviar" id="enviar" value="Confirmar">
			  </div>
    </div>
              </div>
			
        </div>
        
        </form>
    </section>
    </div>
  </body>
</html>