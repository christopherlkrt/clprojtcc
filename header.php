<header>
        <div class="row">
		<nav class="navbar navbar-fixed-top navbar-paprica">
			<div class ="col-md-offset-1">
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
					<li><a class="branco dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><img src="../imgs/usuarios/<?=$imgusuario?>" class="img-responsive menu-user-pic" alt="Imagem do Usuario"><?php echo $nusuario ?><b class="caret"></b></a>

                        <ul class="dropdown-menu">
                            <li><a href="conta_dados.php">Minha Conta</a></li>
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
                <div class="navbar-right col-md-3">
                <ul class="nav navbar-nav">
                    <li><a class="branco" href="#" data-toggle="modal" data-target="#modalCadastro">Cadastrar</a></li>
                    <li><a class="branco" href="#" data-toggle="modal" data-target="#modalEntrar">Entrar</a></li>
                </ul>
                </div>
                <?php 
                }
                ?>

			</div>
		</nav>
        </div>
	</header>