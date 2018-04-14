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
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/typeahead.js"></script>
    <script src="../bootstrap/js/bootstrap-tagsinput.js"></script>
    <link rel="stylesheet" type="text/css" href="http://projectsbox.com.br/css/bootstrap-tagsinput.css">
    <link rel="stylesheet" type="text/css" href="http://projectsbox.com.br/css/typeahead.css">
    <script>
        $(document).ready(function() {

            $("#receitas").click(function(){
                $("#retorno").load("conta_receitas.php");
            });

            $("#dados").click(function(){
                location.reload();
            });

            $("#ingredientes").click(function(){
                $("#retorno").load("conta_ingredientes.php");
            });

            $("#enviareceita").click(function(){
                $("#retorno").load("cadreceita.php");
            });




        });
    </script>
    <title>Minha conta</title>
</head>
<body class="cinzou">
    <?php

    include "../header.php";
    ?>


    <div class="container-fluid margin-tmais">
        <aside>
            <div class="row">
            <div class="btn-group col-md-offset-5" role="group">
                <input type="button" class="btn btn-default" value="Meus dados" id="dados" />
                <input type="button" class="btn btn-default" value="Receitas Favoritas" id="receitas" />
                <input type="button" class="btn btn-default" value="Meus Ingredientes" id="ingredientes" />
                <input type="button" class="btn btn-default" value="Enviar Receita" id="enviareceita">
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
                        <input type="text" class="form-control" name="nome" value="<?=$linha['nomeusuario']?>" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Email</span>
                        <input type="email" class="form-control" name="email" value="<?=$linha['email']?>" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Senha</span>
                        <input type="password" class="form-control" name="senha" value="<?=$linha['senha']?>" required>
                    </div>

                    <input type="submit" class="btn btn-default" name="salvar" value="Salvar">
                </form>
                </div>

               

        </div>
    <?php
    include "../footer.php";
    ?>


</body>
</html>
