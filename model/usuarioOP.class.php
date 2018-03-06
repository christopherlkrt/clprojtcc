<?php
include_once 'bd.class.php';
class UsuarioOP extends BD{
  public function __construct() {
    try {
      parent::__construct();


    } catch (PDOException  $e) {
      print $e->getMessage();
    }
  }

  public function inserir(Usuario $usuario) {
    	//print_r($categoria);
    try {
      $stmt = $this->pdo->prepare(
        'INSERT INTO usuarios (nomeusuario, email, senha) VALUES (?,?,?)');

      $stmt->bindValue(1, $usuario->getNome());
      $stmt->bindValue(2, $usuario->getEmail());
      $stmt->bindValue(3, $usuario->getSenha());

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
  public function updado(Categoria $categoria){
   try{
    $stmt=$this->pdo->prepare('UPDATE usuarios set nomeusuario = ? , senha= ? , email = ? 
      WHERE id_user= ? ');
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
    $resultado = $this->pdo->query(
      "SELECT * FROM usuarios" );
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}
function logar($email, $senha)
{ 
  $this->email = $email;
  $this->senha = $senha;
  $resultado = $this->pdo->query("SELECT idusuario, nomeusuario from usuarios where email= '$email' AND senha= '$senha'");
  $obj=$resultado->fetch(PDO::FETCH_OBJ);
  $linha= $resultado->rowCount();
  if($linha == 1)
  {
   
    return $obj;
  }
  else
  {
   return false;
 }
}
public function delete($id_user){
  try{
    $stmt=$this->pdo->prepare('
      DELETE FROM usuarios WHERE id_user= ?');
    $stmt->bindValue(1, $id_user);
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
