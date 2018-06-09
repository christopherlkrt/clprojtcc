<?php
$idingrediente = $_POST['editar'];

include "../model/ingrediente.class.php";
include "../model/ingredienteOP.class.php";
$ingredienteop= new IngredienteOP();
$linhai= $ingredienteop-> getEdit($idingrediente);
?>

<div class="container caixabranca col-md-offset-5">
           
                <form method="post" class="col-md-offset-4">
                    <div class="input-group form-group margin-t5">
                        <span>Ingrediente</span>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?=$linhai['nomeingrediente']?>" required>
                        <input type="hidden" id="idingrediente" name="idingrediente" value="<?=$idingrediente?>">
                    </div>

                    <input type="submit" class="btn btn-default" name="salvaradmin" value="Salvar">
                </form>
</div>

<script>

    $( "form" ).on( "submit", function( event ) {

        event.preventDefault();
        // alert($(imgreceita).val());
        // die();
       $.post("../controller/ingrediente.php",
      {
          salvaradmin:$(idingrediente).val(),
          // img:$(imgreceita).val(),
          nome: $(nome).val(),
      }).done(function(data) {

      $("#retorno").load("admining.php");
      });

    });

</script>