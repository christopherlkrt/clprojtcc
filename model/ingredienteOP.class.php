<?php
include_once 'bd.class.php';
class IngredienteOP extends BD{
  public function __construct() {
    try {
      parent::__construct();


    } catch (PDOException  $e) {
      print $e->getMessage();
    }
  }


// public function autoIngredientes() {
//   try {
//     $stmt = $this->pdo->query(
//       "SELECT * FROM ingredientes WHERE nomeingrediente LIKE '$search' ORDER BY nomeingrediente ASC" );
//     $resultado=$stmt->fetchAll();
//     return $resultado;
//   }
//   catch (PDOException  $e) {
//     print $e->getMessage();
//   }
// }


public function buscaIngredientes($ing) {
  try {
    $stmt = $this->pdo->query(
      "SELECT nomeingrediente FROM ingredientes WHERE nomeingrediente LIKE '%$ing%' ORDER BY nomeingrediente ASC" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}


}


?>

