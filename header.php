<head>
  <script src="../js/typeahead.js"></script>
  <script src="../bootstrap/js/bootstrap-tagsinput.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-tagsinput.css">
  <link rel="stylesheet" type="text/css" href="../css/typeahead.css">
  <script src="../js/notificacoes.js"></script>
</head>

<header>
  <div class="row">
    <nav class="navbar navbar-fixed-top navbar-paprica meio">
      <div class="navbar-header col-md-offset-1 col-lg-offset-2" style="margin-top: 4px;">
        <a href="home.php"><img class="img-responsive marca" src="../imgs/papricabrand1w.png" alt="Paprica"></a>
      </div>
      <div class="col-xs-6 col-sm-5 col-md-3 col-md-offset-1" style="margin-top: 10px;">
        <form class="navbar-form" id="formBusca" action="busca.php" method="post">
         <div class="form-group flex-form input-icone">
         <input type="text" class="form-control navbusca" style="width: 100%;" name="pesquisa" placeholder="Pesquisa"/>
          <i class="icon-search"></i>
        </div>
      </form>
    </div>

    <?php
    if(isset($_SESSION['idusuario'])){
      if ($_SESSION['isAdmin']==0) {
        ?>
        <div class="col-xs-4 col-sm-4 col-md-4 col-md-offset-1 col-lg-3">
          <ul class="nav navbar-nav nav-pills">
           <li style="margin-top: 8px; font-size:20px;"><a class="branco dropdown-toggle no-style-white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><img src="../imgs/usuarios/<?=$imgusuario?>" class="img-responsive menu-user-pic" alt="Imagem do Usuario"><?php echo $nusuario ?><b class="caret"></b></a>

            <ul class="dropdown-menu">
              <li><a href="conta_dados.php">Minha Conta</a></li>
              <li><a href="conta_dados.php?ingredientes">Meus Ingredientes</a></li>
              <li><a href="home.php?logout" name="logout">Sair</a></li>
            </ul>


          </li>
          <li style="margin-top: 8px;"><a href="conta_dados.php?ingredientes" class="no-style-white"><i class="icon-clipboard icones-redes" style="color: white;"></i></a></li>
        </ul>
      </div>
      <?php
    }
    else{ ?>
    <div class="col-xs-4 col-sm-4 col-md-4 col-md-offset-1 col-lg-4">
      <ul class="nav navbar-nav nav-pills">
        <li style="margin-top: 8px; font-size:20px;"><a class="branco dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><img src="../imgs/usuarios/<?=$imgusuario?>" class="img-responsive menu-user-pic" alt="Imagem do Usuario"><?php echo $nusuario ?><b class="caret"></b></a>

          <ul class="dropdown-menu">
            <li><a href="conta_dados.php">Minha Conta</a></li>
            <li><a href="conta_dados.php?ingredientes">Meus Ingredientes</a></li>
            <li><a href="admin.php">Painel Administrador</a></li>
            <li><a href="home.php?logout" name="logout">Sair</a></li>
          </ul>


        </li>
        <li style="margin-top: 8px;"><a href="conta_dados.php?ingredientes" class="no-style-white"><i class="icon-clipboard icones-redes" style="color: white;"></i></a></li>
      </ul>
    </div>

    <?php
  }
}
else{
  ?>
  <!-- aaaaaa -->
  <div class="col-xs-4 col-sm-3 col-sm-offset-1 col-md-3 col-lg-4" style="margin-top: 10px;">
    <ul class="nav navbar-nav">
      <li><a class="branco no-style-white" href="#" data-toggle="modal" data-target="#modalCadastro">Cadastrar</a></li>
      <li><a class="branco no-style-white" href="#" data-toggle="modal" data-target="#modalEntrar">Entrar</a></li>
    </ul>
  </div>
  <?php 
}
?>

</nav>
</div>
</header>

<script>
  $(document).on('click','.icon-search',function() {
  $("#formBusca").submit();
});
  // var ingredientes = new Bloodhound({
  //   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  //   queryTokenizer: Bloodhound.tokenizers.whitespace,
  //   prefetch: {
  //     url: '../controller/ingrediente-tags.php',
  //     cache: false,
  //     filter: function(list) {
  //       return $.map(list, function(item) {
  //         return { id: item.id, name: item.name }; });
  //     }
  //   }
  // });
  // ingredientes.initialize();
  // $('.tags-auto').tagsinput({
  //   itemValue: function(item) {
  //     return item.id;
  //   },
  //   itemText: function(item) {
  //     return item.name;
  //   },
  //   typeaheadjs: {
  //     name: 'categorias',
  //     displayKey: 'name',
  //     source: ingredientes.ttAdapter()
  //   }

  // });


</script>