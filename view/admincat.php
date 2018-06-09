<?php
include "../model/categoriaOP.class.php";
$categoriaop = new CategoriaOP();
$objcat = $categoriaop->getAll();
$linhas = sizeof($objcat);

?>


     <div class="row caixabranca largo" style="min-width: 48%;">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Categorias</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Operações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i=0; $i < $linhas ; $i++) { 
                ?>
                <tr>
                  <td><?=$objcat[$i]['id']?></td>
                  <td><?=$objcat[$i]['nome']?><input type="hidden" id="nome" value="<?=$objcat[$i]['nomeingrediente']?>" /></td>
                  <td id="<?=$objcat[$i]['nome']?>" name="<?=$objcat[$i]['id']?>"><button class="btn btn-default" id="editarcat"><i class="icon-pencil"></i>Editar</button><button class="btn btn-default" id="deletarcat"><i class="icon-cancel"></i>Deletar</button></td>
                </tr>
                <?php
                }
                ?>
                </tbody>
                <tfoot>
                <td><button class="btn btn-default" id="catadd"><i class="icon-plus"></i>Adicionar</button></td>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

<script>
       $(document).ready(function() {
    $('table').dataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      language:{
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
        }
      },
      "lengthMenu": [[8, 16, 24, -1], [8, 16, 24, "All"]]
      })
  });


    
         $('.table').on("click","#deletarcat",function(e) {
        e.preventDefault();

         var confirma=confirm('Tem certeza que deseja excluir o ingrediente '+$(this).parent('td').attr('id')+'?');
        if (confirma==true) {

        var deletar = $(this).parent('td').attr('name');
   
        $.post("../controller/categoria.php",
      {
          deletar: deletar
      }).done(function() {

      $("#retorno").load("admincat.php")
      });
      }

      });

        $('.table').on("click","#editarcat",function(e) {
      e.preventDefault();
     
      var editar = $(this).parent('td').attr('name');
      $.post("edita_categoria.php",
    {
        editar: editar

    }).done(function(data) {

    $("#retorno").html(data)
    });

    });

      $('.table').on("click","#catadd",function(e) {
      e.preventDefault();
     
      $("#retorno").load("add_categoria.php")

    });
    </script>
