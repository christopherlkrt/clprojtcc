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

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Imagem</th>
                  <th>Nome</th>
                  <th>Usuário</th>
                  <th>Status</th>
                  <th>Operações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                for ($i=0; $i < $linhas ; $i++) { 
                ?>
                <tr>
                  <td><?=$objreceitas[$i]['idreceita']?></td>
                  <td><a href="receita.php?idreceita=<?=$objreceitas[$i]['idreceita']?>"><img src="../imgs/receitas/<?=$objreceitas[$i]['imgreceita']?>" class="img-responsive img-rounded miniatura-img" alt="Imagem da Receita"></a></td>
                  <td><a class="no-style" href="receita.php?idreceita=<?=$objreceitas[$i]['idreceita']?>"><?=$objreceitas[$i]['nomereceita']?></a></td>
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
                  <td id="<?=$objreceitas[$i]['nomereceita']?>" name="<?=$objreceitas[$i]['idreceita']?>"><button class="btn btn-default" id="aprovar"><i class="icon-ok"></i>Aprovar</button><button class="btn btn-default" id="editarrec"><i class="icon-pencil"></i>Editar</button><button class="btn btn-default" id="deletarrec"><i class="icon-cancel"></i>Deletar</button></td>
                </tr>
                 <?php
                }
                ?>
                </tbody>
                <tfoot>
                <td><button class="btn btn-default" id="addreceita"><i class="icon-plus"></i>Adicionar</button></td>
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
      });
          });


          $('.table').on("click","#aprovar",function(e) {
        e.preventDefault();  
        
        var aprovar = $(this).parent('td').attr('name');
   
        $.post("../controller/receita.php",
      {
          aprovar: aprovar
      }).done(function() {

      $("#retorno").load("adminreceita.php")
      });
      

      });

         $('.table').on("click","#deletarrec",function(e) {
        e.preventDefault();
        
        var confirma=confirm('Tem certeza que deseja excluir a receita '+$(this).parent('td').attr('id')+'?');
        if (confirma==true) {
         
        
        var deletar = $(this).parent('td').attr('name');
   
        $.post("../controller/receita.php",
      {
          deletar: deletar
      }).done(function() {

      $("#retorno").load("adminreceita.php")
      });
      }

      });

      $('.table').on("click","#editarrec",function(e) {
      e.preventDefault();
     
      var editar = $(this).parent('td').attr('name');
      $.post("edita_receita.php",
    {
        editar: editar

    }).done(function(data) {

    $("#retorno").html(data)
    });

    });

      $('.table').on("click","#addreceita",function(e) {
      e.preventDefault();
     
      $("#retorno").load("add_receita.php")

    });
    </script>