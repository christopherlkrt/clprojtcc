<?php
include "../model/receitaOP.class.php";
include "../model/categoriaOP.class.php";
session_start();
if(isset($_SESSION['idusuario'])){

  $idusuario = $_SESSION['idusuario'];
  $nusuario = $_SESSION['nusuario'];
  $imgusuario = $_SESSION['imgusuario'];
}
else if(isset($_POST['logout'])){
  session_destroy();
  header("location: ../view/busca.php");
}

?>

<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/home.css">
  <link rel="stylesheet" type="text/css" href="../fafontello/css/fontello.css">
  <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/jquery-ui.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../js/typeahead.js"></script>
  <script src="../bootstrap/js/bootstrap-tagsinput.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-tagsinput.css">
  <link rel="stylesheet" type="text/css" href="../css/typeahead.css">
</head>
<body>
  <?php

  include "../header.php";
  ?>

  <div class="row margin-nav">
    <form class="form-inline col-md-3 col-md-offset-4 col-lg-offset-4" method="post" action="busca.php" id="formIngs">
      <input type="text" class="form-control" data-role="tagsinput" name="ings" id="tags-input"><button type="submit" name="buscaIngs" class="form-control" style="height: 42px;" ><i class="icon-search"></i></button>
    </form>
  </div>

  <section class="container">
   <div class="margin-t5" style="margin-bottom: 3%;">

    <aside>
     <div class="col-sm-2">
      <div class="text-center"><h3 class="titulo-fundo">Filtros</h3></div>
      <div class="btn-group btn-block">
        <button type="button" class="btn btn-default dropdown-toggle button-width" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categorias <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <?php $categoriaop = new CategoriaOP();
          $categorias = $categoriaop-> getAll();
          $linhascat= sizeof($categorias);

          for ($i=0; $i < $linhascat; $i++) { 
            ?>
            <li><a href="busca.php?categoria=<?=$categorias[$i]['id']?>"><?=$categorias[$i]['nome']?></a></li>
            <?php } ?>
          </ul>
        </div>
        <div class="btn-group btn-block">
         <button type="button" class="btn btn-default dropdown-toggle button-width" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dietas <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="#">Em breve!</a></li>
        </ul>

      </div>

    </div>
  </aside>

  <?php
  if (isset($_GET['categoria'])) {
     include "../model/receita_categoriaOP.class.php";
    $categoria=$_GET['categoria'];
    $receitacatop= new ReceitaCatOP();
    $receitaop = new ReceitaOP();
    $obj_receitacat= $receitacatop-> getAllReceitaCat($categoria);
    $linhacat = sizeof($obj_receitacat);
    if($linhacat>0){ ?>
    <h3>As receitas da categoria <?=$obj_receitacat[0]['nome']?> são:</h3>
    <div class="row flex flex-wrap">

      <?php
      for($i=0;$i<$linhacat;$i++)
        { $nota_receita=$receitaop-> getNotaReceita($obj_receitacat[$i]['idreceita']);
      ?>
      <div class="col-sm-3 margin-t5">
       <a class="no-style" href="receita.php?idreceita=<?=$obj_receitacat[$i]['idreceita']?>">
        <figure>
         <img src="../imgs/receitas/<?=$obj_receitacat[$i]['imgreceita']?>" class="img-responsive" alt="<?=$obj_receitacat[$i]['nomereceita']?>">
       </figure>
       <h3 class="thumbnail-title"><?=$obj_receitacat[$i]['nomereceita']?></h3>
     </a>
     <div class="meio">
      <?php
      $l = $nota_receita['media'];
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
 <?php } ?>
</div>
<?php } else {
  ?>
  <div class="meio">
    <h4 class="margin-tmais">Não encontramos nada, tente pesquisar outra categoria.</h4>
    <?php
  }
}
else if (isset($_POST['buscaIngs'])){ 
  if ($_POST['ings']!=null) {
  $itens = $_POST['ings']; 
  $receitaop = new ReceitaOP();
  $obj = $receitaop-> buscaIngs($itens);
  $linhas= sizeof($obj);
    ?>
    <h3>Os resultados da sua pesquisa por ingredientes são:</h3>
    <div class="row flex flex-wrap">

      <?php
      for($i=0;$i<$linhas;$i++)
        { $nota_receita=$receitaop-> getNotaReceita($obj[$i]['idreceita']);
      ?>
      <div class="col-sm-3 margin-t5">
        <a class="no-style" href="receita.php?idreceita=<?=$obj[$i]['idreceita']?>">
         <figure>
          <img src="../imgs/receitas/<?=$obj[$i]['imgreceita']?>" class="img-responsive" alt="<?=$obj[$i]['nomereceita']?>">
        </figure>
        <h3 class="thumbnail-title"><?=$obj[$i]['nomereceita']?></h3>
      </a>
      <div class="meio">
        <?php
        $l = $nota_receita['media'];
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
 } } else {
  ?>
  <div class="meio">
    <h4 class="margin-tmais">Não encontramos nada, tente pesquisar outro(s) ingredientes.</h4>
  </div>
  <?php }
} else if ($_POST['pesquisa']!=NULL) { 
  $itens = $_POST['pesquisa']; 
  $receitaop = new ReceitaOP();
  $obj = $receitaop->getBusca($itens);
  $linhas=sizeof($obj);
  if($linhas>0){
    ?>
    <h3>Os resultados da sua pesquisa são:</h3>
    <div class="row flex flex-wrap">

      <?php
      for($i=0;$i<$linhas;$i++)
        { $nota_receita=$receitaop-> getNotaReceita($obj[$i]['idreceita']);
      ?>
      <div class="col-sm-3 margin-t5">
        <a class="no-style" href="receita.php?idreceita=<?=$obj[$i]['idreceita']?>">
         <figure>
          <img src="../imgs/receitas/<?=$obj[$i]['imgreceita']?>" class="img-responsive" alt="<?=$obj[$i]['nomereceita']?>">
        </figure>
        <h3 class="thumbnail-title"><?=$obj[$i]['nomereceita']?></h3>
      </a>
      <div class="meio ">
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
                                 </div>

                                 <?php } else{
                                  ?>
                                  <div class="meio">
                                   <h4 class="margin-tmais">Não encontramos nada, tente pesquisar outra coisa.</h4>
                                 </div>
                                 <?php } }
                                 else {
                                  ?> 
                                  <div class="meio">
                                   <h4 class="margin-tmais">Não encontramos nada, tente pesquisar outra coisa.</h4>
                                 </div>
                                 <?php } ?>

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
                       var ingredientes = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        prefetch: {
                          url: '../controller/ingrediente-tags.php',
                          cache: false,
                          filter: function(list) {
                            return $.map(list, function(item) {
                              return { id: item.id, name: item.name }; });
                          }
                        }
                      });
                       ingredientes.initialize();
                       $('#tags-input').tagsinput({
                        itemValue: function(item) {
                          return item.id;
                        },
                        itemText: function(item) {
                          return item.name;
                        },
                        typeaheadjs: {
                          name: 'categorias',
                          displayKey: 'name',
                          source: ingredientes.ttAdapter()
                        }

                      });

                       </script>
                       </html>
