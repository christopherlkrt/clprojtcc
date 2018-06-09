<?php
if (isset($_POST['geraReceitas'])) {
	include "../model/ingredienteOP.class.php";
	include "../model/receitaOP.class.php";
	session_start();
	$idusuario=$_SESSION['idusuario'];

	$ingredienteOP = new IngredienteOP();
	$itens = $ingredienteOP->getIngredientesIn($idusuario);
	$itens1 = $ingredienteOP->getIngredientesOut($idusuario);


	if($itens!=null and $itens1!=null){
		$i=0;
		foreach ($itens as $key => $value) {
			$itensSplit[$i]=$itens[$key];
			$i++;	
		}
		foreach ($itensSplit as $key => $value) {
			$itensIn[]=$itensSplit[$key]['idingrediente'];
		}
		$itensInMDS=implode(', ', $itensIn);

		$i=0;
		foreach ($itens1 as $key => $value) {
			$itensSplit1[$i]=$itens1[$key];
			$i++;	
		}
		foreach ($itensSplit1 as $key => $value) {
			$itensOut[]=$itensSplit1[$key]['idingrediente'];
		}
		$itensOutMDS=implode(', ', $itensOut);
		$receitaop = new ReceitaOP();
		$obj = $receitaop->customReceitas($itensInMDS, $itensOutMDS);

	}else if ($itens!=null and $itens1==null) {
		
		$i=0;
		foreach ($itens as $key => $value) {
			$itensSplit[$i]=$itens[$key];
			$i++;	
		}
		foreach ($itensSplit as $key => $value) {
			$itensIn[]=$itensSplit[$key]['idingrediente'];
		}
		$itensInMDS=implode(', ', $itensIn);
		$receitaop = new ReceitaOP();
		$obj = $receitaop->buscaIngs($itensInMDS);

	}else if ($itens==null and $itens1!=null){

		$i=0;
		foreach ($itens1 as $key => $value) {
			$itensSplit1[$i]=$itens1[$key];
			$i++;	
		}
		foreach ($itensSplit1 as $key => $value) {
			$itensOut[]=$itensSplit1[$key]['idingrediente'];
		}
		$itensOutMDS=implode(', ', $itensOut);
		$receitaop = new ReceitaOP();
		$obj = $receitaop->buscaIngsOut($itensOutMDS);

	}
}

$linhas=sizeof($obj);


?>

<html>
<head>
</head>
<body>

	<!-- conteudo-receitas-->
	<h3>Receitas para seus ingredientes</h3>

	<?php
	for($i=0;$i<$linhas;$i++)
		{ $nota_receita=$receitaop-> getNotaReceita($obj[$i]['idreceita']);
	?>
	<div class="col-sm-3 margin-t5">
		<a href="receita.php?idreceita=<?=$obj[$i]['idreceita']?>">
			<figure>
				<img src="../imgs/receitas/<?=$obj[$i]['imgreceita']?>" class="img-responsive" alt="<?=$obj[$i]['nomereceita']?>">
			</figure>
			<h3 class="thumbnail-title"><?=$obj[$i]['nomereceita']?></h3>
		</a>
		<div class="meio">
			<?php
			$l = $nota_receita['media'];

    /*                      for($j = 0;  $j<$l; $j++)
                            echo "<i class ='icon-star star-paprica'></i> ";

                          if($receitas_visitado[$i]['notausuario'] - $l != 0) {
                            $j++;
                             echo "<i class ='icon-star-half-alt star-paprica'></i>";
                           }
                          while($j <5) {
                            $j++;
                            echo "<i class ='icon-star-empty star-paprica'></i>";
                          }
    */
                          for($j = 0;  $j<5; $j++) {
                          	if($l - $j >= 1)
                          		echo "<i class ='icon-star star-paprica star-maior'></i> ";
                          	else if ($l - $j >0)
                          		echo "<i class ='icon-star-half-alt star-paprica star-maior'></i>";
                          	else
                          		echo "<i class ='icon-star-empty star-paprica star-maior'></i>";
                          }

                          ?>
                      </div>
                  </div>


                  <?php 
              }
              ?>

          </body>
          </html>