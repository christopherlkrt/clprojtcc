<?php
session_start();
include "../model/usuario.class.php";
include "../model/usuarioOP.class.php";
if(isset($_SESSION['idusuario'])){

    $idusuario = $_SESSION['idusuario'];
    $nusuario = $_SESSION['nusuario'];
    $usuarioop= new UsuarioOP();
    $linha= $usuarioop-> getEdit($idusuario);
    // var_dump($linha);
    
}
else if(isset($_POST['logout'])){
    session_destroy();
    header("location: ../view/home.php");
}


  

?>



<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#receitas").click(function(){
                $("#retorno").load("conta_receitas.php");
            });
        });
    </script>
    <title>Minha conta</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-fixed-top navbar-paprica">
            <div class ="container-fluid  col-md-offset-1">
                <div class="navbar-header col-md-2">
                <a class="navbar-brand branco" href="home.php">Paprica</a>
                </div>
                <div class="col-md-4 col-md-offset-1">
                <form class="navbar-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Pesquisa">
                    </div>
                    <button type="submit" class="btn btn-default">Pesquisar</button>
                </form>
                </div>

                <?php
                if(isset($_SESSION['idusuario'])){

                ?>
                <div class="navbar-right col-md-2">
                <ul class="nav navbar-nav nav-pills">
                    <li><a class="branco dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><?php echo $nusuario ?></a>

                        <ul class="dropdown-menu">
                            <li><a href="conta.php">Minha Conta</a></li>
                            <li><a href="cadreceita.php">Enviar Receita</a></li>
                            <li><a href="home.php?logout" name="logout">Sair</a></li>
                        </ul>


                    </li>
                </ul>
                </div>

                <?php
                }
                else{
                
                header("location: ../view/home.php");
                
                }
                ?>

            </div><!--container-fluid-->
        </nav>
    </header>


    <div class="container-fluid margin-t5">
    <aside>
        <div class="">
        <input type="button" value="Minhas Receitas" id="receitas" />
        </div>
    </aside>
    <div class="container" id="retorno">    
    
    <form action="../controller/usuario.php" method="post" class="col-md-offset-5">
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
 
    
</body>
</html>