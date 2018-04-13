<?php

include "../model/receitaOP.class.php";
$receitaop = new ReceitaOP();
$objreceitas = $receitaop->getAllmesmo();
$linhas = sizeof($objreceitas);

?>

     <div class="row caixabranca">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Receitas</h3>

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
                  <th>Operações</th>
                </tr>
                <?php
                for ($i=0; $i < $linhas ; $i++) { 
                ?>
                <tr>
                  <td><?=$objreceitas[$i]['idreceita']?></td>
                  <td><?=$objreceitas[$i]['nomereceita']?></td>
                  <?php if ($objreceitas[$i]['idusuario']==null) {
                    
                  
                  ?>
                  <td> </td>
                  <?php } else { ?>
                  <td><?=$objreceitas[$i]['idusuario']?></td>

                  <?php }

                    if ($objreceitas[$i]['statusreceita'] == 0 ) {
                      
                    ?>
                  <td><span class="label label-warning">Pendente</span></td>
                  <?php
                  }
                  else { ?>
                  <td><span class="label label-success">Aprovada</span></td>
                  <?php
                  } ?>
                  <td name="<?=$objreceitas[$i]['idreceita']?>"><button class="btn btn-default"><i class="icon-ok"></i>Aprovar</button><button class="btn btn-default"><i class="icon-pencil"></i>Editar</button><button class="btn btn-default" id="deletarrec"><i class="icon-cancel"></i>Deletar</button></td>
                </tr>
                 <?php
                }
                ?>
                <td><button class="btn btn-default"><i class="icon-plus"></i>Adicionar</button></td>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

      <script>
         $('.table').on("click","#deletarrec",function(e) {
        e.preventDefault();
       
        var deletar = $(this).parent('td').attr('name');

        $.post("../controller/receita.php",
      {
          deletar: deletar
      });

       $("#retorno").load("adminreceita.php");
       
      });

      </script>