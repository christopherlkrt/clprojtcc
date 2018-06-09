<?php
session_start();
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['idusuario']);
    unset($_SESSION['nusuario']);
}
else if(isset($_SESSION['idusuario'])){
    $idusuario = $_SESSION['idusuario'];
    $nusuario = $_SESSION['nusuario'];
    $imgusuario = $_SESSION['imgusuario'];
    
}

include "../model/receitaOP.class.php";
$receitaop= new ReceitaOP();
$obj=$receitaop-> getAll();
$linhas=sizeof($obj);




?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/home.css">
  <link rel="stylesheet" type="text/css" href="../fafontello/css/fontello.css">
	<script src="../js/jquery-3.2.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
  

</head>
<body>
    <?php

	include "../header.php";
    ?>
    

 
    <!--carousel-slide-->
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner" role="listbox">
            <div class="item active" style="background-image: url(../imgs/receitas/torta1.jpg);">
                <div class="carousel-caption">
                    primeiro
                </div>
            </div>


            <div class="item" style="background-image: url(../imgs/receitas/pexels-photo-2.jpeg);">
                <div class="carousel-caption">
                    segundo
                </div>
            </div>


            <div class="item" style="background-image: url(../imgs/receitas/pexels-photo-1.jpeg);">
                <div class="carousel-caption">
                    terceiro
                </div>
            </div>
        </div>


        <a href="#carousel" class="left carousel-control" data-slide="prev">
            <i class="glyphicon glyphicon-chevron-left"></i>
        </a>
        <a href="#carousel" class="right carousel-control" data-slide="next">
            <i class="glyphicon glyphicon-chevron-right"></i>
        </a>
    </div>


    <!--carousel-->


	<!-- conteudo-receitas-->
    <section class="container">
             <div class="row">

                <?php
                for($i=0;$i<$linhas;$i++)
                { $nota_receita=$receitaop-> getNotaReceita($obj[$i]['idreceita']);
                 ?>
                        <div class="col-sm-3 margin-t5">
                           <a href="receita.php?idreceita=<?=$obj[$i]['idreceita']?>">
                              <figure>
                                 <img src="../imgs/receitas/<?=$obj[$i]['imgreceita']?>" class="img-responsive" alt="<?=$obj[$i]['nomereceita']?>">
                             </figure>
                             <div class="thumbnail"> <h3 class="thumbnail-title"><?=$obj[$i]['nomereceita']?></h3>
                            </a>
                            <div class="meio">
                            <?php
                                          $l = $nota_receita['media'];

                    /*                      for($j = 0;  $j<$l; $j++)
                                            echo "<i class ='icon-star star-paprica'></i> ";

                                          if($receitas_visitado[$i]['notausuario'] - $l != 0) {
                                            $j++;
                                             echo "<i class ='icon-star-half-alt star-paprica'></i>";
                                           }
                                          while($j <5) {
                                            $j++;
                                            echo "<i class ='icon-star-empty star-paprica'></i>";
                                          }
                    */
                                          for($j = 0;  $j<5; $j++) {
                                            if($l - $j >= 1)
                                              echo "<i class ='icon-star star-paprica star-maior'></i> ";
                                            else if ($l - $j >0)
                                              echo "<i class ='icon-star-half-alt star-paprica star-maior'></i>";
                                            else
                                               echo "<i class ='icon-star-empty star-paprica star-maior'></i>";
                                          }

                                  ?>
                            </div>
                        </div>
                        </div>
            
        
        <?php 
            }
        ?>


                 
        </div>
</section>


<?php
include "../footer.php";

?>
</body>
</html>
