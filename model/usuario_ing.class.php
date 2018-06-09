<?php
class Usuario_ing{
	private $idingrediente;
	private $idusuario;

public function setIngrediente($idingrediente)
	{
		$this->idingrediente=$idingrediente;
	}

public function getIngrediente()
	{
		return $this->idingrediente;
	}

public function setUsuario($idusuario)
	{
		$this->idusuario=$idusuario;
	}

public function getUsuario()
	{
		return $this->idusuario;
	}

public function setInclui($inclui)
	{
		$this->inclui=$inclui;
	}

public function getInclui()
	{
		return $this->inclui;
	}

}

?>