<?php
session_start();
$idvisitado=$_GET['visitado'];
include "../model/ReceitaOP.class.php";
$receitaop= new ReceitaOP();

// $nota_receita=$receitaop-> getNotaReceita($id);

$obj_visitado=$receitaop-> getReceitaDono($idvisitado);


if(isset($_SESSION['idusuario'])){

    $idusuario = $_SESSION['idusuario'];
    $nusuario = $_SESSION['nusuario'];
    $imgusuario = $_SESSION['imgusuario'];

}



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../css/star-rating.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../fafontello/css/fontello.css">
	<script src="../js/jquery-3.2.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>

<script>
        $(document).ready(function() {

            $("#favoritas").click(function(){
                $("#retorno").load("visitado_favoritas.php"+location.search);
            });

             $("#enviadas").click(function(){
                $("#retorno").load("visitado_enviadas.php"+location.search);
            });

         
            });


    </script>
</head>
<body>
	<?php

    include "../header.php";
    ?>

	<!-- descrição-receita-->
    <section>
        <div class="container-fluid margin-nav">
        <div class="row">
            <aside  class="col-md-2 col-md-offset-1">
                <div>
                    <img src="../imgs/usuarios/<?=$obj_visitado['img']?>" class="img-responsive img-circle visited-user-pic" alt="Imagem do Usuario">
                    <h4 class="meio">Receitas de <?=$obj_visitado['nomeusuario']?></h4>
                    <div class="meio">
                    <input type="button" class="btn btn-default" value="Favoritas" id="favoritas" name="favoritas" />
                    <input type="button" class="btn btn-default" value="Enviadas" id="enviadas" name="enviadas" />
                    </div>
                </div>
            </aside>
            
      
         <div class="col-md-offset-1 col-md-6" id="retorno">
              <h1 class=" meio shadow">Perfil de <?=$obj_visitado['nomeusuario']?></h1>
            </div> 
        </div>

            
              

        
    </div>
</section>


    <?php
    include "../footer.php";
    ?>
</body>


</html>
