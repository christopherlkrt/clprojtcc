<div class="modal fade" id="modalCadastro">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal"><span ara-hidden="true">&times;</span></button>
                 <h3>Faça seu cadastro!</h3>
             </div>
             <div class="modal-body meio">
                     <form method="post" id="formCadastro">
                    <div class="input-group form-group">
                        <span>Nome</span>
                       <i class="icon-user"></i><input type="text" class="form-control" name="nome" placeholder="Ex. Cleber" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Email</span>
                        <i class="icon-mail-alt"></i><input type="email" class="form-control" name="email" placeholder="exemplo@email.com" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Senha</span>
                        <i class="icon-lock"></i><input type="password" class="form-control" name="senha" placeholder="******" required>
                    </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 <input type="hidden" name="cadastro" value="cadastrar">
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
                     <form method="post" id="formEntrar">
                        <div class="input-group form-group">
                            <span>Email</span>
                            <i class="icon-mail-alt"></i><input type="email" class="form-control" name="email" placeholder="exemplo@email.com" required>
                        </div>

                        <div class="input-group form-group">
                            <span>Senha</span>
                            <i class="icon-lock"></i><input type="password" class="form-control" name="senha" placeholder="******" required>
                        </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 <input type="hidden" name="entrar" value="entrar">
                 <input type="submit" class="btn btn-default" name="entrar" value="Entrar">
                 </form>
             </div>

         </div><!--modal-content-->
     </div><!--modal-dialog-->
 </div><!--modal-->

<footer>
<div class="row footer preto">
	<div class="col-sm-6 borda1"><img class="img-responsive marca" src="../imgs/papricabrand1w.png" alt="Paprica">
    <p>Paprica é uma fonte de receitas culinárias com o objetivo de suprir necessidades dos usuários que gostariam de filtrar o que procuram, utilizando seus ingredientes para fazer uma busca mais específica ou excluindo alguns ingredientes para quem necessitar ou apenas preferir.</p>
    </div>
	
	<div class="col-sm-6 margin-t1">
       <a href=""><i class="icon-facebook icones-redes"></i></a>
       <a href=""><i class="icon-instagram icones-redes"></i></a>
       <a href=""><i class="icon-twitter icones-redes"></i></a>
    </div>
</div>
</footer>

<script>
     $( "#formEntrar" ).on( "submit", function( event ) {
       event.preventDefault();
      var formdata = new FormData(this);

      var link = "../controller/usuario.php";
          $.ajax({
              type: 'POST',
              url: link,
              data: formdata,
              processData: false,
              contentType: false,
              dataType: "json",
          }).done(function (data) {
           if (data=='erro') {
            var mensagem = "<strong>Dados inválidos,</strong> tente novamente.";
            mostraDialogo(mensagem, "danger", 2500);
           }
           else{
                window.location.href="home.php";
           }
          });
    });

      $( "#formCadastro" ).on( "submit", function( event ) {
       event.preventDefault();
      var formdata = new FormData(this);

      var link = "../controller/usuario.php";
          $.ajax({
              type: 'POST',
              url: link,
              data: formdata,
              processData: false,
              contentType: false,
              dataType: "json",
          }).done(function (data) {
           if (data=='certo') {
            var mensagem = "<strong>Cadastro feito,</strong> agora você já pode acessar sua conta.";
            mostraDialogo(mensagem, "success", 2500);
            $('#modalCadastro').modal('hide');
            $('#modalEntrar').modal('show');
           }
           else{
            var mensagem = "<strong>Algo deu errado,</strong> tente novamente.";
            mostraDialogo(mensagem, "danger", 2500);
            $('#modalCadastro').modal('show');
           }
          });
    });
</script>