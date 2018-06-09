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
                        <input type="hidden" id="idusuario" name="salvaradmin" value="<?=$idusuario?>">
                    </div>

                    <div class="input-group form-group">
                        <span>Email</span>
                        <input type="email" class="form-control" id="email" name="email" value="<?=$linhau['email']?>" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Senha</span>
                        <input type="password" class="form-control" id="senha" name="senha" value="<?=$linhau['senha']?>" required>
                    </div>

                    <div class="input-group form-group">
                      <label for="isadmin">Admin?</label>
                      <input type="checkbox" <?php if($linhau['isAdmin']==1) echo "checked"?> name="isAdmin" id="isAdmin" value="1">
                    </div>

                    <input type="submit" class="btn btn-default" value="Salvar">
                </form>
        </div>

<script>
	$( "form" ).on( "submit", function( event ) {
	  event.preventDefault();
 
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

	});

</script>