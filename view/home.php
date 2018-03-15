<?php
session_start();
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['idusuario']);
    unset($_SESSION['nusuario']);
    echo "entrou";
}
else if(isset($_SESSION['idusuario'])){
    $idusuario = $_SESSION['idusuario'];
    $nusuario = $_SESSION['nusuario'];
    
}
include "../model/receitaOP.class.php";
$receitaop= new ReceitaOP();
$obj=$receitaop-> getAll();
$linhas=sizeof($obj);


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
			<div class ="container-fluid  col-md-offset-1">
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
                if(isset($_SESSION['idusuario'])){

                ?>
                <div class="navbar-right col-md-2">
				<ul class="nav navbar-nav nav-pills">
					<li><a class="branco dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><?php echo $nusuario ?></a>

                        <ul class="dropdown-menu">
                            <li><a href="conta.php">Minha Conta</a></li>
                            <li><a href="cadreceita.php">Enviar Receita</a></li>
                            <li><a href="home.php?logout" name="logout">Sair</a></li>
                        </ul>


                    </li>
				</ul>
                </div>

                <?php
                }
                else{
                ?>
                <!-- aaaaaa -->
                <div class="navbar-right col-md-2">
                <ul class="nav navbar-nav">
                    <li><a class="branco" href="#" data-toggle="modal" data-target="#modalCadastro">Cadastrar</a></li>
                    <li><a class="branco" href="#" data-toggle="modal" data-target="#modalEntrar">Entrar</a></li>
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



    <!--carousel-slide-->
	<!--<div class="home-slide"></div>home-slide-->

    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner" role="listbox">
            <div class="item active" style="background-image: url(../imgs/torta1.jpg);">
                <div class="carousel-caption">
                    primeiro
                </div>
            </div>


            <div class="item" style="background-image: url(../imgs/pexels-photo-295043.jpeg);">
                <div class="carousel-caption">
                    segundo
                </div>
            </div>


            <div class="item" style="background-image: url(../imgs/pexels-photo-376464.jpeg);">
                <div class="carousel-caption">
                    terceiro
                </div>
            </div>
        </div><!--carousel inner-->

        <a href="#carousel" class="left carousel-control" data-slide="prev">
            <i class="glyphicon glyphicon-chevron-left"></i>
        </a>
        <a href="#carousel" class="right carousel-control" data-slide="next">
            <i class="glyphicon glyphicon-chevron-right"></i>
        </a>
    </div><!--carousel-->


	<!-- conteudo-receitas-->
    <section class="container">
             <div class="row">

                <?php
                for($i=0;$i<$linhas;$i++)
                {
                 ?>
                        <div class="col-sm-3 margin-t5">
                           <a href="receita.php?idreceita=<?=$obj[$i]['idreceita']?>">
                              <figure>
                                 <img src="../imgs/<?=$obj[$i]['imgreceita']?>" class="img-responsive" alt="<?=$obj[$i]['nomereceita']?>">
                             </figure>
                                 <h3 class="thumbnail-title"><?=$obj[$i]['nomereceita']?></h3>
                            </a>
                        </div>
            
        
        <?php 
            }
        ?>


                 
        </div>
</section>

<footer>
<div class="preto col-sm-12 margin-t5">
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
