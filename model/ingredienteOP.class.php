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

public function insereIngrediente($ingrediente) {
    try {
      $stmt = $this->pdo->prepare(
        'INSERT INTO ingredientes (nomeingrediente) VALUES (?)');

      $stmt->bindValue(1, $ingrediente->getNome());

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

public function getAll() {
  try {
    $stmt = $this->pdo->query(
      "SELECT * FROM ingredientes" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function getEdit($idingrediente) {
  try {
    $resultado = $this->pdo->query(
      "SELECT nomeingrediente FROM ingredientes where idingrediente='$idingrediente'" );
    $linha=$resultado->fetch();
    return $linha;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

 public function update(Ingrediente $ingrediente){
   try{
    $stmt=$this->pdo->prepare('UPDATE ingredientes set nomeingrediente = ? 
      WHERE idingrediente= ? ');
    $stmt->bindValue(1, $ingrediente->getNome());
    $stmt->bindValue(2, $ingrediente->getId());
    if ($stmt->execute())
    {   
     echo "Registro Alterado com sucesso";
   }
   else
   {
     echo "Erro ao alterar";
   }
 } catch (PDOException  $e) {
  print $e->getMessage(); }
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
        AND usuario_ing.inclui = 1 ORDER BY ingredientes.nomeingrediente ASC" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function getIngredientesIn($idusuario) {
  try {
    $stmt = $this->pdo->query(
      "SELECT ingredientes.idingrediente FROM ingredientes, usuario_ing WHERE ingredientes.idingrediente = usuario_ing.idingrediente AND usuario_ing.idusuario = '$idusuario'
        AND usuario_ing.inclui = 1" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function getIngredientesOut($idusuario) {
  try {
    $stmt = $this->pdo->query(
      "SELECT ingredientes.idingrediente FROM ingredientes, usuario_ing WHERE ingredientes.idingrediente = usuario_ing.idingrediente AND usuario_ing.idusuario = '$idusuario'
        AND usuario_ing.inclui = 0" );
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
        AND usuario_ing.inclui = 0 ORDER BY ingredientes.nomeingrediente ASC" );
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

  public function deletar($idingrediente){
  try{
    $stmt=$this->pdo->prepare('
      DELETE FROM ingredientes WHERE idingrediente= ?');
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

