<?php
session_start();
include "../model/usuario.class.php";
include "../model/usuarioOP.class.php";
if(isset($_SESSION['idusuario'])){

    $idusuario = $_SESSION['idusuario'];
    $nusuario = $_SESSION['nusuario'];
    $imgusuario = $_SESSION['imgusuario'];
    $usuarioop= new UsuarioOP();
    $linha= $usuarioop-> getEdit($idusuario);

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
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/typeahead.js"></script>
    <script src="../bootstrap/js/bootstrap-tagsinput.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-tagsinput.css">
    <link rel="stylesheet" type="text/css" href="../css/typeahead.css">
    <script>
        $(document).ready(function() {
                        <?php 
           if(isset($_GET['ingredientes'])){ ?>
          $("#retorno").load("conta_ingredientes.php");
           <?php } ?>
            $("#receitas").click(function(e){
                e.preventDefault();
                $("#retorno").load("conta_receitas.php");
            });

            $("#dados").click(function(e){
                e.preventDefault();
                window.location.assign("conta_dados.php")
            });

            $("#ingredientes").click(function(e){
                e.preventDefault();
                $("#retorno").load("conta_ingredientes.php");
            });

            $("#enviareceita").click(function(e){
                e.preventDefault();
                $("#retorno").load("cadreceita.php");
            });

            $("#enviadas").click(function(e){
                e.preventDefault();
                $("#retorno").load("conta_enviadas.php");
            });




        });
    </script>
    <title>Minha conta</title>
</head>
<body class="cinzou">
    <?php

    include "../header.php";
    ?>


    <div class="container-fluid margin-nav">
        <aside>
            <div class="row meio margin-t5">
            <div class="btn-group" role="group">
                <input type="button" class="btn btn-default" value="Meus dados" id="dados" />
                <input type="button" class="btn btn-default" value="Receitas Favoritas" id="receitas" />
                <input type="button" class="btn btn-default" value="Meus Ingredientes" id="ingredientes" />
                <input type="button" class="btn btn-default" value="Enviar Receita" id="enviareceita">
                <input type="button" class="btn btn-default" value="Receitas Enviadas" id="enviadas">
            </div>
            </div>
        </aside>

        <div class="container caixabranca col-md-offset-5" id="retorno">


                <form action="../controller/usuario.php" method="post" class="col-md-offset-4" enctype="multipart/form-data">


                    <div class="input-group form-group margin-t5">
                        <img src="../imgs/usuarios/<?=$imgusuario?>" class="img-responsive img-circle profile-user-pic" alt="Imagem do Usuario">
                        <span>Imagem</span>
                        <input type="file" class="form-control" name="imgusuario">
                    </div>
                    <div class="input-group form-group">
                        <span>Nome</span>
                        <i class="icon-user"></i><input type="text" class="form-control" name="nome" value="<?=$linha['nomeusuario']?>" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Email</span>
                        <i class="icon-mail-alt"></i><input type="email" class="form-control" name="email" value="<?=$linha['email']?>" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Senha</span>
                        <i class="icon-lock"></i><input type="password" class="form-control" name="senha" value="<?=$linha['senha']?>" required>
                    </div>

                    <input type="submit" class="btn btn-default" name="salvar" value="Salvar">
                </form>
                </div>

               

        </div>
       <div class="absoluto">
    <?php
    include "../footer.php";
    ?>
    </div>


</body>
</html>
