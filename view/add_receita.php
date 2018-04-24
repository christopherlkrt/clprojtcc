<div class="container caixabranca col-md-offset-5">
           
                <form method="post" id="formulario" name="formulario" class="col-md-offset-4" enctype="multipart/form-data">
                    <div class="input-group form-group margin-t5">
                        <span>Imagem da Receita</span>
                        <input type="file" class="form-control" id="imgreceita" name="imgreceita" />
                    </div>
                    <div class="input-group form-group">
                        <span>Receita</span>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                        <input type="hidden" id="addreceita" name="addreceita" value="addreceita">
                    </div>

                    <div class="input-group form-group">
                        <span>Descrição</span>
                         <textarea rows="5" cols="40" class="form-control" id="descricao" name="descricao"></textarea>
                    </div>

                    <input type="submit" class="btn btn-default" id="salvaradmin" name="salvaradmin" value="Salvar">
                </form>
</div>

<script>
   
    $( "#formulario" ).on( "submit", function( event ) {
       event.preventDefault();
      var formdata = new FormData(this);

      var link = "../controller/receita.php";
          $.ajax({
              type: 'POST',
              url: link,
              data: formdata ,
              processData: false,
              contentType: false
          }).done(function () {
            $("#retorno").load("adminreceita.php");
          });



      //   event.preventDefault();
      //  $.post("../controller/receita.php",
      // {
      //     salvaradmin:$(idreceita).val(),
      //     imgreceita: imgreceita,
      //     nome: $(nome).val(),
      //     descricao: $(descricao).val()
      // }).done(function(data) {

      // $("#retorno").load("adminreceita.php");
      // });

    });


</script>