<?php
$idcategoria = $_POST['editar'];

include "../model/categoria.class.php";
include "../model/categoriaOP.class.php";
$categoriaop= new CategoriaOP();
$linhac= $categoriaop-> getEdit($idcategoria);
?>

<div class="container caixabranca col-md-offset-5">
           
                <form method="post" class="col-md-offset-4">
                    <div class="input-group form-group margin-t5">
                        <span>Categoria</span>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?=$linhac['nome']?>" required>
                        <input type="hidden" id="idcategoria" name="idcategoria" value="<?=$idcategoria?>">
                    </div>

                    <input type="submit" class="btn btn-default" name="salvaradmin" value="Salvar">
                </form>
</div>

<script>

    $( "form" ).on( "submit", function( event ) {

        event.preventDefault();
       $.post("../controller/categoria.php",
      {
          salvaradmin:$(idcategoria).val(),
          nome: $(nome).val(),
      }).done(function(data) {

      $("#retorno").load("admincat.php");
      });

    });

</script>