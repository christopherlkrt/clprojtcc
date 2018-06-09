<?php

include "../model/receitaOP.class.php";
$receitaop= new ReceitaOP();
$idvisitado=$_GET['visitado'];
$receitas_visitado=$receitaop-> getVisitadoFavoritas($idvisitado);
$obj_visitado=$receitaop-> getReceitaDono($idvisitado);
$linhas=sizeof($receitas_visitado);

?>



<html>
<head>
</head>
<body>

 <!-- conteudo-receitas-->
 <h4>Receitas Favoritas e Avaliações de <?=$obj_visitado['nomeusuario']?></h4>

 <?php
                  for($i=0;$i<$linhas;$i++)
                  {
 ?>
        <div class="container caixabranca col-sm-3 margin-t5" id="retorno">
         <a href="receita.php?idreceita=<?=$receitas_visitado[$i]['idreceita']?>" class="no-style">
          <figure>
           <img src="../imgs/receitas/<?=$receitas_visitado[$i]['imgreceita']?>" class="img-responsive" alt="<?=$receitas_visitado[$i]['nomereceita']?>">
       </figure>
       <h3 class="thumbnail-title"><?=$receitas_visitado[$i]['nomereceita']?></h3>       
   </a>
   <p class="meio mini-texto">Nota desse usuario:</p>
    <div class="meio">

        <?php
                      $l = $receitas_visitado[$i]['notausuario'];

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
                          echo "<i class ='icon-star star-paprica'></i> ";
                        else if ($l - $j >0)
                          echo "<i class ='icon-star-half-alt star-paprica'></i>";
                        else
                           echo "<i class ='icon-star-empty star-paprica'></i>";
                      }

              ?>
      </div>
    </div>


<?php 
           }
?>

</body>
</html>