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


  <div class="row margin-t5 form-inline">
    <div class="col-md-4 col-md-offset-2">
      <input type="text" class="form-control tags-auto" id="tags-input" name="adding" id="adding">
      <input type="submit" class="btn btn-default" name="add" id="add" value="+">
    </div>

     <div class="col-md-4 col-md-offset-2 form-group">
      <input type="text" class="form-control tags-auto" id="tags-input" name="removeing">
      <input type="submit" class="btn btn-default" name="remove" id="remove" value="+">
    </div>
  </div>
    
   <!-- conteudo-receitas-->
   <div class="row">
              <div class="col-md-6 lista-ingredientes">
           
            
                <ul><h3 class="text-center">Meus Ingredientes</h3>
               <?php
                for($i=0;$i<$linhas;$i++)
                {
                 ?>
                        
                      
                                 <h3 class="thumbnail-title"><li name="<?=$obj[$i]['idingrediente']?>"><?=$obj[$i]['nomeingrediente']?><span class="glyphicon glyphicon-remove"></li></h3>
        
        <?php 
            }
        ?>
        </ul>
        </div>

        <div class="col-md-6 lista-ingredientes">
          
          <ul><h3 class="text-center">Ingredientes Restringidos</h3>

             <?php
                for($i=0;$i<$linhas2;$i++)
                {
                 ?>
                        
        
                                 <h3 class="thumbnail-title"><li name="<?=$obj2[$i]['idingrediente']?>"><?=$obj2[$i]['nomeingrediente']?><span class="glyphicon glyphicon-remove"></li></h3>
        
        <?php 
            }
        ?>


          </ul>
        </div>
        </div>
        

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
        return $.map(list, function(item) {
          return { id: item.id, name: item.name }; });
      }
    }
  });
  ingredientes.initialize();

  $('.tags-auto').tagsinput({
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

   $('.lista-ingredientes').on("click",".glyphicon",function(e) {
                e.preventDefault();
                var deletaing= $(this).parent('li').attr('name');
                $.post("../controller/ingrediente.php",
              {
                  deletaing: deletaing
              });

               $(this).parent('li').remove();

               
        });


       $('.form-inline').on("click","#add",function(e) {
                e.preventDefault();
               
                var adding = $(this).prev().val();
               
                $.post("../controller/ingrediente.php",
              {
                  adding: adding
              });

               $("#retorno").load("conta_ingredientes.php");
               
        });

        // $( "#add" ).click(function() {
        //   alert($(this).parent('input').attr('value'));
        // });



  </script>