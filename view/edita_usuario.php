<?php
if (isset($_POST['editar'])) {

$idusuario = $_POST['editar'];

include "../model/usuario.class.php";
include "../model/usuarioOP.class.php";
$usuarioop= new UsuarioOP();
$linhau= $usuarioop-> getEdit($idusuario);
}
?>
	<div class="container caixabranca col-md-offset-5">
           
                <form  method="post" class="col-md-offset-4" enctype="multipart/form-data">
                	<div class="input-group form-group margin-t5">
                        <img src="../imgs/usuarios/<?=$linhau['img']?>" class="img-responsive img-circle profile-user-pic" alt="Imagem do Usuario">
                        <span>Imagem do Usuário</span>
                    </div>
                    <div class="input-group form-group">
                        <span>Nome</span>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?=$linhau['nomeusuario']?>" required>
                        <input type="hidden" id="idusuario" name="idusuario" value="<?=$idusuario?>">
                    </div>

                    <div class="input-group form-group">
                        <span>Email</span>
                        <input type="email" class="form-control" id="email" name="email" value="<?=$linhau['email']?>" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Senha</span>
                        <input type="password" class="form-control" id="senha" name="senha" value="<?=$linhau['senha']?>" required>
                    </div>

                    <input type="submit" class="btn btn-default" name="salvaradmin" value="Salvar">
                </form>
        </div>

<script>
	$( "form" ).on( "submit", function( event ) {
	  event.preventDefault();
 
	   $.post("../controller/usuario.php",
      {
      	  salvaradmin:$(idusuario).val(),
          nome: $(nome).val(),
          email: $(email).val(),
          senha: $(senha).val()
      }).done(function(data) {

      $("#retorno").load("adminusuario.php");
      });

	});

</script>