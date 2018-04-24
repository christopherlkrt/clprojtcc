<?php
session_start();
include "../model/usuarioOP.class.php";

$usuarioop = new UsuarioOP();
$objusuarios = $usuarioop->getAll();
$linhas = sizeof($objusuarios);

?>


     <div class="row caixabranca">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Usuários</h3>

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
                  <th>Usuário</th>
                  <th>E-mail</th>
                  <th>Operações</th>
                </tr>
                <?php
                for ($i=0; $i < $linhas ; $i++) { 
                ?>
                <tr>
                  <td><?=$objusuarios[$i]['idusuario']?></td>
                  <td><?=$objusuarios[$i]['nomeusuario']?></td>
                  <td><?=$objusuarios[$i]['email']?></td>
                  <td id="<?=$objusuarios[$i]['nomeusuario']?>" name="<?=$objusuarios[$i]['idusuario']?>"><button class="btn btn-default" id="editarusu"><i class="icon-pencil"></i>Editar</button><button class="btn btn-default" id="deletarusu"><i class="icon-cancel"></i>Deletar</button></td>
                </tr>
                <?php
                }
                ?>
                <td><button class="btn btn-default" id="addusuario"><i class="icon-plus"></i>Adicionar</button></td>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
            
<script>
      $('.table').on("click","#deletarusu",function(e) {
        e.preventDefault();
   
        var confirma=confirm('Tem certeza que deseja excluir o usuário '+$(this).parent('td').attr('id')+'?');
        if (confirma==true) {

        var deletar = $(this).parent('td').attr('name');
   
        $.post("../controller/usuario.php",
      {
          deletar: deletar
      }).done(function() {

      $("#retorno").load("adminusuario.php")
      });
      }

      });


      $('.table').on("click","#editarusu",function(e) {
        e.preventDefault();
       
        var editar = $(this).parent('td').attr('name');
        $.post("edita_usuario.php",
      {
          editar: editar

      }).done(function(data) {

      $("#retorno").html(data)
      });

      });

      $('.table').on("click","#addusuario",function(e) {
      e.preventDefault();
     
      $("#retorno").load("add_usuario.php")

    });
</script>