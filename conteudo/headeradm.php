
  <?php 
  
  if(!isset($_SESSION['emp_id']))
    echo "<script>window.location = '../login/login.php'</script>";



  include '../bootstrap.php';


  ?> 
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/js/AdminLTE.min.css">
  <link rel="stylesheet" href="../assets/js/_all-skins.min.css">
  
  <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>

  <script>
    $(document).ready(function(){
      $('#sair').click(function(){
        $.ajax({
            url:"sair.php",
            type: "post",
            success:function(result){

              window.location = "../login/login.php"
            
            }
         });
      })
    })
  </script>

  


  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js"></script>




<header class="main-header">
    <a href="adminHome.php" class="logo bg-olive">
      <span class="logo-mini"><b></b></span>
      <span class="logo-lg"><b>Here Van</b></span>
    </a>
    <nav class="navbar navbar-static-top bg-olive">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu ">
            <a href="#" class="dropdown-toggle " name="sair" id="sair" data-toggle="dropdown">
              <span class="hidden-xs">SAIR</span>
            </a>            
          </li>
        </ul>
      </div>
    </nav>
  </header>