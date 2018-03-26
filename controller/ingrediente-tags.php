<?php
include "../model/ingrediente.class.php";
include "../model/ingredienteOP.class.php";

$ing = new  IngredienteOP();
echo json_encode($ing->listAll());

?>