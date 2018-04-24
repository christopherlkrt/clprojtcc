<div class="container caixabranca col-md-offset-5">
           
                <form method="post" id="formulario" name="formulario" class="col-md-offset-4" enctype="multipart/form-data">
                    <div class="input-group form-group">
                        <span>Nome</span>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                        <input type="hidden" id="cadastro" name="cadastro" value="cadastro">
                    </div>

                    <div class="input-group form-group">
                        <span>Email</span>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Senha</span>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>

                    <input type="submit" class="btn btn-default" name="salvaradmin" value="Salvar">
                </form>
</div>

<script>
   
    $( "#formulario" ).on( "submit", function( event ) {
       event.preventDefault();
      var formdata = new FormData(this);

      var link = "../controller/usuario.php";
          $.ajax({
              type: 'POST',
              url: link,
              data: formdata ,
              processData: false,
              contentType: false
          }).done(function () {
            $("#retorno").load("adminusuario.php");
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