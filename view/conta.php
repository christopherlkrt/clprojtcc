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
}


  

?>



<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <title>Cadastro Usuario</title>
</head>
<body>
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
</body>
</html>