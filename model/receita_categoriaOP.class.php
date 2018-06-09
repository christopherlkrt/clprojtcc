<?php
include_once 'bd.class.php';
class ReceitaCatOP extends BD{
  public function __construct() {
    try {
      parent::__construct();


    } catch (PDOException  $e) {
      print $e->getMessage();
    }
  }

  public function inserirReceitaCat(ReceitaCat $receita_categoria) {
    	//print_r($categoria);
    try {
      $stmt = $this->pdo->prepare(
        'INSERT INTO receita_categoria (idreceita, idcategoria) VALUES (?,?)');

      $stmt->bindValue(1, $receita_categoria->getReceita());
      $stmt->bindValue(2, $receita_categoria->getCategoria());

      if ($stmt->execute())
      { 	
        $resultado=1;
        return $resultado;

     }
     else
     {
       return false;
     }

   } catch (PDOException  $e) {
    print $e->getMessage(); }

  }



  public function updateadm(Usuario $usuario){
   try{
    $stmt=$this->pdo->prepare('UPDATE usuarios set nomeusuario = ? , senha= ? , email = ? , isAdmin = ? 
      WHERE idusuario= ? ');
    $stmt->bindValue(1, $usuario->getNome());
    $stmt->bindValue(2, $usuario->getSenha());
    $stmt->bindValue(3, $usuario->getEmail());
    $stmt->bindValue(4, $usuario->getAdmin());
    $stmt->bindValue(5, $usuario->getId());
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

public function getReceitaCat($id) {
  try {
    $stmt = $this->pdo->query(
      "SELECT categorias.id, categorias.nome FROM categorias, receita_categoria where categorias.id=receita_categoria.idcategoria and receita_categoria.idreceita=$id" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function getAllReceitaCat($id) {
  try {
    $stmt = $this->pdo->query(
      "SELECT receitas.idreceita, receitas.nomereceita, receitas.imgreceita, categorias.nome FROM receitas, categorias, receita_categoria where categorias.id=receita_categoria.idcategoria and receita_categoria.idreceita=receitas.idreceita and receita_categoria.idcategoria=$id" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}



public function deletar($idusuario){
  try{
    $stmt=$this->pdo->prepare('
      DELETE FROM usuarios WHERE idusuario= ?');
    $stmt->bindValue(1, $idusuario);
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

