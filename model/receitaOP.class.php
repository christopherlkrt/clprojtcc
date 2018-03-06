<?php
include_once 'bd.class.php';
class ReceitaOP extends BD{
  public function __construct() {
    try {
      parent::__construct();


    } catch (PDOException  $e) {
      print $e->getMessage();
    }
  }

  public function inserir(Receita $receita) {
    	//print_r($categoria);
    try {
      $stmt = $this->pdo->prepare(
        'INSERT INTO receitas (nomereceita, descricao, imgreceita, idusuario) VALUES (?,?,?,?)');

      $stmt->bindValue(1, $receita->getNome());
      $stmt->bindValue(2, $receita->getDescricao());
      $stmt->bindValue(3, $receita->getImg());
      $stmt->bindValue(4, $receita->getUsuario());

      if ($stmt->execute())
      { 	
        header("location: ../view/home.php");

      }
      else
      {
       echo "Erro ao inserir";
     }

   } catch (PDOException  $e) {
    print $e->getMessage(); }

  }
  public function updado(Receita $receita){
   try{
    $stmt=$this->pdo->prepare('UPDATE receitas set nomereceita = ? , descricao= ? 
      WHERE idreceita= ? ');
    $stmt->bindValue(1, $categoria->getNome());
    $stmt->bindValue(2, $categoria->getEmail());
    $stmt->bindValue(3, $categoria->getSenha());
    $stmt->bindValue(4, $categoria->getUid());
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
      "SELECT * FROM receitas" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function getReceita($id) {
  try {
   $stmt=$this->pdo->prepare('SELECT * FROM receitas 
    WHERE idreceita= ?');
   $stmt->bindValue(1, $id);

   if ($stmt->execute())
   {   
    $resultado=$stmt->fetch();
    return $resultado;
  }
  else
  {
   echo "Erro ao alterar";
 }

}

catch (PDOException  $e) {
  print $e->getMessage();
}
}


public function getIngrediente($id) {
  try {
   $stmt=$this->pdo->prepare('SELECT * FROM ingredientes join receita_ingrediente using (idingrediente) 
    WHERE idreceita= ?');
   $stmt->bindValue(1, $id);

   if ($stmt->execute())
   {   
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  else
  {
   echo "Erro ao alterar";
 }

}
catch (PDOException  $e) {
  print $e->getMessage();
}
}



public function getAllingredientes() {
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





public function delete($id_user){
  try{
    $stmt=$this->pdo->prepare('
      DELETE FROM receitas WHERE idreceita= ?');
    $stmt->bindValue(1, $idreceita);
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
