<?php include 'global.php'; ?>
<?php include 'bootstrap.php';?> 

<style>
	@font-face {
	    font-family: 'Sweet Sensations Personal Use';
	    src: url(<?php echo $GLOBALS['address']."/assets/fontes/SweetSensationsPersonalUse.woff2" ?>) format('woff2'),
	        url(<?php echo $GLOBALS['address']."/assets/fontes/SweetSensationsPersonalUse.woff"?>) format('woff');
	    font-weight: normal;
	    font-style: normal;
	}

	hr.style-two {
	    border: 0;
	    height: 1px;
	    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
	}

	html, body {
        height:100%;
      } 

      body {
          background-color: white;
          background-image: url(<?php echo $GLOBALS['address']."/assets/imagens/nyc.jpg" ?>);
          background-size: auto 100%;
          background-repeat: no-repeat;
          background-position: left top;
          background-attachment: fixed;
      }

</style>

<div class="container" style="width: 100%">
	<div class="row">

			<div class="col-md-2" style="font-family: 'Sweet Sensations Personal Use'; font-weight: normal; font-style: normal; font-size: 60px;">
				<a STYLE="text-decoration:none; color: #00b300" href=<?php echo $GLOBALS['address'] ?>> Here Van </a>
			</div>

			<div class="col-md-7"></div>

			<div class="col-md-3">


				<a href=<?php echo $GLOBALS['address']."/login/login.php" ?> class="btn btn-primary" role="button" style="margin-top: 5%; font-size: 25px;">Entrar</a>

				<a href=<?php echo $GLOBALS['address']."/cadastroEmpresa/cadastro-empresa.php" ?>  class="btn btn-primary" role="button" style="margin-top: 5%; font-size: 25px;">Cadastre-se</a>
			
				
			</div>

	</div>

	<div class="row">
		<div class="col-md-12">
			<hr class="style-two">
		</div>
	</div>

</div>