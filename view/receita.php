<?php
session_start();
if(isset($_SESSION['idusuario'])){

    $idusuario = $_SESSION['idusuario'];
    $nusuario = $_SESSION['nusuario'];
}

$id=$_GET['idreceita'];

include "../model/receitaOP.class.php";
$receitaop= new ReceitaOP();
$obj_receita=$receitaop-> getReceita($id);
$obj_ingrediente=$receitaop-> getIngrediente($id);
$linha=sizeof($obj_ingrediente);

    // if (!$linha['img']) {
    //     $linha['img'] = 'user-icon.png';
    // }
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../css/star-rating.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="../fafontello/css/fontello.css">
	<script src="../js/jquery-3.2.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
	<!-- <?php

    include "../header.php";
    ?>
 -->
  

    <div class="container margin-t5">
    <div class="row meio text-center">
    	<div class="col-md-6 col-md-offset-2">
            <h3 class="col-md-2">Preparo</h3>
            <h3 class="col-md-2 col-md-offset-2">Tempo</h3>
            <h3 class="col-md-2 col-md-offset-2">Nota</h3>
            <!-- Rating Stars Box -->
                  <div class="rating-stars text-center">
                    <ul id="stars">
                      <li class="star" title="Poor" data-value="1">
                        <i class="fa fa-star fa-fw"></i>
                      </li>
                      <li class="star" title="Fair" data-value="2">
                        <i class="fa fa-star fa-fw"></i>
                      </li>
                      <li class="star" title="Good" data-value="3">
                        <i class="fa fa-star fa-fw"></i>
                      </li>
                      <li class="star" title="Excellent" data-value="4">
                        <i class="fa fa-star fa-fw"></i>
                      </li>
                      <li class="star" title="WOW!!!" data-value="5">
                        <i class="fa fa-star fa-fw"></i>
                      </li>
                    </ul>
                  </div>
        </div>
    </div>


	<!-- descrição-receita-->
    <section>
        <div class="row meio">
            <aside  class="col-md-2">
                <div>
                    <h3>Ingredientes</h3>
                    <ul class="ingredientes">
                    <?php
                    for($i=0; $i<$linha; $i++)
                    {
                    ?>

                    <li><?=$obj_ingrediente[$i]['nomeingrediente']." ".$obj_ingrediente[$i]['quantia']?></li><br/>

                    <?php
                    }

                    ?>
                    </ul>
                </div>
            </aside>

            <div class="col-md-8 min-alt">

            <h2><?=$obj_receita['nomereceita']?></h2>    
            <p><?=$obj_receita['descricao']?><p>

            </div>
             
        </div>
    </div>
</section>



<footer>
<div class="preto col-sm-12 margin-t5 no-margin-b">
	<div class="col-sm-6"><h2>Paprica</h2>
    <p>Paprica é uma fonte de receitas culinárias com o objetivo de suprir necessidades dos usuários que gostariam de filtrar o que procuram, utilizando seus ingredientes para fazer uma busca mais específica ou excluindo alguns ingredientes para quem necessitar ou apenas preferir.</p>
    </div>
	
	<div class="col-sm-6 borda">
       <a href=""><i class="icon-facebook icones-redes"></i></a>
       <a href=""><i class="icon-instagram icones-redes"></i></a>
       <a href=""><i class="icon-twitter icones-redes"></i></a>
    </div>


</div>
	
</footer>

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
