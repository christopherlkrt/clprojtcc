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


public function listAll(){
  try {
    $stmt = $this->pdo->query(
      "SELECT idingrediente as id, nomeingrediente as name FROM ingredientes" );
    return $stmt->fetchAll();
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function buscaIngredientes($ing) {
  try {
    $stmt = $this->pdo->query(
      "SELECT idingrediente, nomeingrediente FROM ingredientes WHERE nomeingrediente LIKE '%$ing%' ORDER BY nomeingrediente ASC" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function getUsuarioIngredientes($idusuario) {
  try {
    $stmt = $this->pdo->query(
      "SELECT ingredientes.idingrediente, ingredientes.nomeingrediente FROM ingredientes, usuario_ing WHERE ingredientes.idingrediente = usuario_ing.idingrediente AND usuario_ing.idusuario = '$idusuario'
        AND usuario_ing.inclui = 'sim' ORDER BY ingredientes.nomeingrediente ASC" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function getUsuarioIngredientesFora($idusuario) {
  try {
    $stmt = $this->pdo->query(
      "SELECT ingredientes.idingrediente, ingredientes.nomeingrediente FROM ingredientes, usuario_ing WHERE ingredientes.idingrediente = usuario_ing.idingrediente AND usuario_ing.idusuario = '$idusuario'
        AND usuario_ing.inclui = 'nao' ORDER BY ingredientes.nomeingrediente ASC" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

//Usuario-ingrediente
public function incluiIngrediente(Usuario_ing $ingrediente) {
    try {
      $stmt = $this->pdo->prepare(
        'INSERT INTO usuario_ing (idingrediente, idusuario, inclui) VALUES (?,?,?)');

      $stmt->bindValue(1, $ingrediente->getIngrediente());
      $stmt->bindValue(2, $ingrediente->getUsuario());
      $stmt->bindValue(3, $ingrediente->getInclui());

      if ($stmt->execute())
      {   

          echo "feito";

      }
      else
      {
       echo "Erro ao inserir";
     }

   } catch (PDOException  $e) {
    print $e->getMessage(); }

  }

  public function deletaIngrediente($idingrediente){
  try{
    $stmt=$this->pdo->prepare('
      DELETE FROM usuario_ing WHERE idingrediente= ?');
    $stmt->bindValue(1, $idingrediente);
    if ($stmt->execute())
    {   
      echo "Registro exluido com sucesso";
    }
    else
    {
      echo "Erro ao deletar";
    }
  } catch (PDOException  $e) {
   print $e->getMessage(); }
 }


}


?>

