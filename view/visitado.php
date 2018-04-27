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
                alert(location.search);
                $("#retorno").load("visitado_favoritas.php");
            });

         
            });


    </script>
</head>
<body class="cinzou">
	<?php

    include "../header.php";
    ?>

	<!-- descrição-receita-->
    <section>
        <div class="container-fluid margin-tmais">
        <div class="row">
            <aside  class="col-md-2 col-md-offset-2">
                <div>
                    <img src="../imgs/usuarios/<?=$obj_visitado['img']?>" class="img-responsive img-circle visited-user-pic" alt="Imagem do Usuario">
                    <h3 class="meio"><?=$obj_visitado['nomeusuario']?></h3>
                </div>
            </aside>
            
         
            <div class="btn-group col-md-offset-2 col-md-2" role="group">
                <input type="button" class="btn btn-default" value="Receitas Favoritas" id="favoritas" name="favoritas" />
                <input type="button" class="btn btn-default" value="Receitas Enviadas" id="enviadas" name="enviadas" />

            <div class="margin-t5" id="retorno">
              <h1 class=" meio shadow">Perfil de <?=$obj_visitado['nomeusuario']?></h1>
              
            </div> 

            </div>
      
        </div>

            
              

        
    </div>
</section>


     <div class="absoluto">

    <?php
    include "../footer.php";
    ?>
    </div>

  <!--modals-->

 <div class="modal fade" id="modalCadastro">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal"><span ara-hidden="true">&times;</span></button>
                 <h3>Faça seu cadastro!</h3>
             </div>
             <div class="modal-body meio">
                     <form action="../controller/usuario.php" method="post" class="">
                    <div class="input-group form-group">
                        <span>Nome</span>
                        <input type="text" class="form-control" name="nome" placeholder="Ex. Cleber" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Email</span>
                        <input type="email" class="form-control" name="email" placeholder="exemplo@email.com" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Senha</span>
                        <input type="password" class="form-control" name="senha" placeholder="******" required>
                    </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 <input type="submit" class="btn btn-default" name="cadastro" value="Cadastrar">
                 </form>
             </div>

         </div><!--modal-content-->
     </div><!--modal-dialog-->
 </div><!--modal-->


<div class="modal fade" id="modalEntrar">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal"><span ara-hidden="true">&times;</span></button>
                 <h3>Acesse sua conta.</h3>
             </div>
             <div class="modal-body meio">
                     <form action="../controller/usuario.php" method="post" class="">
                        <div class="input-group form-group">
                            <span>Email</span>
                            <input type="email" class="form-control" name="email" placeholder="exemplo@email.com" required>
                        </div>

                        <div class="input-group form-group">
                            <span>Senha</span>
                            <input type="password" class="form-control" name="senha" placeholder="******" required>
                        </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 <input type="submit" class="btn btn-default" name="entrar" value="Entrar">
                 </form>
             </div>

         </div><!--modal-content-->
     </div><!--modal-dialog-->
 </div><!--modal-->
</body>


</html>
