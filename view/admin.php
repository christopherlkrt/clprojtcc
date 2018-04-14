<?php
session_start();
if(isset($_SESSION['idusuario'])){
    $idusuario = $_SESSION['idusuario'];
    $nusuario = $_SESSION['nusuario'];
    $imgusuario = $_SESSION['imgusuario'];
    if (!$_SESSION['imgusuario']){
        $imgusuario = 'user-icon.png';
    }
    else if (isset($_SESSION['imgusuario'])) {
        $imgusuario = $_SESSION['imgusuario'];
    }

}
else if(isset($_POST['logout'])){
    session_destroy();
    header("location: ../view/home.php");
}
else if(!isset($_SESSION['idusuario'])){
    header("location: ../view/home.php");
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../fafontello/css/fontello.css">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#receitas").click(function(){
                $("#retorno").load("adminreceita.php");
            });

            $("#usuario").click(function(){
                $("#retorno").load("adminusuario.php");
            });

            $("#ingredientes").click(function(){
                $("#retorno").load("admining.php");
            });

            });


    </script>
    <title>Painel de Controle</title>
</head>
<body class="cinzou">
    <?php

    include "../header.php";
    ?>


    <div class="container-fluid margin-tmais">
        <aside>
            <div class="row">
            <div class="btn-group col-md-offset-5" role="group">
                <input type="button" class="btn btn-default" value="Usuários" id="usuario" />
                <input type="button" class="btn btn-default" value="Receitas" id="receitas" />
                <input type="button" class="btn btn-default" value="Ingredientes" id="ingredientes" />
                <input type="button" class="btn btn-default" value="?" id="enviareceita">
            </div>
            </div>
        </aside>

    <div id="retorno">
      <h1 class="meio shadow">Painel de Controle</h1>
     </div>   
    <?php
    include "../footer.php";
    ?>


</body>
</html>

