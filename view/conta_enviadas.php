<?php
session_start();
include "../model/receitaOP.class.php";

$idusuario=$_SESSION['idusuario'];
$receitaop= new ReceitaOP();
$obj=$receitaop-> getUsuarioEnviadas($idusuario);
$linhas=sizeof($obj);

?>



<html>
<head>
</head>
<body>

 <!-- conteudo-receitas-->
 <h3>Receitas Enviadas</h3>

 <?php
                  for($i=0;$i<$linhas;$i++)
                  {
 ?>
        <div class="col-sm-3 margin-t5">
         <a href="receita.php?idreceita=<?=$obj[$i]['idreceita']?>">
          <figure>
           <img src="../imgs/receitas/<?=$obj[$i]['imgreceita']?>" class="img-responsive" alt="<?=$obj[$i]['nomereceita']?>">
       </figure>
       <h3 class="thumbnail-title"><?=$obj[$i]['nomereceita']?>
       </h3>
   </a>
  <?php 
   if ($obj[$i]['statusreceita']==0) {
   ?> <span class="label label-warning meinho">Pendente</span>
   <?php } 
   else { ?>
   <h5 class="text-center"><span class="label label-success meinho">Aprovada</span><h5>
   <?php } ?>
  </div>


<?php 
           }
?>

</body>
</html>