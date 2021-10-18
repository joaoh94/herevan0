<?php

include("../conexao.php");

if(@$_GET['go'] == 'confirmar') {

      // 1- Registro dos dados
      if (!isset($_SESSION)) 
      session_start();

      foreach ($_POST as $chave => $valor) 
        $_SESSION[$chave] = $mysqli->real_escape_string($valor); 

      // 2- Validação dos dados
      if (strlen($_SESSION['nomecompleto']) == 0)  
        $erro[] = "Preencha a campo Nome Completo.";

      if (strlen($_SESSION['codmotorista']) == 0)  
        $erro[] = "Preencha a campo Codigo Motorista.";

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


      //Dados Empregaticios
      if (strlen($_SESSION['cnpj']) == 0)  
        $erro[] = "Preencha a campo CNPJ.";

      if (strlen($_SESSION['dataAdmissao']) == 0)  
        $erro[] = "Preencha a campo Data Admissao.";


      //Dados da CNH
      if (strlen($_SESSION['numcnh']) == 0)  
        $erro[] = "Preencha a campo Número da CNH.";

      if (strlen($_SESSION['validadeCNH']) == 0)  
        $erro[] = "Preencha a campo Validade CNH.";


      //Dados Veicular
      if (strlen($_SESSION['codveiculo']) == 0)  
        $erro[] = "Preencha a campo Codigo Veiculo.";

      if (strlen($_SESSION['placa']) == 0)  
        $erro[] = "Preencha a campo Placa.";

      if (strlen($_SESSION['renavam']) == 0)  
        $erro[] = "Preencha a campo Renavam.";

      if (strlen($_SESSION['chassi']) == 0)  
        $erro[] = "Preencha a campo Chassi.";

      if (strlen($_SESSION['anoveiculo']) == 0)  
        $erro[] = "Preencha a campo Ano.";


      //Dados Ministerio Turismo
      if (strlen($_SESSION['codcertificado']) == 0)  
        $erro[] = "Preencha a campo Codigo Certificado.";

      if (strlen($_SESSION['validadeCertificado']) == 0)  
        $erro[] = "Preencha a campo Validade do Certificado.";


      // 3 - Inserção no Banco e redirecionamento
      if (count($erro) == 0) {

        //$senha = md5(md5($_SESSION['senha']));--

        $sql_pfisica = "INSERT INTO pessoa_fisica (
        nome_completo, 
        sexo, 
        email,
        data_nascimento,
        cpf,
        rg
        )
        VALUES(
        '$_SESSION[nomecompleto]',
        '$_SESSION[sexo]',
        '$_SESSION[email]',
        '1993/10/21',
        '$_SESSION[cpf]',
        '$_SESSION[rg]'
        )";

        $sql_endereco = "INSERT INTO endereco (
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
        )";

        $sql_motorista = "INSERT INTO motorista (
        cod_motorista,
        data_admissao,
        data_demissao,
        numero_cnh,
        categoria_cnh,
        data_val_cnh,
        cnpj,
        cpf
        )
        VALUES(
        '$_SESSION[codmotorista]',
        '1993/10/21',
        '1993/10/21',
        '$_SESSION[numcnh]',
        '$_SESSION[categoriaCNH]',
        '1993/10/21',
        '$_SESSION[cnpj]',
        '$_SESSION[cpf]'
        )";

        $sql_veiculo = "INSERT INTO veiculo (
        cod_veiculo, 
        placa,
        renavam,
        chassi,
        anoveiculo,
        data_aquisicao,
        cnpj
        )
        VALUES(
        '$_SESSION[codveiculo]',
        '$_SESSION[placa]',
        '$_SESSION[renavam]',
        '$_SESSION[chassi]',
        '$_SESSION[anoveiculo]',
        '1993/10/21',
        '$_SESSION[cnpj]'
        )";

        $sql_ministerioturismo = "INSERT INTO ministerio_turismo (
        cod_certificado, 
        data_val_certificado,
        natureza_juridica,
        cod_veiculo
        )
        VALUES(
        '$_SESSION[codcertificado]',
        '1993/10/21',
        '$_SESSION[naturezajuridica]',
        '$_SESSION[codveiculo]'
        )";

        $sql_atrelado = "INSERT INTO atrelado (
        cod_motorista, 
        cod_veiculo,
        data_atrelamento,
        horario_inicio
        )
        VALUES(
        '$_SESSION[codmotorista]',
        '$_SESSION[codveiculo]',
        NOW(),
        NOW()  
        )";


        $confirma = $mysqli->query($sql_pfisica) or die ($mysqli->error);

        $confirma1 = $mysqli->query($sql_endereco) or die ($mysqli->error);

        $confirma2 = $mysqli->query($sql_motorista) or die ($mysqli->error);

        $confirma3 = $mysqli->query($sql_veiculo) or die ($mysqli->error);

        $confirma4 = $mysqli->query($sql_ministerioturismo) or die ($mysqli->error);

        $confirma5 = $mysqli->query($sql_atrelado) or die ($mysqli->error);

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

        if ($confirma and $confirma1 and $confirma2 and $confirma3 and $confirma4 and $confirma5) {
          echo "<script>alert('CADASTRO EFETUADO COM SUCESSO');location.href = 'login.php';</script>";  
        }

        else
          $erro[] = $confirma;
          $erro[] = $confirma1;
          $erro[] = $confirma2;
          $erro[] = $confirma3;
          $erro[] = $confirma4;
          $erro[] = $confirma5;

      }
}

?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GESTUVAN</title>
  <?php 
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
            <li class="active"><a href="cadastromotorista.php"><i class="fa fa-circle-o"></i> Motoristas</a></li>
            <li><a href="cadastroaluno.php"><i class="fa fa-circle-o"></i> Alunos</a></li>
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
            <li><a href="lista/motorista.php"><i class="fa fa-circle-o"></i> Motoristas</a></li>
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
        Cadastro Motorista
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
        <li><a href="#">Cadastro</a></li>
        <li class="active">Motoristas</li>
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
                  <input type="text" name="nomecompleto" size="30" id="nomecompleto">
                </div>
                <div class="form-group">
                  <label for="codmotorista">Codigo Motorista *</label><p></p>
                  <input type="text" name="codmotorista" size="3" maxlength="3" id="codmotorista">
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
              <option value="">Selecione...</option>
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
          <div class="box box">
            <div class="box-header">
              <h3 class="box-title">Dados Empregatícios</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="form-group">
                  <label for="cnpj">CNPJ *</label><p></p>
                  <input type="cnpj" size="14" name="cnpj" maxlength="14" id="cnpj">
                </div>
                <div class="form-group">
                  <tr>
                     <td>
                      <label for="dataAdmissao">Admissão *</label><p></p>
                     </td>
                     <td align="left">
                      <input type="text" name="dataAdmissao" size="12" maxlength="9" placeholder="DD/MM/AAAA" id="dataAdmissao"> 
                     </td>
                  </tr>
                </div>
                <div class="form-group">
                  <tr>
                     <td>
                      <label for="dataDemissao">Demissão</label><p></p>
                     </td>
                     <td align="left">
                      <input type="text" name="dataDemissao" size="12" maxlength="9" placeholder="DD/MM/AAAA" id="dataDemissao"> 
                     </td>
                  </tr>
                </div>
          <!-- Input addon 
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
              <!--<div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-addon">.00</span>
              </div>
              <br>

              <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" class="form-control">
                <span class="input-group-addon">.00</span>
              </div>

              <h4>With icons</h4>

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control" placeholder="Email">
              </div>
              <br>

              <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
              </div>
              <br>

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                <input type="text" class="form-control">
                <span class="input-group-addon"><i class="fa fa-ambulance"></i></span>
              </div>

              <h4>With checkbox and radio inputs</h4>

              <div class="row">
                <div class="col-lg-6">
                  <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox">
                        </span>
                    <input type="text" class="form-control">
                  </div>
                  <!-- /input-group 
                </div>
                <!-- /.col-lg-6 
                <div class="col-lg-6">
                  <div class="input-group">
                        <span class="input-group-addon">
                          <input type="radio">
                        </span>
                    <input type="text" class="form-control">
                  </div>
                  <!-- /input-group 
                </div>
                <!-- /.col-lg-6 
              </div>
              <!-- /.row 

              <h4>With buttons</h4>

              <p class="margin">Large: <code>.input-group.input-group-lg</code></p>

              <div class="input-group input-group-lg">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Action
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <!-- /btn-group 
                <input type="text" class="form-control">
              </div>
              <!-- /input-group 
              <p class="margin">Normal</p>

              <div class="input-group">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-danger">Action</button>
                </div>
                <!-- /btn-group 
                <input type="text" class="form-control">
              </div>
              <!-- /input-group 
              <p class="margin">Small <code>.input-group.input-group-sm</code></p>

              <div class="input-group input-group-sm">
                <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat">Go!</button>
                    </span>
              </div>
              <!-- /input-group -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box">
            <div class="box-header with-border">
              <h3 class="box-title">Carteira Nacional de Habilitação</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="numcnh">Número da CNH *</label><p></p>
                  <input type="numcnh" name="numcnh" size="11" id="numchn"><p></p>

                  <div class="form-group">
                    <label for="categoriaCNH">Categoria da CNH</label><p></p>
                      <?php $sexo = 'sexo';?>
                  <input type="radio" name="categoriaCNH" value="D" <?php if($sexo=='D')?> checked/> D<br>
                  <input type="radio" name="categoriaCNH" value="E" <?php if($sexo=='E')?>/> E<br>
                  </div>
                </div>
                <div class="form-group">
                  <tr>
                     <td>
                      <label for="validadeCNH">Validade CNH *</label><p></p>
                     </td>
                     <td align="left">
                      <input type="text" name="validadeCNH" size="12" maxlength="9" placeholder="DD/MM/AAAA" id="validadeCNH"> 
                     </td>
                  </tr>
                </div>
              </div>
              <!-- /.box-body 
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Sign in</button>
              </div>
              <!-- /.box-footer -->
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          <div class="box box">
            <div class="box-header with-border">
              <h3 class="box-title">Dados Veicular</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- text input -->
                <div class="form-group">
                  <label for="codveiculo">Codigo Veiculo *</label><p></p>
                  <input type="codveiculo" name="codveiculo" size="8" id="codveiculo">
                </div>
            <div class="form-group">
              <label for="placa">Placa *</label><p></p>
              <input type="text" size="7" maxlength="7" name="placa" id="placa">
            </div>
            <div class="form-group">
              <label for="renavam">Renavam *</label><p></p>
              <input type="renavam" name="renavam" size="11" id="renavam">
            </div>
            <div class="form-group">
              <label for="chassi">Chassi *</label><p></p>
              <input type="chassi" name="chassi" size="17" id="chassi">
            </div>
            <div class="form-group">
              <label for="anoveiculo">Ano *</label><p></p>
              <input type="anoveiculo" name="anoveiculo" size="4" maxlength="4" id="anoveiculo">
            </div>
            <div class="form-group">
                  <tr>
                     <td>
                      <label>Data de Aquisição
                      </label><p></p>
                     </td>
                     <td align="left">
                      <input type="text" name="dataAquisição" size="12" maxlength="9" placeholder="DD/MM/AAAA" id="dataAquisição"> 
                     </td>
                  </tr>
                </div>
                <h3 class="box-title">Dados Ministério do Turismo</h3>
                <div class="form-group">
                  <label for="codcertificado">Codigo Certificado *</label><p></p>
                  <input type="codcertificado" name="codcertificado" size="8" id="codcertificado">
                </div>
                <div class="form-group">
                  <tr>
                     <td>
                      <label>Validade do Certificado *</label><p></p>
                     </td>
                     <td align="left">
                      <input type="text" name="validadeCertificado" size="12" maxlength="9" placeholder="DD/MM/AAAA" id="validadeCertificado"> 
                     </td>
                  </tr>
                </div>
                <div class="form-group">
                  <label for="naturezajuridica">Natureza Juridica</label><p></p>
                  <input type="text" size="30" name="naturezajuridica" id="naturezajuridica">
                </div>  
                <!-- input states 
                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>
                  <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ...">
                  <span class="help-block">Help block with success</span>
                </div>
                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i> Input with
                    warning</label>
                  <input type="text" class="form-control" id="inputWarning" placeholder="Enter ...">
                  <span class="help-block">Help block with warning</span>
                </div>
                <div class="form-group has-error">
                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with
                    error</label>
                  <input type="text" class="form-control" id="inputError" placeholder="Enter ...">
                  <span class="help-block">Help block with error</span>
                </div>

                <!-- checkbox 
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox">
                      Checkbox 1
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox">
                      Checkbox 2
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" disabled>
                      Checkbox disabled
                    </label>
                  </div>
                </div>

                <!-- radio 
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                      Option one is this and that&mdash;be sure to include why it's great
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                      Option two can be something else and selecting it will deselect option one
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
                      Option three is disabled
                    </label>
                  </div>
                </div>

                <!-- select 
                <div class="form-group">
                  <label>Select</label>
                  <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Select Disabled</label>
                  <select class="form-control" disabled>
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>

                <!-- Select multiple
                <div class="form-group">
                  <label>Select Multiple</label>
                  <select multiple class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Select Multiple Disabled</label>
                  <select multiple class="form-control" disabled>
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>

              </form>
            </div>
            <!-- /.box-body
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
          <!-- /.box -->
      <input type="submit" class="btn" name="confirmar" id="confirmar" value="Confirmar">
      <input type="reset" class="btn" name="cancelar" id="cancelar" value="Cancelar">
    </form>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.12
    </div>
    <strong>Copyright &copy; 2017 - Projeto Banco de Dados</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
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
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>