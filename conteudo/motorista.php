<?php
  session_start();
  include("../entities/motorista/motoristacontroller.php"); 
  include("../geraLog.php");
  $_SESSION['erros'] = [];

  include($_SERVER['DOCUMENT_ROOT']."/herevan_proj/entities/support_functions.php");

  $_SESSION['create'] = true;
  $motorista = new MotoristaController();
  
  if(isset($_POST['cadastrar'])){
    
    $_SESSION['erros'] = $motorista->create($_POST['nome'], $_POST['sobrenome'], $_POST['nascimento'], $_POST['cpf'], $_POST['reg'], $_POST['tipo'], $_POST['validade'], @$_POST['sexo'], $_POST['telefone'], $_POST['email']);

    $nomeMotorista = $_POST['nome'];
    $emp_id = $_SESSION['emp_id'];
    
    if(!is_array($_SESSION['erros'])){

      logMsg( "Cadastrar Motoristas: A motorista $nomeMotorista acabou de ser cadastrado na aplicação pela empresa (ID: $emp_id)", 'info', '../logs/herevan.log' );
      echo '<script type="text/javascript"> window.location = "listamotorista.php" </script>';
  }
}
  else if(isset($_POST['atualizar'])){
    $_SESSION['create'] = false;
    $_SESSION['erros'] = $motorista->update(intval($_POST['mot_id']), $_POST['nome'], $_POST['sobrenome'], $_POST['nascimento'], $_POST['cpf'], $_POST['reg'], $_POST['tipo'], $_POST['validade'], @$_POST['sexo'], $_POST['telefone'], $_POST['email']);

    $idMotorista = $_POST['mot_id'];
    $emp_id = $_SESSION['emp_id'];

    if(!is_array($_SESSION['erros'])){

      logMsg( "Listar Motoristas: O cadastro do motorista (ID: $idMotorista) foi editado pela empresa (ID: $emp_id)", 'info', '../logs/herevan.log' );
      echo '<script type="text/javascript"> window.location = "listamotorista.php" </script>';
  }
}
  else if(isset($_GET['mot_id'])){
    $_SESSION['create'] = false;

    $mot = $motorista->getMotoristaById(intval($_GET['mot_id']));
    $_POST['nome'] = $mot['mot_nome'];
    $_POST['sobrenome'] = $mot['mot_sobrenome'];
    $_POST['nascimento'] = $mot['mot_nasc'];
    $_POST['cpf'] = $mot['mot_cpf'];
    $_POST['reg'] = $mot['mot_reg'];
    $_POST['tipo'] = $mot['mot_cartipo'];
    $_POST['validade'] = $mot['mot_validade'];
    $_POST['sexo'] = $mot['mot_sexo'];
    $_POST['telefone'] = $mot['mot_telefone'];
    $_POST['email'] = $mot['mot_email'];
  }

  $errorBorder = "style='border: 2px solid red'";

?>

<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Cadastro Motorista</title>
  </head>
  <body class="hold-transition skin-green sidebar-mini">

  <?php include 'headeradm.php';?>
  <?php include 'sideadm.php';?>

  <script src ="../assets/js/jquery-3.3.1.min.js" type ="text/javascript"></script>
  <script src ="../assets/js/jquery.mask.min.js" type ="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() {
    $("#cpf").mask("000.000.000-00");
    $("#telefonemotorista").mask("(00)0000-0000"); 
    $("#reg").mask("00000000000"); })
  </script>

    <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Cadastro de Motorista
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
        <li><a href="#">Motorista</a></li>
        <li class="active">Cadastrar Motorista</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
      <div class="col-md-6">
        <div class="box box">
          <div class="box-header">
            <h3 class="box-title">Dados do Motorista</h3>
          </div>
          <p>&ensp;(*) Campos de preenchimento obrigatório.</p>
          <form role="form" method="POST">
            <div class="box-body">

            <?php if(hasError("driver exists")) echo '<span class="error" style="color: red">Motorista já existe</span>'; ?>
			
			  
              <div class="form-group">
                <label for="nomemotorista">Nome</label>
                <p></p>
                <input type="text" name="nome" id="nome" value="<?php echo @$_POST[nome]; ?>" <?php if(hasError("nome")) echo $errorBorder ?> >
                <?php if(hasError("nome")) echo '<span class="error" style="color: red">Insira um nome valido</span>'; ?>

              </div>
			  <div class="form-group">
                <label for="sobrenome">Sobrenome</label>
                <p></p>
                <input type="text" name="sobrenome" id="sobrenome" value="<?php echo @$_POST[sobrenome]; ?>" <?php if(hasError("sobrenome")) echo $errorBorder ?>>
                <?php if(hasError("sobrenome")) echo '<span class="error" style="color: red">Insira um sobrenome valido</span>'; ?>
              </div>
			<div class="form-group">
			  
				<label>Data de Nascimento * </label>
				<p></p>
				
				<input type="date" name="nascimento"  size="10" maxlength="10" placeholder="DD/MM/AAAA"
				id="nascimento" value ="<?php echo @$_POST[nascimento]; ?>" <?php if(hasError("nascimento")) echo $errorBorder ?>>
				<?php if(hasError("nascimento")) echo '<span class="error" style="color: red">Insira uma data de nascimento válida</span>'; ?>

			
			</div>
			    
				<div class="form-group">
                <label for="cpfmotorista">CPF *</label>
                <p></p>
                <input type="text" name="cpf" id="cpf" size="12" maxlength="12" value="<?php echo @$_POST[cpf]; ?>" <?php if(hasError("cpf")) echo $errorBorder ?>>
                <?php if(hasError("cpf")) echo '<span class="error" style="color: red">Insira um CPF válido</span>'; ?>
              </div>
			<div class="form-group">		   
                
           
                <label for="regmotorista">N° Registro CNH * </label>
                <p></p>
                <input type="text" name="reg" id="reg" size="12" maxlenght="12" value="<?php echo @$_POST[reg]; ?>" <?php if(hasError("reg")) echo $errorBorder ?>> 
                <?php if(hasError("reg")) echo '<span class="error" style="color: red">Insira um registro válido</span>'; ?>
              </div>
              <div class="form-group">
			   
			   <label for="tipocarteira">Categoria</label>
			   <p></p>
			   <select name="tipo" <?php if(hasError("tipo")) echo $errorBorder ?>>
			   <option value="A" <?php if(@$_POST['tipo'] == 'A') echo "selected" ?>>A</option>
			   <option value="B" <?php if(@$_POST['tipo'] == 'B') echo "selected" ?>>B</option>
			   <option value="C" <?php if(@$_POST['tipo'] == 'C') echo "selected" ?>>C</option>
			   <option value="D" <?php if(@$_POST['tipo'] == 'D') echo "selected" ?>>D</option>
			   <option value="E" <?php if(@$_POST['tipo'] == 'E') echo "selected" ?>>E</option>
			   </select>
			   <br><br>
			   <?php if(hasError("tipo")) echo '<span class="error" style="color: red">Insira um tipo válido</span>'; ?>

			  </div>
              
			  <div class="form-group">
			  
			  <label> Validade</label>
			  <p></p>
			  
			  
			  <input type="date" name="validade" size="10" maxlength="10" placeholder="DD/MM/AAAA" id="validade" value="<?php echo @$_POST[validade];?>" <?php if(hasError("validade")) echo $errorBorder ?>>
			  <?php if(hasError("validade")) echo '<span class="error" style="color: red">Insira uma data válida</span>'; ?>
			  
			  </div>
			  
			  <div class="form-group">
			  <label for="sexomotorista"> Sexo * </label>
			  <p></p>
			  <?php $sexo = 'sexo';?> 
			  <input type="radio" name="sexo" value="M" <?php if(@$_POST['sexo'] == 'M') echo "checked" ?>> Masculino<br>
			  <input type="radio" name="sexo" value="F" <?php if(@$_POST['sexo'] == 'F') echo "checked" ?>> Feminino<br>
			  <?php if(hasError("sexo")) echo '<span class="error" style="color: red">Insira um sexo válido</span>'; ?>
			  </div>
			  <div class="form-group">
			  <label for="telefone"> Telefone * </label>
			  <p></p>
			  <input type="text" name="telefone" id= "telefonemotorista" maxlength = "11" value="<?php echo @$_POST[telefone];?>" <?php if(hasError("telefone")) echo $errorBorder ?>>
			  <?php if(hasError("telefone")) echo '<span class="error" style="color: red">Insira um telefone válido</span>'; ?>
			  </div>

			  <div class="form-group">
			  <label for="email"> E-mail *</label>
			  <p></p>
			  <input type="text" name="email" id="email" value="<?php echo @$_POST[email];?>" <?php if(hasError("email")) echo $errorBorder ?>>
			 	<?php if(hasError("email")) echo '<span class="error" style="color: red">Insira um e-mail valido</span>'; ?>
			  </div>

        

			 <?php
        if($_SESSION['create'])
          echo '<input type="submit" class="btn" name="cadastrar" id="cadastrar" value="Cadastrar">';
        else{
          $id = $_GET['mot_id'];
          echo '<input type="submit" class="btn" name="atualizar" id="atualizar" value="Atualizar"> <input type="hidden" name="mot_id" value='.$id.'> ';
        }
       ?>

        
        
          </div>

        </div>
        
        </form>
    </section>
    </div>


  </body>
</html>