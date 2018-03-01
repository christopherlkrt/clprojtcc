<?php
session_start();
if(isset($_SESSION['idUsuario'])){

    $idUsuario = $_SESSION['idUsuario'];
    $nUsuario = $_SESSION['nUsuario'];
}

$id=$_GET['idreceita'];

include "../model/receitaOP.class.php";
$receitaop= new ReceitaOP();
$obj_receita=$receitaop-> getReceita($id);
$obj_ingrediente=$receitaop-> getIngrediente($id);
$linha=sizeof($obj_ingrediente);
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../fafontello/css/fontello.css">
	<script src="../js/jquery-3.2.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
	<header>
		<nav class="navbar navbar-fixed-top navbar-paprica">
			<div class ="container-fluid  col-md-offset-2">
                <div class="navbar-header col-md-2">
				<a class="navbar-brand branco" href="home.php">Paprica</a>
                </div>
                <div class="col-md-4 col-md-offset-1">
				<form class="navbar-form">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Pesquisa">
					</div>
					<button type="submit" class="btn btn-default">Pesquisar</button>
				</form>
				</div>

                <?php
                if(isset($_SESSION['idUsuario'])){

                ?>
                <div class="navbar-right col-md-2">
				<ul class="nav navbar-nav">
					<li><a class="branco" href="usuario.html"><?php echo $nUsuario ?></a></li>
				</ul>
                </div>

                <?php
                }
                else{
                ?>

                <div class="navbar-right col-md-2">
                <ul class="nav navbar-nav">
                    <li><a class="branco" data-toggle="modal" data-target="#modalCadastro">Cadastrar</a></li>
                    <li><a class="branco" data-toggle="modal" data-target="#modalEntrar">Entrar</a></li>
                </ul>
                </div>
                <?php 
                }
                ?>

			</div><!--container-fluid-->
		</nav>
	</header>

    <!--modals-->

 <div class="modal fade" id="modalCadastro">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal"><span ara-hidden="true">&times;</span></button>
                 <h3>Faça seu cadastro!</h3>
             </div>
             <div class="modal-body meio">
                     <form action="../controller/usuario.php" method="post" class="">
                    <div class="input-group form-group">
                        <span>Nome</span>
                        <input type="text" class="form-control" name="nome" placeholder="Ex. Cleber" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Email</span>
                        <input type="email" class="form-control" name="email" placeholder="exemplo@email.com" required>
                    </div>

                    <div class="input-group form-group">
                        <span>Senha</span>
                        <input type="password" class="form-control" name="senha" placeholder="******" required>
                    </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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
                     <form action="../controller/usuario.php" method="post" class="">
                        <div class="input-group form-group">
                            <span>Email</span>
                            <input type="email" class="form-control" name="email" placeholder="exemplo@email.com" required>
                        </div>

                        <div class="input-group form-group">
                            <span>Senha</span>
                            <input type="password" class="form-control" name="senha" placeholder="******" required>
                        </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 <input type="submit" class="btn btn-default" name="entrar" value="Entrar">
                 </form>
             </div>

         </div><!--modal-content-->
     </div><!--modal-dialog-->
 </div><!--modal-->

    <div class="container margin-t5">
    <div class="row meio text-center">
    	<div class="col-md-6 col-md-offset-2">
            <h3 class="col-md-2">Preparo</h3>
            <h3 class="col-md-2 col-md-offset-2">Tempo</h3>
            <h3 class="col-md-2 col-md-offset-2">Nota</h3>
        </div>
    </div>


	<!-- descrição-receita-->
    <section>
        <div class="row meio">
            <aside  class="col-md-2">
                <div>
                    <h3>Ingredientes</h3>
                    <ul class="ingredientes">
                    <?php
                    for($i=0; $i<$linha; $i++)
                    {
                    ?>

                    <li><?=$obj_ingrediente[$i]['nomeingrediente']." ".$obj_ingrediente[$i]['quantia']?></li><br/>

                    <?php
                    }

                    ?>
                    </ul>
                </div>
            </aside>

            <div class="col-md-8 min-alt">

            <h2><?=$obj_receita['nomereceita']?></h2>    
            <p><?=$obj_receita['descricao']?><p>

            </div>
             
        </div>
    </div>
</section>



<footer>
<div class="preto col-sm-12 margin-t5 no-margin-b">
	<div class="col-sm-6"><h2>Paprica</h2>
    <p>Paprica é uma fonte de receitas culinárias com o objetivo de suprir necessidades dos usuários que gostariam de filtrar o que procuram, utilizando seus ingredientes para fazer uma busca mais específica ou excluindo alguns ingredientes para quem necessitar ou apenas preferir.</p>
    </div>
	
	<div class="col-sm-6 borda">
       <a href=""><i class="icon-facebook icones-redes"></i></a>
       <a href=""><i class="icon-instagram icones-redes"></i></a>
       <a href=""><i class="icon-twitter icones-redes"></i></a>
    </div>


</div>
	
</footer>

</body>
</html>
