<?php

class ReceitaIng{
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
		$this->idreceita=$idreceita;
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

public function setMedida($medida)
	{
		$this->medida=$medida;
	}

public function getMedida()
	{
		return $this->medida;
	}

}

?>