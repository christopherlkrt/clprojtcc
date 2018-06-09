<?php
include_once 'bd.class.php';
class CategoriaOP extends BD{
  public function __construct() {
    try {
      parent::__construct();


    } catch (PDOException  $e) {
      print $e->getMessage();
    }
  }

public function inserir(Categoria $categoria) {
    try {
      $stmt = $this->pdo->prepare(
        'INSERT INTO categorias (nome) VALUES (?)');

      $stmt->bindValue(1, $categoria->getNome());

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


  public function update(Categoria $categoria){
   try{
    $stmt=$this->pdo->prepare('UPDATE categorias set nome= ?
      WHERE id= ? ');
    $stmt->bindValue(1, $categoria->getNome());
    $stmt->bindValue(2, $categoria->getId());
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

public function getAll() {
  try {
    $stmt = $this->pdo->query(
      "SELECT * FROM categorias" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function getEdit($id) {
  try {
    $resultado = $this->pdo->query(
      "SELECT * FROM categorias where id='$id'" );
    $linha=$resultado->fetch();
    return $linha;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}



public function deletar($id){
  try{
    $stmt=$this->pdo->prepare('
      DELETE FROM categorias WHERE id= ?');
    $stmt->bindValue(1, $id);
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

