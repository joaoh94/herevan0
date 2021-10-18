<?php
/*
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

      if (strlen($_SESSION['telefone']) == 0)  
        $erro[] = "Preencha a campo Telefone.";

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
        '$_SESSION[telefone]'
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
        data_validade,
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

        if ($confirma and $confirma1 and $confirma2) {
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

        }

        if ($confirma and $confirma1 and $confirma2 and $confirma3 and $confirma4 and $confirma5) {
          echo "<script>alert('CADASTRO EFETUADO COM SUCESSO');location.href = '../index.php';</script>";  
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
*/

?>


  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Cadastro Contrato
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
        <li><a href="#">Contratos</a></li>
        <li class="active">Cadastrar Contratos</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box">
            <div class="box-header">
              <h3 class="box-title">Dados Contrato</h3>
            </div>
            <p>&ensp;(*) Campos de preenchimento obrigatório.</p>
            <form role="form" method="POST" action="?go=confirmar">
              <div class="box-body">
                <div class="form-group">
                  <label for="numcontrato">Número do Contrato</label><p></p>
                  <input type="text" name="numcontrato" size="9" maxlength="9" id="numcontrato" value="<?php echo @$_SESSION[numcontrato]; ?>" required >
                </div>
                <div class="form-group">
                  <label for="duracaocontrato">Duração do Contrato</label><p></p>
                  <input type="number" name="duracaocontrato" id="duracaocontrato" value="<?php echo @$_SESSION[duracaocontrato]; ?>" required >
                </div>
                <div class="form-group">
                  <label for="valormensalidade">Valor da Mensalidade</label><p></p>
                  <input type="text" name="valormensalidade" id="valormensalidade" value="<?php echo @$_SESSION[universidade]; ?>" required >
                </div>
          </div>
        </div>
      <input type="submit" class="btn" name="confirmar" id="confirmar" value="Confirmar">
      <input type="reset" class="btn" name="cancelar" id="cancelar" value="Cancelar">
    </form>
  </section>
    
  </div>
  