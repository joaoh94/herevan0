<?php
  session_start();
  include("../conexao/conexao.php");

  
  //Update  
  if(isset($_GET['id'])){
    $_SESSION['rot_id'] = $_GET['id'];

    $sql_code = "SELECT * FROM Rota WHERE rot_id = ".$_GET['id'];
    $sql_query = $mysqli->query($sql_code) or die ($mysqli->erro);
    $linha = $sql_query->fetch_assoc();
  }

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    //Update
    if(isset($_SESSION['rot_id'])){

      $sql_rota = "UPDATE Rota 
          set
          rot_nome = '$_POST[nomeRota]',
          vei_id = $_POST[veiculo],
          mot_id = $_POST[motorista],
          rot_turno = '$_POST[turno]',
          ponto0 = '$_POST[ponto0]',
          ponto1 = '$_POST[ponto1]',
          ponto2 = '$_POST[ponto2]',
          ponto3 = '$_POST[ponto3]',
          ponto4 = '$_POST[ponto4]',
          ponto5 = '$_POST[ponto5]',
          uni_id = $_POST[universidade]
          where 
          Rota.rot_id = ".$_SESSION['rot_id'];


      unset($_SESSION['rot_id']);
    }
    else{ //Insert
      $sql_rota = "INSERT INTO Rota (
        rot_nome,
        vei_id,
        mot_id,
        emp_id,
        rot_turno,
        ponto0,
        ponto1,
        ponto2,
        ponto3,
        ponto4,
        ponto5,
        uni_id,
        rot_qtdLugar,
        rot_qtdLivre,
        rot_preco
      )
      VALUES(
        '$_POST[nomeRota]',
         $_POST[veiculo],
         $_POST[motorista],
         $_SESSION[emp_id],
        '$_POST[turno]',
        '$_POST[ponto0]',
        '$_POST[ponto1]',
        '$_POST[ponto2]',
        '$_POST[ponto3]',
        '$_POST[ponto4]',
        '$_POST[ponto5]',
         $_POST[universidade],
         $_POST[rot_qtdLugar],
         $_POST[rot_qtdLugar],
         '$_POST[rot_preco]'
      )";
    }

    if($mysqli->query($sql_rota) === TRUE){
          
      echo '<script type="text/javascript"> window.location = "listarota.php" </script>';
      
    }
    else
      echo $mysqli->error;

  }
  else{
    
    
    $sql_veiculos = "SELECT * FROM Veiculo WHERE emp_id = ".$_SESSION['emp_id'];
    $query_veiculos = $mysqli->query($sql_veiculos) or die ($mysqli->erro);
    $linha_veiculos = $query_veiculos->fetch_assoc();

    $sql_motoristas = "SELECT * FROM Motorista WHERE emp_id = ".$_SESSION['emp_id'];
    $query_motoristas = $mysqli->query($sql_motoristas) or die ($mysqli->erro);
    $linha_motoristas = $query_motoristas->fetch_assoc();

    $sql_universidades = "SELECT * from Universidade order by uni_nome";
    $query_universidades = $mysqli->query($sql_universidades) or die ($mysqli->erro);
    $linha_universidades = $query_universidades->fetch_assoc();

  }

?>
<html>
  <head>
  <link rel="shortcut icon" href="../assets/imagens/favicon.png" />
  <title>Cadastro Rotas</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
  <script>
     $(document).ready(function () {
        $("#origem").click(function(){
          url = "https://maps.google.com/maps/api/geocode/json?address=" + $("#origemTexto").val().split(" ").join("+") + "&key=AIzaSyAYxGxUZTBYUwP6HOI_-6cBbstG55RdrXw";

          $.getJSON(url, function(data){
            if(data.status == "OK"){
              redefine_polygon({lat: data.results[0].geometry.location.lat, lng: data.results[0].geometry.location.lng});
            }
            else{
              alert("Endereço não encontrado.")
            }


            
          });

          
        })
     });

  </script>


    <style>
      #map-canvas 
{ 
height: 400px; 
width: 500px;
}


      th, td {
          padding: 8px;
          text-align: left;
          border: 1px solid #ddd;
      }
    </style>
  </head>
  <body class="hold-transition skin-green sidebar-mini">

    <?php include 'headeradm.php';?>
    <?php include 'sideadm.php';?>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

    <script type="text/javascript">
      $(function() {
        $('#rot_preco').maskMoney({ decimal: ',', thousands: '.', precision: 2 }); })
    </script>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <?php
            if(isset($_GET['id']))
              echo "Alterar Rota";
            else
              echo "Cadastro Rota";
          ?>
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
          <li><a href="#">Rotas</a></li>
          <li class="active">Cadastrar Rota</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="box box">
              <div class="box-header">
                <h3 class="box-title">Dados Rota</h3>
              </div>
              <p>&ensp;(*) Campos de preenchimento obrigatório.</p>
              <form role="form" method="POST" action="?go=confirmar">
                <div class="box-body">
                  <div class="form-group">
                  <label for="codveiculo">Nome</label>  <p></p>
                    <input type="text" id="nomeRota" value="<?php if(isset($linha)) echo $linha['rot_nome']?>" name="nomeRota" required>
                  </div>

                  <div class="form-group">
                  <label for="codveiculo">Origem</label>  <p></p>
                    <input type="text" id="origemTexto" name="origemTexto"> <input type="button" value="Procurar" id="origem" name="origem">
                  </div>

                  <div class="form-group">
                  <label for="codveiculo">Área</label>
                    <div id="map-canvas"></div>
                  </div>

                  <div class="form-group">
                    <label for="codveiculo">Veículo</label><p></p>
                    <select name="veiculo">
                      <?php
                        do{
                      ?>

                      <option value=<?php echo $linha_veiculos['vei_id'] ?>> <?php echo $linha_veiculos['vei_nome'] ?> </option>

                      <?php
                        } while ($linha_veiculos = $query_veiculos->fetch_assoc());
                      ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                  <label for="rot_qtdLugar">Lugares Disponíveis</label>  <p></p>
                    <input type="number" id="rot_qtdLugar" min="0" value="<?php if(isset($linha)) echo $linha['rot_qtdLugar']?>" name="rot_qtdLugar" required>
                  </div>

                  <div class="form-group">
                  <label for="rot_preco">Preço</label>  <p></p>
                    <input type="text" id="rot_preco" value="<?php if(isset($linha)) echo $linha['rot_preco']?>" name="rot_preco" required>
                  </div>

                  <div class="form-group">
                    <label for="codveiculo">Motorista</label><p></p>
                    <select name="motorista">
                      <?php
                         do{
                      ?>

                      <option value=<?php echo $linha_motoristas['mot_id'] ?>> <?php echo $linha_motoristas['mot_nome'] ?> </option>

                      <?php 
                        } while ($linha_motoristas = $query_motoristas->fetch_assoc())
                      ?>
                    </select>
                  </div>
                  

                  <div class="form-group">
                    <label for="universidade">Universidade Destino</label><p></p>
                    <select name="universidade">
                      <?php
                         do{
                      ?>

                      <option value=<?php echo $linha_universidades['uni_id'] ?>> <?php echo $linha_universidades['uni_nome'] ?> </option>

                      <?php 
                        } while ($linha_universidades = $query_universidades->fetch_assoc())
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="turno">Turno</label><p></p>
                    <?php $turno = 'turno';?>
                    <input type="radio" name="turno" value="M" <?php if($turno=='Matutino')?> /> Matutino<br>
                    <input type="radio" name="turno" value="V" <?php if($turno=='Vespertino')?> /> Vespertino<br>
                    <input type="radio" name="turno" value="N" <?php if($turno=='Noturno')?> checked/> Noturno<br>

                    <input type="hidden" id="ponto0" name="ponto0">
                    <input type="hidden" id="ponto1" name="ponto1">
                    <input type="hidden" id="ponto2" name="ponto2">
                    <input type="hidden" id="ponto3" name="ponto3">
                    <input type="hidden" id="ponto4" name="ponto4">
                    <input type="hidden" id="ponto5" name="ponto5">

                  </div>
                  <input type="submit" class="btn" name="confirmar" id="confirmar" value="Confirmar">
        <input type="reset" class="btn" name="cancelar" id="cancelar" value="Cancelar">
            </div>
          </div>
        
      </form>
    </section>
      
    </div>
  </body>
</html>


<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyAX4EXdEcsWPJrHfjdWdzkNa2ZWHLqPrJI
"></script>

  <script>
    function initialize(center) {

      var map_options = {
            zoom: 13,
            center: new google.maps.LatLng(center.lat, center.lng),
            mapTypeId: google.maps.MapTypeId.ROADMAP
            };

      map = new google.maps.Map( document.getElementById( 'map-canvas' ), map_options );   
    }

    function create_polygon(coordinates) {
    var icon = {
        //path: google.maps.SymbolPath.CIRCLE,
        path: "M -1 -1 L 1 -1 L 1 1 L -1 1 z",
        strokeColor: "#FF0000",
        strokeOpacity: 0,
        fillColor: "#FF0000",
        fillOpacity: 1,
        scale: 5
    };

     var polygon = new google.maps.Polygon({
        map: map,
        paths: coordinates,
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.5,
        zIndex: -1
    });

    var marker_options = {
        map: map,
        icon: icon,
        flat: true,
        draggable: true,
        raiseOnDrag: false
    };

    for (var i=0; i<coordinates.length; i++){
        marker_options.position = coordinates[i];
        var point = new google.maps.Marker(marker_options);


        
        google.maps.event.addListener(point, "drag", update_polygon_closure(polygon, i));
    }

    function update_polygon_closure(polygon, i){
        return function(event){
           polygon.getPath().setAt(i, event.latLng); 

           document.getElementById("ponto"+i).value = event.latLng;

        }
    }
    };

    function findCoordinates(lat, long, range)
    {
        // How many points do we want? (should probably be function param..)
        var numberOfPoints = 6;
        var degreesPerPoint = 360 / numberOfPoints;

        // Keep track of the angle from centre to radius
        var currentAngle = 0;

        // The points on the radius will be lat+x2, long+y2
        var x2;
        var y2;
        // Track the points we generate to return at the end
        var points = [];

        for(var i=0; i < numberOfPoints; i++)
        {
            // X2 point will be cosine of angle * radius (range)
            x2 = Math.cos(currentAngle) * range;
            // Y2 point will be sin * range
            y2 = Math.sin(currentAngle) * range;

            // Assuming here you're using points for each x,y..             
            //p = new Point(lat+x2, long+y2);

            p = [lat+x2, long+y2];  

            // save to our results array
            points.push(p);

            // Shift our angle around for the next point
            currentAngle += degreesPerPoint;
        }
        // Return the points we've generated


        aux = points[0];
        points[0] = points[5]
        points[5] = aux;

        aux = points[3];
        points[3] = points[1]
        points[1] = aux;

        aux = points[2];
        points[2] = points[3]
        points[3] = aux;

        aux = points[3];
        points[3] = points[4]
        points[4] = aux;

        

        return points;
    }

    /*function populate_polygon(corners){

    }*/

    function redefine_polygon(center){

      //corners = findCoordinates(center.lat, center.lng, 0.02);

      <?php

        if(isset($linha)){
          $strCorner = "corners = [".
          $linha['ponto0'].','.
          $linha['ponto1'].','.
          $linha['ponto2'].','.
          $linha['ponto3'].','.
          $linha['ponto4'].','.
          $linha['ponto5'].
          "];";

          $strCorner = str_replace("(", "[", $strCorner);
          $strCorner = str_replace(")", "]", $strCorner);

          echo $strCorner."; initialize({lat: corners[0][0], lng: corners[0][1]})";
        }
        else{
          echo "corners = findCoordinates(center.lat, center.lng, 0.02); initialize(center);";
        }

        
      ?>

      //initialize(center);

      var coordinates = [];

      for (var i=0; i<corners.length; i++){
      var position = new google.maps.LatLng(corners[i][0], corners[i][1]);
        
      document.getElementById("ponto"+i).value = position;

      coordinates.push(position);        
      }

      create_polygon(coordinates);
    }

    <?php 
      //if(!isset($linha))
        echo "redefine_polygon({lat: -22.833535, lng: -47.053270});";

    ?>
    

    

  </script>

