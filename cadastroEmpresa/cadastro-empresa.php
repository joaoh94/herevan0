<?php
session_start();
include("../entities/empresa/empresacontroller.php"); 
include("../geraLog.php");
?>

<?php
  $_SESSION['erros'] = [];
  include($_SERVER['DOCUMENT_ROOT']."/herevan_proj/entities/support_functions.php");

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $empresa = new EmpresaController();
    $_SESSION['erros'] = $empresa->create($_POST['email'], $_POST['senha'], $_POST['confirmar'], $_POST['nome'], $_POST['cnpj'], $_POST['razao'], $_POST['inscricao'], $_POST['telefone']);

    $nomeEmpresa = $_POST['nome'];

    if(!is_array($_SESSION['erros'])){

      logMsg( "A empresa $nomeEmpresa realizou o cadastro na aplicação", 'info', '../logs/herevan.log' );
      
      echo '<script type="text/javascript"> window.location = "/herevan_proj/cadastroEmpresa/confirmacao.php" </script>';
    }
  }

  $errorBorder = "style='border: 3px solid red'";

?>

<html lang="pt-br">
  <head>

    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
      <title>Cadastro</title>
      <?php 
	  
         $erro[] = " "; 
          if (count($erro) > 0)
          { 
            echo "<div class = 'erro'>"; 
              foreach ($erro as $valor) 
                echo "$valor <br>";
            echo  "</div>";
          }
      ?>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
      <link rel="stylesheet" href="cadastro-empresa.css">
      <script src ="../assets/js/jquery-3.3.1.min.js" type ="text/javascript"></script>
      <script src ="../assets/js/jquery.mask.min.js" type ="text/javascript"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          $("#cnpj").mask("00.000.000/0000-00");
          $("#inscricao").mask("000.000.000.000");
          $("#telefone").mask("(00)0000-0000");
        })
      </script>

      <style>

      .wrong{
        border: 3px solid red
      }

.main{
  margin:10px 15px;
}

.form-control {
    height: auto!important;
padding: 8px 12px !important;
}

.main-center{
  margin-top: 30px;
  margin: 0 auto;
  max-width: 500px;
    padding: 10px 40px;
  background:#337ab7;
      color: #FFF;
    text-shadow: none;
  -webkit-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);
-moz-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);
box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);

}

.login-button{
  border-color: white;
  margin-top: 5px;

}

.login-register{
  font-size: 11px;
  text-align: center;
}

      </style>

  </head>
    <body>
      <?php include '../header.php';?>

      <div class="container">
      <div class="row main">
        <?php if(hasError("user exists")) echo "<div class='col-md-12' style='text-align: center; color: red; font-weight: bold; font-size: 30px;'>Empresa/e-mail já existe</div>" ?>
        
      </div>
      <div class="row main">

        <div class="main-login main-center">
        <h5>Cadastre-se e veja como é fácil gerenciar seu negócio de transporte universitário</h5>
          <form class="" method="post" action="#">
            
            <div class="form-group">
              <label for="name" class="cols-sm-2 control-label">Nome Fantasia</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" <?php if(hasError("nome")) echo $errorBorder; ?>  name="nome" id="name" value="<?php echo @$_POST[nome]; ?>"  placeholder="Insira o nome fantasia de sua empresa"/>
                </div>
              </div>
              <?php if(hasError("nome")) echo '<span class="error" style="color: red">Insira um nome valido</span>'; ?>
            </div>

            <div class="form-group">
              <label for="email" class="cols-sm-2 control-label">CNPJ</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" <?php if(hasError("cnpj")) echo $errorBorder; ?> name="cnpj" id="cnpj" value="<?php echo @$_POST[cnpj]; ?>"  placeholder="Insira o CNPJ de sua empresa"/>
                </div>
              </div>
              <?php if(hasError("cnpj")) echo '<span class="error" style="color: red">Insira um CNPJ válido</span>'; ?>
            </div>

            <div class="form-group">
              <label for="username" class="cols-sm-2 control-label">Razão Social</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" <?php if(hasError("razao")) echo $errorBorder; ?> name="razao" id="razao" value="<?php echo @$_POST[razao]; ?>" placeholder="Insira a razão social de sua empresa"/>
                </div>
              </div>
              <?php if(hasError("razao")) echo '<span class="error" style="color: red">Insira uma razão social válida</span>'; ?>
            </div>

            <div class="form-group">
              <label for="username" class="cols-sm-2 control-label">N° Inscrição Est.</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" <?php if(hasError("inscricao")) echo $errorBorder; ?> name="inscricao" id="inscricao" value="<?php echo @$_POST[inscricao]; ?>" placeholder="Insira a inscrição estadual de sua empresa"/>
                </div>
              </div>
              <?php if(hasError("inscricao")) echo '<span class="error" style="color: red">Insira uma Inscrição Estadual válida</span>'; ?>
            </div>

            <div class="form-group">
              <label for="username" class="cols-sm-2 control-label">Telefone</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" <?php if(hasError("telefone")) echo $errorBorder; ?> name="telefone" id="telefone" value="<?php echo @$_POST[telefone]; ?>" placeholder="Insira um número de telefone para contato"/>
                </div>
              </div>
              <?php if(hasError("telefone")) echo '<span class="error" style="color: red">Insira um telefone válido</span>'; ?>
            </div>

            <div class="form-group">
              <label for="username" class="cols-sm-2 control-label">E-mail</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" <?php if(hasError("email")) echo $errorBorder; ?> name="email" id="email" value="<?php echo @$_POST[email]; ?>" placeholder="Insira um e-mail válido"/>
                </div>
              </div>
              <?php if(hasError("email")) echo '<span class="error" style="color: red">Insira um e-mail válido</span>'; ?>
            </div>


            <div class="form-group">
              <label for="password" class="cols-sm-2 control-label">Senha</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" <?php if(hasError("senha")) echo $errorBorder; ?> name="senha" id="senha" value="<?php echo @$_POST[senha]; ?>" placeholder="Digite uma senha"/>
                </div>
              </div>
              <?php if(hasError("senha")) echo '<span class="error" style="color: red">Insira uma senha válida</span>'; ?>
            </div>

            <div class="form-group">
              <label for="confirm" class="cols-sm-2 control-label">Confirmar Senha</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" <?php if(hasError("confirmar")) echo $errorBorder; ?> name="confirmar" id="confirmar" value="<?php echo @$_POST[confirmar]; ?>" placeholder="Confirme a senha digitada acima"/>
                </div>
              </div>
              <?php if(hasError("confirmar")) echo '<span class="error" style="color: red">As senhas precisam ser iguais</span>'; ?>
            </div>

            <div class="form-group ">
              <input type="submit" value="Cadastrar" class="btn btn-primary btn-lg btn-block login-button">
            </div>
            
          </form>
        </div>
      </div>
    </div>


      <!-- ABAIXO: VALIDAR PARA FORM ACIMA -->

      <!-- <div class="cadastro">
        <form method="POST" action="?go=cadastrar" >
          <img src="../assets/login.png" alt="">
          <h1>Cadastro Empresarial</h1>
          <br/>
          <div class="form-input">
            <strong><label class="labelMenor">Nome Fantasia</label></strong>
            <br><br>
            <input required type="text" name="nomeFantasia" value="<?php echo @$_SESSION[nomeFantasia]; ?>">
          </div>
          <div class="form-input">
            <strong><label>CNPJ</label></strong>
            <br><br>
            <input required type="text" name="cpnj" value="<?php echo @$_SESSION[cpnj]; ?>">
          </div>
          <div class="form-input">
            <strong><label class="labelRazao">Razão Social</label></strong>
            <br><br>
            <input required type="text" name="razaoSocial" value="<?php echo @$_SESSION[razaoSocial]; ?>">
          </div>
          <div class="form-input">
            <strong><label class="labelMaior">Inscrição Estadual</label></strong>
            <br><br>
            <input required type="text" name="inscricaoEstadual" placeholder="" value="<?php echo @$_SESSION[inscricaoEstadual]; ?>">
          </div>
          <div class="form-input">
            <strong><label>E-mail</label></strong>
            <br><br>
            <input required type="email" name="email" value="<?php echo @$_SESSION[email]; ?>">
          </div>
          <div class="form-input">
            <strong><label>Senha</label></strong>
            <br><br>
            <input required type="password" name="senha" value="<?php echo @$_SESSION[senha]; ?>">
          </div>
          <br>
          <div class="form-input">
            <strong><label class="labelMaior">Confirma a senha</label></strong>
            <br>
            <input required type="password" name="senhaconfirmacao" placeholder="" value="<?php echo @$_SESSION[senhaconfirmacao]; ?>">
          </div>
          <br>
          <input class="btn-cadastro" type="submit" value="Cadastrar" name="cadastrar">&nbsp;&nbsp; 
          <input class="btn-cadastro" type="reset" value="Limpar">
          <br>
          <br>
          <a href="../login/login.php">Já sou cadastrado</a>
        </form> -->
      </div>
    </body>
</html>
