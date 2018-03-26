<?php
session_start();
$idusuario=$_SESSION['idusuario'];
include "../model/ingredienteOP.class.php";
$ingredienteop= new IngredienteOP();
$obj=$ingredienteop-> getUsuarioIngredientes($idusuario);
$linhas=sizeof($obj);

$obj2=$ingredienteop->getUsuarioIngredientesFora($idusuario);
$linhas2=sizeof($obj2);
?>



<html>
<head>
</head>
<body>

<form action="../controller/ingrediente.php" class="" method="post">
  <div class="row margin-t5 form-inline">
    <div class="col-md-4 col-md-offset-2">
      <input type="text" class="form-control" id="tags-input" name="ing">
      <input type="submit" class="btn btn-default" name="adding" id="adding" value="+">
    </div>

     <div class="col-md-4 col-md-offset-2 form-group">
      <input type="text" class="form-control" id="tags-input" name="ing">
      <input type="submit" class="btn btn-default" name="removeing" id="removeing" value="+">
    </div>
  </div>
    
   <!-- conteudo-receitas-->
   <div class="row">
              <div class="col-md-6">
           
            
                <ul><h3 class="text-center">Meus Ingredientes</h3>
               <?php
                for($i=0;$i<$linhas;$i++)
                {
                 ?>
                        
                           <!-- <a href="receita.php?idreceita=<?=$obj[$i]['idingrediente']?>"></a> -->
                                 <li><h3 class="thumbnail-title"><?=$obj[$i]['nomeingrediente']?><span class="glyphicon glyphicon-remove"></h3></li>
        
        <?php 
            }
        ?>
        </ul>
        </div>

        <div class="col-md-6">
          
          <ul><h3 class="text-center">Ingredientes Restringidos</h3>

             <?php
                for($i=0;$i<$linhas2;$i++)
                {
                 ?>
                        
                           <!-- <a href="receita.php?idreceita=<?=$obj[$i]['idingrediente']?>"></a> -->
                                 <li><h3 class="thumbnail-title"><?=$obj2[$i]['nomeingrediente']?><span class="glyphicon glyphicon-remove"></h3></li>
        
        <?php 
            }
        ?>


          </ul>
        </div>
        </div>
        </form>

</body>
</html>

 <script>
    
    var ingredientes = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: {
      url: '../controller/ingrediente-tags.php',
      cache: false,
      filter: function(list) {
        console.log(list);
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