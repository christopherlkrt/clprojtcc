<?php

class Receita_ingrediente{
	private $idingrediente;
	private $idreceita;
	private $quantia;

public function setIngrediente($idingrediente)
	{
		$this->idingrediente=$idingrediente;
	}

public function getIngrediente()
	{
		return $this->idingrediente;
	}

public function setReceita($idreceita)
	{
		$this->idReceita=$idreceita;
	}

public function getReceita()
	{
		return $this->idreceita;
	}

public function setQuantia($quantia)
	{
		$this->quantia=$quantia;
	}

public function getQuantia()
	{
		return $this->quantia;
	}

}

?>