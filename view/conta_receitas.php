<?php

include "../model/receitaOP.class.php";
$receitaop= new ReceitaOP();
$obj=$receitaop-> getUsuarioReceitas();
$linhas=sizeof($obj);

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
    
   <!-- conteudo-receitas-->
    <section class="container margin-t5">
            <h3>Receitas Favoritas</h3>
             <div class="row">

                <?php
                for($i=0;$i<$linhas;$i++)
                {
                 ?>
                        <div class="col-sm-3 margin-t5">
                           <a href="receita.php?idreceita=<?=$obj[$i]['idreceita']?>">
                              <figure>
                                 <img src="../imgs/<?=$obj[$i]['imgreceita']?>" class="img-responsive" alt="<?=$obj[$i]['nomereceita']?>">
                             </figure>
                                 <h3 class="thumbnail-title"><?=$obj[$i]['nomereceita']?></h3>
                            </a>
                        </div>
            
        
        <?php 
            }
        ?>
</body>
</html>