<?php
session_start();

$id=$_GET['idreceita'];

include "../model/receitaOP.class.php";
include "../model/receita_categoriaOP.class.php";
$receitaop= new ReceitaOP();
$obj_receita=$receitaop-> getReceita($id);
$obj_ingrediente=$receitaop-> getIngrediente($id);
$linha=sizeof($obj_ingrediente);
$nota_receita=$receitaop-> getNotaReceita($id);
$receitacatop= new ReceitaCatOP();
$obj_categoria=$receitacatop-> getReceitaCat($id);
$linhacat=sizeof($obj_categoria);


if ($obj_receita['idusuario']!=null) {
  $obj_usuariodono=$receitaop-> getReceitaDono($obj_receita['idusuario']);
}

if(isset($_SESSION['idusuario'])){

  $idusuario = $_SESSION['idusuario'];
  $nusuario = $_SESSION['nusuario'];
  $imgusuario = $_SESSION['imgusuario'];


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

  

  <div class="container margin-nav">
    <div class="row">
      <div class="col-md-3" style="margin-top: 20px;">
        <img src="../imgs/receitas/<?=$obj_receita['imgreceita']?>" class=" img-responsive">
        <!-- Rating Stars Box -->
        <div class="rating-stars text-center rate-size">
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

        <div>
          <h3 class="text-center">Ingredientes</h3>
          <ul style="padding-left: 70px;">
            <?php
            for($i=0; $i<$linha; $i++)
            {
              ?>

              <li><?=$obj_ingrediente[$i]['nomeingrediente']." ".$obj_ingrediente[$i]['quantia']." ".$obj_ingrediente[$i]['medida']?></li><br/>

              <?php
            }

            ?>
          </ul>
        </div>

      </div>
      <div class="col-md-8 min-alt">

        <h1><?=$obj_receita['nomereceita']?></h1><input type="hidden" id="idreceita" value="<?=$obj_receita['idreceita']?>"> 
        <h4 style="display: inline;">Nota: <?=$nota_receita['media']?>&nbsp;&nbsp;/&nbsp;&nbsp;</h4><i class="icon-tags"></i>
        <?php
        for ($i=0; $i < $linhacat; $i++) { 
        ?>
        <a class="paprica-cor" href="busca.php?categoria=<?=$obj_categoria[$i]['id']?>"><?=$obj_categoria[$i]['nome']?></a>
        <?php
        }
         if ($obj_receita['idusuario']!=null) {

          ?>
          <h5>Receita por: <a href="visitado.php?visitado=<?=$obj_receita['idusuario']?>" class="no-style"><strong><?=$obj_usuariodono['nomeusuario']?></strong></a></h5>
          <?php
        } ?>  
        <p class="r-descricao margin-tmais"><?=nl2br($obj_receita['descricao'])?><p>


        </div>


      </div>
    </div>

    <?php
    include "../footer.php";
    ?>

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
    else{
      ?>
      var mensagem = "<strong>Para avaliar você precisa estar logado.</strong>";
      mostraDialogo(mensagem, "warning", 2500);
      <?php } ?>
    });
  
  
});


    function responseMessage(msg) {
      $('.success-box').fadeIn(200);  
      $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }

  </script>
  </html>
