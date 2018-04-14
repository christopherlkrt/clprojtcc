<?php
if (isset($_POST['editusuario'])) {
    
include "../model/usuario.class.php";
include "../model/usuarioOP.class.php";

?>
        <div class="container caixabranca col-md-offset-5" id="retorno">
           
                <form action="../controller/usuario.php" method="post" class="col-md-offset-4" enctype="multipart/form-data">


                    <div class="input-group form-group margin-t5">
                        <img src="../imgs/usuarios/<?=$imgusuario?>" class="img-responsive img-circle profile-user-pic" alt="Imagem do Usuario">
                        <span>Imagem</span>
                        <input type="file" class="form-control" name="imgusuario">
                    </div>
                    <div class="input-group form-group">
                        <span>Nome</span>
                        <input type="text" class="form-control" name="nome" value="<?=$linha['nomeusuario']?>" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Email</span>
                        <input type="email" class="form-control" name="email" value="<?=$linha['email']?>" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Senha</span>
                        <input type="password" class="form-control" name="senha" value="<?=$linha['senha']?>" required>
                    </div>

                    <input type="submit" class="btn btn-default" name="salvar" value="Salvar">
                </form>
        </div>
<?php   
}
else if(isset($_POST['editreceita'])) {
?>  
        <div class="container caixabranca col-md-offset-5" id="retorno">
           
                <form action="../controller/usuario.php" method="post" class="col-md-offset-4" enctype="multipart/form-data">


                    <div class="input-group form-group margin-t5">
                        <img src="../imgs/usuarios/<?=$imgusuario?>" class="img-responsive img-circle profile-user-pic" alt="Imagem do Usuario">
                        <span>Imagem</span>
                        <input type="file" class="form-control" name="imgusuario">
                    </div>
                    <div class="input-group form-group">
                        <span>Nome</span>
                        <input type="text" class="form-control" name="nome" value="<?=$linha['nomeusuario']?>" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Email</span>
                        <input type="email" class="form-control" name="email" value="<?=$linha['email']?>" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Senha</span>
                        <input type="password" class="form-control" name="senha" value="<?=$linha['senha']?>" required>
                    </div>

                    <input type="submit" class="btn btn-default" name="salvar" value="Salvar">
                </form>
        </div>
<?php
}
else if (isset($_POST['editing'])) {
?>
       <div class="container caixabranca col-md-offset-5" id="retorno">
               
                    <form action="../controller/usuario.php" method="post" class="col-md-offset-4" enctype="multipart/form-data">


                        <div class="input-group form-group margin-t5">
                            <img src="../imgs/usuarios/<?=$imgusuario?>" class="img-responsive img-circle profile-user-pic" alt="Imagem do Usuario">
                            <span>Imagem</span>
                            <input type="file" class="form-control" name="imgusuario">
                        </div>
                        <div class="input-group form-group">
                            <span>Nome</span>
                            <input type="text" class="form-control" name="nome" value="<?=$linha['nomeusuario']?>" required>
                        </div>

                        <div class="input-group form-group">
                            <span>Email</span>
                            <input type="email" class="form-control" name="email" value="<?=$linha['email']?>" required>
                        </div>

                        <div class="input-group form-group">
                            <span>Senha</span>
                            <input type="password" class="form-control" name="senha" value="<?=$linha['senha']?>" required>
                        </div>

                        <input type="submit" class="btn btn-default" name="salvar" value="Salvar">
                    </form>
            </div>
<?php
} ?>