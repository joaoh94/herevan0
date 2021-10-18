<?php

include("../conexao.php");

$usu_cpf = intval($_GET['cpf']);

if(@$_GET['go'] == 'confirmar') {

      // 1- Registro dos dados
      if (!isset($_SESSION)) 
      session_start();

      foreach ($_POST as $chave => $valor) 
        $_SESSION[$chave] = $mysqli->real_escape_string($valor); 

      // 2- Validação dos dados
      if (strlen($_SESSION['nomecompleto']) == 0)  
        $erro[] = "Preencha a campo Nome Completo.";

      if (strlen($_SESSION['dataNascimento']) == 0)  
        $erro[] = "Preencha a campo Data de Nascimento.";

      if (strlen($_SESSION['sexo']) == 0)  
        $erro[] = "Preencha a campo Sexo.";

      if (strlen($_SESSION['cpf']) == 0)  
        $erro[] = "Preencha a campo CPF.";

      if (strlen($_SESSION['rg']) == 0)  
        $erro[] = "Preencha a campo RG.";

      if (substr_count($_SESSION['email'], '@') != 1 || substr_count($_SESSION['email'], '.') < 1 || substr_count($_SESSION['email'], '.') > 2 )
        $erro[] = "Preencha a campo e-mail corretamente.";


      //Dados Endereço
      if (strlen($_SESSION['rua']) == 0)  
        $erro[] = "Preencha a campo Rua.";

      if (strlen($_SESSION['numero']) == 0)  
        $erro[] = "Preencha a campo Numero.";

      if (strlen($_SESSION['bairro']) == 0)  
        $erro[] = "Preencha a campo Bairro.";

      if (strlen($_SESSION['estado']) == 0)  
        $erro[] = "Preencha a campo Estado.";

      if (strlen($_SESSION['cidade']) == 0)  
        $erro[] = "Preencha a campo Cidade.";

      if (strlen($_SESSION['cep']) == 0)  
        $erro[] = "Preencha a campo CEP.";
      

      // 3 - Inserção no Banco e redirecionamento
      if (count($erro) == 0) {

        //$senha = md5(md5($_SESSION['senha']));--

        $sql_pfisica = "UPDATE pessoa_fisica SET
        nome_completo = '$_SESSION[nomecompleto]', 
        sexo = '$_SESSION[sexo]', 
        email = '$_SESSION[email]',
        cpf = '$_SESSION[cpf]',
        rg = '$_SESSION[rg]'
        WHERE cpf = '$usu_cpf'";

        /*$sql_endereco = "INSERT INTO endereco (
        rua, 
        numero,
        bairro,
        estado,
        cidade,
        pais,
        cep,
        complemento,
        telefone
        )
        VALUES(
        '$_SESSION[rua]',
        '$_SESSION[numero]',
        '$_SESSION[bairro]',
        '$_SESSION[estado]',
        '$_SESSION[cidade]',
        '$_SESSION[pais]',
        '$_SESSION[cep]',
        '$_SESSION[complemento]',
        '01010101'
        )";*/


        $confirma = $mysqli->query($sql_pfisica) or die ($mysqli->error);

        //$confirma1 = $mysqli->query($sql_endereco) or die ($mysqli->error);

        /*if ($confirma and $confirma1 and $confirma2) {
          unset($_SESSION[RazaoSocial],
          $_SESSION[NomeFantasia],
          $_SESSION[CNPJ],
          $_SESSION[bairro],
            $_SESSION[cep],
            $_SESSION[cidade],
            $_SESSION[estado],
            $_SESSION[complemento],
            $_SESSION[numero],
            $_SESSION[pais],
            $_SESSION[rua],
            $_SESSION[ContatoTelefonico],
            $_SESSION[email],
              $_SESSION[senha]);
         
          echo "<script>alert('CADASTRO EFETUADO COM SUCESSO');location.href = 'login.php';</script>";  

        }*/

        if ($confirma) {
          echo "<script>alert('CADASTRO EFETUADO COM SUCESSO');location.href = 'login.php';</script>";  
        }

        else
          $erro[] = $confirma;

        }
       
      }

      else{

        $sql_code = "SELECT nome_completo FROM pessoa_fisica WHERE cpf = '$usu_cpf'";
        $sql_query = $mysqli->query($sql_code) or die ($mysqli->erro);
        $linha = $sql_query->fetch_assoc();

        if (!isset($_SESSION)) 
        session_start();


        @$_SESSION[nomecompleto] = $linha['nomecompleto'];
        @$_SESSION[sexo] = $linha['sexo'];
        @$_SESSION[email] = $linha['email']; 
        @$_SESSION[cpf] = $linha['cpf'];
        @$_SESSION[rg] = $linha['rg'];
    }

?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GESTUVAN</title>
  <?php 

echo "AQUI $_SESSION[nomecompleto]";

   $erro[] = " "; 
  if (count($erro) > 0){ 
    echo "<div class = 'erro'>"; 
    foreach ($erro as $valor) 
      echo "$valor <br>";

      echo  "</div>";
  }
  ?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <script type="text/javascript">
      // Início do código de Aumentar/ Diminuir a letra

      // Para usar coloque o comando: "javascript:mudaTamanho('tag_ou_id_alvo', -1);" para diminuir
      // e o comando "javascript:mudaTamanho('tag_ou_id_alvo', +1);" para aumentar

      var tagAlvo = new Array('ul', 'li', 'b', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'table', 'div', 'button', 'a' ); //pega todas as tags /

      // Especificando os possíveis tamanhos de fontes, poderia ser: x-small, small...
      var tamanhos = new Array( '10px','12px','14px','16px','18px','20px','22px','24px','26px','28px','30px' );
      var tamanhoInicial = 2;

      function mudaTamanho( idAlvo,acao ){
        if (!document.getElementById) return
        var selecionados = null,tamanho = tamanhoInicial,i,j,tagsAlvo;
        tamanho += acao;
        if ( tamanho < 0 ) tamanho = 0;
        if ( tamanho > 10 ) tamanho = 10;
        tamanhoInicial = tamanho;
        if ( !( selecionados = document.getElementById( idAlvo ) ) ) selecionados = document.getElementsByTagName( idAlvo )[ 0 ];

        selecionados.style.fontSize = tamanhos[ tamanho ];

        for ( i = 0; i < tagAlvo.length; i++ ){
          tagsAlvo = selecionados.getElementsByTagName( tagAlvo[ i ] );
          for ( j = 0; j < tagsAlvo.length; j++ ) tagsAlvo[ j ].style.fontSize = tamanhos[ tamanho ];
        }
      }
      // Fim do código de Aumentar/ Diminuir a letra

    </script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../index.php" class="logo bg-blue-active">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Gestuvan</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Gestuvan</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top bg-blue">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <span class="alterafonte" aria-live="polite"> </span>
        <ul>
          <button class="botao" id="botaoColor"><a title="Diminuir tamanho do texto" href="javascript:mudaTamanho('body', -1);">A -</a></button>

          <button id="botaoColor"><a title="Aumentar tamanho do texto" href="javascript:mudaTamanho('body', 1);">A +</a></button>
        </ul>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../dist/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs">NOME DO USUÁRIO</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                  Nome do Usuário
                </p>
              </li>
              <!-- Menu Body 
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row 
              </li>-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button 
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Nome do Usuário</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Pesquisar...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <li class="treeview">
          <a href="../index.php">
            <i class="fa fa-home"></i> <span>Início</span>
            <span class="pull-right-container">
              <!--<i class="fa fa-angle-left pull-right"></i>-->
            </span>
          </a>
          <!--<ul class="treeview-menu">
            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>-->
        </li>
        <!--<li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li>-->
        <!--<li>
          <a href="../widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>-->
        <!--<li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>-->
        <!--<li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="../UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="../UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>-->
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Cadastro</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="cadastromotorista.php"><i class="fa fa-circle-o"></i> Motoristas</a></li>
            <li class="active"><a href="cadastroaluno.php"><i class="fa fa-circle-o"></i> Alunos</a></li>
            <!--<li><a href="advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>-->
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Lista</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="listamotorista.php"><i class="fa fa-circle-o"></i> Motoristas</a></li>
            <li><a href="listaaluno.php"><i class="fa fa-circle-o"></i> Alunos</a></li>
          </ul>
        </li>
        <!--<li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="../examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="../examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="../examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="../examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="../examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="../examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="../examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="../examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li>-->
        <!--<li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>-->
        <!--<li><a href="../../documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>-->
        <!--<li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <p> </p>
        Cadastro Aluno
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
        <li><a href="#">Cadastro</a></li>
        <li class="active">Alunos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box">
            <div class="box-header">
              <h3 class="box-title">Dados Pessoais</h3>
            </div>
            <p>&ensp;(*) Campos de preenchimento obrigatório.</p>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="?go=confirmar">
              <div class="box-body">
                <div class="form-group">
                  <label for="nomecompleto">Nome Completo *</label><p></p>
                  <input type="text" name="nomecompleto" size="30" id="nomecompleto" value="<?php echo @$_SESSION[nomecompleto]; ?>">
                </div>
                <div class="form-group">
                  <label for="codaluno">Codigo Aluno</label><p></p>
                  <input type="text" name="codaluno" size="3" maxlength="3" id="codaluno">
                </div>
                <div class="form-group">
                  <tr>
                     <td>
                      <label>Data de Nascimento *</label><p></p>
                     </td>
                     <td align="left">
                      <input type="text" name="dataNascimento" size="12" maxlength="9" placeholder="DD/MM/AAAA" id="dataNascimento"> 
                     </td>
                  </tr>
                </div>
                <div class="form-group">
                  <label for="sexo">Sexo *</label><p></p>
                  <?php $sexo = 'sexo';?>
                  <input type="radio" name="sexo" value="M" <?php if($sexo=='M')?> checked/> Masculino<br>
                  <input type="radio" name="sexo" value="F" <?php if($sexo=='F')?>/> Feminino<br>
                </div>
                <div class="form-group">
                  <label for="cpf">CPF *</label><p></p>
                  <input type="text" name="cpf" size="11" maxlength="11" id="cpf">
                </div>
                <div class="form-group">
                  <label for="rg">RG *</label><p></p>
                  <input type="text" name="rg" size="13" maxlength="8" id="rg"> 
                </div>
                <div class="form-group">
                  <label for="email">E-mail *</label><p></p>
                  <input type="text" name="email" id="email">
                </div>
                <!--<div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile">

                  <p> </p>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Check me out
                  </label>
                </div>-->
              </div>
              <!-- /.box-body 

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>-->
          </div>
          <!-- /.box -->

          <!-- Form Element sizes -->
          <div class="box box">
            <div class="box-header with-border">
              <h3 class="box-title">Endereço</h3>
            </div>
            <div class="box-body">
              <label for="rua">Rua *</label><p></p>
              <input type="text" name="rua" id="rua">
            </div>
            <div class="box-body">
              <label for="numero">Número *</label><p></p>
              <input type="text" size="5" name="numero" id="numero">
            </div>
            <div class="box-body">
              <label for="bairro">Bairro *</label><p></p>
              <input type="text" name="bairro" id="bairro">
            </div>
            <div class="box-body">
              <label for="estado">Estado *</label><p></p>
              <select name="estado"> 
				        <option value="ac">Selecione...</option>
                <option value="ac">Acre</option> 
                <option value="al">Alagoas</option> 
                <option value="am">Amazonas</option> 
                <option value="ap">Amapá</option> 
                <option value="ba">Bahia</option> 
                <option value="ce">Ceará</option> 
                <option value="df">Distrito Federal</option> 
                <option value="es">Espírito Santo</option> 
                <option value="go">Goiás</option> 
                <option value="ma">Maranhão</option> 
                <option value="mt">Mato Grosso</option> 
                <option value="ms">Mato Grosso do Sul</option> 
                <option value="mg">Minas Gerais</option> 
                <option value="pa">Pará</option> 
                <option value="pb">Paraíba</option> 
                <option value="pr">Paraná</option> 
                <option value="pe">Pernambuco</option> 
                <option value="pi">Piauí</option> 
                <option value="rj">Rio de Janeiro</option> 
                <option value="rn">Rio Grande do Norte</option> 
                <option value="ro">Rondônia</option> 
                <option value="rs">Rio Grande do Sul</option> 
                <option value="rr">Roraima</option> 
                <option value="sc">Santa Catarina</option> 
                <option value="se">Sergipe</option> 
                <option value="sp">São Paulo</option> 
                <option value="to">Tocantins</option> 
              </select>
            </div>
            <div class="box-body">
              <label for="cidade">Cidade *</label><p></p>
              <input type="text" name="cidade" id="cidade">
            </div>
            <div class="box-body">
              <label for="pais">País</label><p></p>
              <select name="pais"> 
                <option value="br">Brasil</option> 
              </select>
            </div>
            <div class="box-body">
              <label for="cep">CEP *</label><p></p>
              <input type="text" size="8" maxlength="8" name="cep" id="cep">
            </div>
            <div class="box-body">
              <label for="complemento">Complemento</label><p></p>
              <input type="text" name="complemento" id="complemento">
            </div>
          </div>

        </div>
        </div>
		  <input type="submit" class="btn" name="confirmar" id="confirmar" value="Confirmar">
      <input type="reset" class="btn" name="cancelar" id="cancelar" value="Cancelar">
		  </form>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.12
    </div>
    <strong>Copyright &copy; 2017 - Projeto Banco de Dados</a>.</strong>
  </footer>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
