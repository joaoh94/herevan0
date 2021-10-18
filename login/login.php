<?php 
session_start();
include("../entities/empresa/empresacontroller.php"); 
include("../entities/administrador/admincontroller.php");
include("../geraLog.php");
$empresa = new EmpresaController();
$admin = new AdminController();

if(isset($_SESSION['emp_id']))
  echo '<script type="text/javascript"> window.location = "../conteudo/adminHome.php" </script>';

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $us_admin = $admin->login($_POST['email'], $_POST['senha']);
  $us_tipo = $admin->getUsuarioFromUsTipo($us_admin);

  if($us_tipo == 'A'){

        $loginFail = false;

        logMsg( "O administrador (ID: $us_admin) acabou de realizar o login na aplicação", 'info', '../logs/herevanAdmin.log' );
      
        echo '<script type="text/javascript"> window.location = "../conteudo/admin/adminHome.php" </script>';
      
  }

  else {

  $us_id = $empresa->login($_POST['email'], $_POST['senha']);

  if($us_id){
    $_SESSION['us_id'] = $us_id;
    $_SESSION['emp_id'] = $empresa->getEmpresaFromUsId($us_id)['emp_id'];
    
    if($_SESSION['emp_id']){
      $loginFail = false;
      $loginPendente = false;

      logMsg( "O usuário (ID: $us_id) acabou de realizar o login na aplicação", 'info', '../logs/herevan.log' );
    
      echo '<script type="text/javascript"> window.location = "../conteudo/adminHome.php" </script>';

    }

    else {
      $loginPendente = true;
      logMsg( "O e-mail ".$_POST['email']." tentou realizar o login na aplicação - Cadastro pendente de aprovação.", 'warning', '../logs/herevan.log' );
    }
    
  }
  else{
    $loginFail = true;
    logMsg( "O e-mail ".$_POST['email']." tentou realizar o login na aplicação - E-mail ou senha incorretos.", 'warning', '../logs/herevan.log' );
  }

  }
}

?>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
      <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
		  <title>Login</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
      <link rel="stylesheet" href="login.css?v=3">
	</head>
		<body>
      <?php include '../header.php';?>
      <?php if(isset($loginFail) && $loginFail) echo "<div class='col-md-12' style='text-align: center; color: red; font-weight: bold; font-size: 30px;'>E-mail ou senha incorretos. Tente novamente.</div>" ?>
			<?php if(isset($loginPendente)) echo "<div class='col-md-12' style='text-align: center; color: gray; font-weight: bold; font-size: 30px;'>Seu cadastro está pendente de aprovação! Aguarde...</div>" ?>
      <div class="login">
				<form class="" method="post" action="#">
					<img src="../assets/imagens/login.png" alt="">
					<div class="form-input">
            <input type="text" required name="email" id="email" placeholder="E-mail">
          </div>
					<div class="form-input">
            <input type="password" required name="senha" id="senha" placeholder="Senha">
					</div>
					<input class="btn-login" type="submit" value="Entrar" name="entrar" id="entrar"><br>
					<a href="#" style="color: black;">Esqueci minha senha</a><br><br>
					<a href="../cadastroEmpresa/cadastro-empresa.php" style="color: black;"> <label>Ainda não tem conta?</label>  </a>
				</form>
			</div>
		</body>
</html>