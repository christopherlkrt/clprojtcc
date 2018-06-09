<?php
session_start();
include "../model/receitaOP.class.php";

$idusuario=$_SESSION['idusuario'];
$receitaop= new ReceitaOP();
$obj=$receitaop-> getUsuarioReceitas($idusuario);
$linhas=sizeof($obj);

?>



<html>
<head>
</head>
<body>

 <!-- conteudo-receitas-->
 <h3>Receitas Favoritas</h3>

 <?php
                  for($i=0;$i<$linhas;$i++)
                  { $nota_receita=$receitaop-> getNotaReceita($obj[$i]['idreceita']);
 ?>
        <div class="col-sm-3 margin-t5">
         <a href="receita.php?idreceita=<?=$obj[$i]['idreceita']?>">
          <figure>
           <img src="../imgs/receitas/<?=$obj[$i]['imgreceita']?>" class="img-responsive" alt="<?=$obj[$i]['nomereceita']?>">
       </figure>
       <h3 class="thumbnail-title"><?=$obj[$i]['nomereceita']?></h3>
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


<?php 
           }
?>

</body>
</html>