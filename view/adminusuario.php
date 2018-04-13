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

$usuarioop = new UsuarioOP();
$objusuarios = $usuarioop->getAll();
$linhas = sizeof($objusuarios);

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
                location.reload();
            });

            $("#ingredientes").click(function(){
                $("#retorno").load("admining.php");
            });

            $("#enviareceita").click(function(){
                $("#retorno").load("cadreceita.php");
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
     <div class="row caixabranca">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Usuários</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Usuário</th>
                  <th>E-mail</th>
                  <th>Operações</th>
                </tr>
                <?php
                for ($i=0; $i < $linhas ; $i++) { 
                ?>
                <tr>
                  <td><?=$objusuarios[$i]['idusuario']?></td>
                  <td><?=$objusuarios[$i]['nomeusuario']?></td>
                  <td><?=$objusuarios[$i]['email']?></td>
                  <td name="<?=$objusuarios[$i]['idusuario']?>"><button class="btn btn-default"><i class="icon-pencil"></i>Editar</button><button class="btn btn-default" id="deletarusu"><i class="icon-cancel"></i>Deletar</button></td>
                </tr>
                <?php
                }
                ?>
                <td><button class="btn btn-default"><i class="icon-plus"></i>Adicionar</button></td>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
            <script>
        
          $('.table').on("click","#deletarusu",function(e) {
          e.preventDefault();
         
          var deletar = $(this).parent('td').attr('name');

          $.post("../controller/usuario.php",
        {
            deletar: deletar
        });

         location.reload();
         
        });

      </script>

     </div>   
    <?php
    include "../footer.php";
    ?>


</body>
</html>

