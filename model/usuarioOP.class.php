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
        'INSERT INTO usuarios (nomeusuario, email, senha, img, isAdmin) VALUES (?,?,?,?,?)');

      $stmt->bindValue(1, $usuario->getNome());
      $stmt->bindValue(2, $usuario->getEmail());
      $stmt->bindValue(3, $usuario->getSenha());
      $stmt->bindValue(4, $usuario->getImg());
      $stmt->bindValue(5, $usuario->getAdmin());

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

  public function inserirNota(Nota_usuario $nota_usuario) {
    
  try {
    $stmt = $this->pdo->prepare(
      'REPLACE INTO nota_usuario (idusuario, idreceita, notausuario) VALUES (?,?,?)');

    $stmt->bindValue(1, $nota_usuario->getUsuario());
    $stmt->bindValue(2, $nota_usuario->getReceita());
    $stmt->bindValue(3, $nota_usuario->getNota());

    if ($stmt->execute())
    {   
      header("Refresh:0");

   }
   else
   {
     echo "Erro ao inserir";
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

  public function update(Usuario $usuario){
   try{
    if ($usuario->getImg()!=null) {
    $stmt=$this->pdo->prepare('UPDATE usuarios set nomeusuario = ? , senha= ? , email = ? , img = ? 
      WHERE idusuario= ? ');
    $stmt->bindValue(1, $usuario->getNome());
    $stmt->bindValue(2, $usuario->getSenha());
    $stmt->bindValue(3, $usuario->getEmail());
    $stmt->bindValue(4, $usuario->getImg());
    $stmt->bindValue(5, $usuario->getId());
    $_SESSION['imgusuario']=$usuario->getImg();
    }
    else
    {
    $stmt=$this->pdo->prepare('UPDATE usuarios set nomeusuario = ? , senha= ? , email = ? 
      WHERE idusuario= ? ');
    $stmt->bindValue(1, $usuario->getNome());
    $stmt->bindValue(2, $usuario->getSenha());
    $stmt->bindValue(3, $usuario->getEmail());
    $stmt->bindValue(4, $usuario->getId());
    }
    if ($stmt->execute())
    { 	
     header('Location: ../view/conta_dados.php');
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
      "SELECT * FROM usuarios" );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function getUsuarioDono($idusuario) {
  try {
    $stmt = $this->pdo->query(
      "SELECT * FROM usuarios where idusuario='$idusuario' " );
    $resultado=$stmt->fetchAll();
    return $resultado;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

public function getEdit($idusuario) {
  try {
    $resultado = $this->pdo->query(
      "SELECT * FROM usuarios where idusuario='$idusuario'" );
    $linha=$resultado->fetch();
    return $linha;
  }
  catch (PDOException  $e) {
    print $e->getMessage();
  }
}

function logar($email, $senha)
{ 
  $this->email = $email;
  $this->senha = $senha;
  $resultado = $this->pdo->query("SELECT idusuario, nomeusuario, img, isAdmin from usuarios where email= '$email' AND senha= '$senha'");
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

public function getNotaUsuario($idusuario, $idreceita) {
  try {
    $stmt = $this->pdo->query(
      "SELECT * FROM nota_usuario where idusuario= '$idusuario' and idreceita= '$idreceita'" );
    $resultado=$stmt->fetch();
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

