<?php

class ReceitaCat {
	private $idreceita;
	private $idcategoria;

public function setReceita($idreceita)
	{
		$this->idreceita=$idreceita;
	}

public function getReceita()
	{
		return $this->idreceita;
	}

public function setCategoria($idcategoria)
	{
		$this->idcategoria=$idcategoria;
	}

public function getCategoria()
	{
		return $this->idcategoria;
	}

}


?>