<?php
session_start();

$id=$_GET['idreceita'];

include "../model/receitaOP.class.php";
$receitaop= new ReceitaOP();
$obj_receita=$receitaop-> getReceita($id);
$obj_ingrediente=$receitaop-> getIngrediente($id);
$linha=sizeof($obj_ingrediente);
$nota_receita=$receitaop-> getNotaReceita($id);

if(isset($_SESSION['idusuario'])){

    $idusuario = $_SESSION['idusuario'];
    $nusuario = $_SESSION['nusuario'];
    if (!$_SESSION['imgusuario']){
        $imgusuario = 'user-icon.png';
    }
    else if (isset($_SESSION['imgusuario'])) {
        $imgusuario = $_SESSION['imgusuario'];
    }

    include "../model/usuarioOP.class.php";
    $notaop= new UsuarioOP();
    $idreceita=$obj_receita['idreceita'];
    $nota_usuario= $notaop->getNotaUsuario($idusuario, $idreceita);

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

</head>
<body>
	<?php

    include "../header.php";
    ?>

  

    <div class="container margin-t5">
    <div class="row meio text-center">
    	            <!-- Rating Stars Box -->
            <div class="rating-stars text-center col-md-3 rate-size">
                <h3>Avalie</h3>
                <ul id="stars">
                  <li class="star <?php if($nota_usuario['notausuario']>=1) echo 'selected'; ?>" title="Poor" data-value="1">
                    <i class="fa fa-star fa-fw"></i>
                  </li>
                  <li class="star <?php if($nota_usuario['notausuario']>=2) echo 'selected'; ?>" title="Fair" data-value="2">
                    <i class="fa fa-star fa-fw"></i>
                  </li>
                  <li class="star <?php if($nota_usuario['notausuario']>=3) echo 'selected'; ?>" title="Good" data-value="3">
                    <i class="fa fa-star fa-fw"></i>
                  </li>
                  <li class="star <?php if($nota_usuario['notausuario']>=4) echo 'selected'; ?>" title="Excellent" data-value="4">
                    <i class="fa fa-star fa-fw"></i>
                  </li>
                  <li class="star <?php if($nota_usuario['notausuario']>=5) echo 'selected'; ?>" title="WOW!!!" data-value="5">
                    <i class="fa fa-star fa-fw"></i>
                  </li>
                </ul>
            </div>
            <h3 class="col-md-3">Preparo</h3>
            <h3 class="col-md-3">Tempo</h3>
            <h3 class="col-md-3">Nota <?=$nota_receita['media']?></h3>
            

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

            <h2><?=$obj_receita['nomereceita']?></h2><input type="hidden" id="idreceita" value="<?=$obj_receita['idreceita']?>">   
            <p><?=$obj_receita['descricao']?><p>

            </div>
             
        </div>
    </div>
</section>



<?php

    include "../footer.php";
    ?>

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

<script>
    
$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }

    <?php 
    if(isset($_SESSION['idusuario']))
    {
    ?>

     var receita=document.getElementById("idreceita").value;
    $.post("../controller/nota_usuario.php",
    {
        idreceita: receita,
        nota: onStar

    });
    <?php
    }
    ?>

  });
  
  
});


function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");
}

</script>
</html>
