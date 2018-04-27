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
  
    try {
      $stmt = $this->pdo->prepare(
        'INSERT INTO receitas (nomereceita, descricao, imgreceita, idusuario, statusreceita) VALUES (?,?,?,?,0)');

      $stmt->bindValue(1, $receita->getNome());
      $stmt->bindValue(2, $receita->getDescricao());
      $stmt->bindValue(3, $receita->getImg());
      $stmt->bindValue(4, $receita->getUsuario());

      if ($stmt->execute())
      { 	

          $idreceita=$this->pdo->lastInsertId();

          return $idreceita;

      }
      else
      {
       echo "Erro ao inserir";
     }

   } catch (PDOException  $e) {
    print $e->getMessage(); }

  }

    public function inserirAdm(Receita $receita) {
  
    try {
      $stmt = $this->pdo->prepare(
        'INSERT INTO receitas (nomereceita, descricao, imgreceita, idusuario, statusreceita) VALUES (?,?,?,?,1)');

      $stmt->bindValue(1, $receita->getNome());
      $stmt->bindValue(2, $receita->getDescricao());
      $stmt->bindValue(3, $receita->getImg());
      $stmt->bindValue(4, $receita->getUsuario());

      if ($stmt->execute())
      {   

          echo "Receita Inserida";

      }
      else
      {
       echo "Erro ao inserir";
     }

   } catch (PDOException  $e) {
    print $e->getMessage(); }

  }


  //receita_ing
    public function inserirReceitaIng(ReceitaIng $receita_ingrediente) {
      //print_r($categoria);
    try {
      $stmt = $this->pdo->prepare(
        'INSERT INTO receita_ingrediente (idingrediente, idreceita, quantia, medida) VALUES (?,?,?,?)');

      $stmt->bindValue(1, $receita_ingrediente->getIngrediente());
      $stmt->bindValue(2, $receita_ingrediente->getReceita());
      $stmt->bindValue(3, $receita_ingrediente->getQuantia());
      $stmt->bindValue(4, $receita_ingrediente->getMedida());
      
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

  public function getReceitaDono($idusuario) {
  try {
    $stmt = $this->pdo->query(
      "SELECT nomeusuario, img FROM usuarios where idusuario='$idusuario' " );
    $resultado=$stmt->fetch();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function getVisitadoFavoritas($idusuario) {
  try {
    $stmt = $this->pdo->query(
      "SELECT receitas.idreceita, receitas.nomereceita, receitas.imgreceita, nota_usuario.notausuario FROM receitas, nota_usuario where nota_usuario.idusuario='$idusuario' and receitas.idreceita=nota_usuario.idreceita " );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function getVisitadoEnviadas($idusuario) {
  try {
    $stmt = $this->pdo->query(
      "SELECT * FROM receitas where idusuario='$idusuario' and statusreceita=1" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

  public function getIdporNome($ing) {
  try {
   $stmt=$this->pdo->prepare("SELECT idingrediente FROM ingredientes where nomeingrediente='$ing'");

   if ($stmt->execute())
   {   
    $resultado=$stmt->fetch();
    return $resultado['idingrediente'];
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

public function getEdit($idreceita) {
  try {
    $resultado = $this->pdo->query(
      "SELECT * FROM receitas where idreceita='$idreceita'" );
    $linha=$resultado->fetch();
    return $linha;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}


  public function update(Receita $receita){
   try{
    $stmt=$this->pdo->prepare('UPDATE receitas set nomereceita = ? , descricao= ? , imgreceita= ? 
      WHERE idreceita= ? ');
    $stmt->bindValue(1, $receita->getNome());
    $stmt->bindValue(2, $receita->getDescricao());
    $stmt->bindValue(3, $receita->getImg());
    $stmt->bindValue(4, $receita->getId());
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


public function getAllmesmo() {
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

public function getAll() {
  try {
    $stmt = $this->pdo->query(
      "SELECT * FROM receitas where statusreceita!=0" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function getUsuarioReceitas($idusuario) {
  try {
    $stmt = $this->pdo->query(
      "SELECT receitas.idreceita, receitas.nomereceita, receitas.imgreceita FROM receitas, nota_usuario WHERE receitas.idreceita = nota_usuario.idreceita AND nota_usuario.idusuario = '$idusuario'
        ORDER BY nota_usuario.notausuario DESC");
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

public function getNotaReceita($idreceita) {
  try {
    $stmt = $this->pdo->query(
      "SELECT SUM(notausuario) / COUNT(idreceita) as media from nota_usuario where idreceita='$idreceita'" );
    $resultado=$stmt->fetch();
    return $resultado;
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

  public function aprovaReceita($idreceita){
   try{
    $stmt=$this->pdo->query("UPDATE receitas set statusreceita=1
      WHERE idreceita= '$idreceita' ");
    if ($stmt->execute())
    {   
     echo "Receita Aprovada";
   }
   else
   {
     echo "Erro ao alterar";
   }
 } catch (PDOException  $e) {
  print $e->getMessage(); }
}


public function deletar($idreceita){
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

