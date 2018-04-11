<?php
session_start();
include "../model/usuario.class.php";
if(isset($_SESSION['idusuario'])){

    $idusuario = $_SESSION['idusuario'];
    $nusuario = $_SESSION['nusuario'];
    $imgusuario = $_SESSION['imgusuario'];

    if (!$_SESSION['imgusuario']){
        $imgusuario = 'user-icon.png';
    }
    else if (isset($_SESSION['imgusuario'])) {
        $imgusuario = $_SESSION['imgusuario'];
    }

}
else if(isset($_POST['logout'])){
    session_destroy();
    header("location: ../view/home.php");
}
else if(!isset($_SESSION['idusuario'])){
    header("location: ../view/home.php");
}

include "../model/ingredienteOP.class.php";
$ingredienteop = new IngredienteOP();
$objing = $ingredienteop->getAll();
$linhas = sizeof($objing);

?>

<body class="cinzou">

     <div class="row caixabranca">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ingredientes</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Usuário</th>
                  <th>Status</th>
                  <th>Descricao</th>
                </tr>
                <?php
                for ($i=0; $i < $linhas ; $i++) { 
                ?>
                <tr>
                  <td><?=$objing[$i]['idingrediente']?></td>
                  <td><?=$objing[$i]['nomeingrediente']?></td>
                  <td><span class="label label-success">Approved</span></td>
                  <td>?</td>
                </tr>
                <?php
                }
                ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>


</body>
</html>
