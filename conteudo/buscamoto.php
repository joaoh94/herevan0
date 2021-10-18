<?php
  session_start();
  include("../conexao/conexao.php");


?>

<html>
  <head>
		
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

            </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </body>
</html>