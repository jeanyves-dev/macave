<?php

class coul
{
	private $_recoul;
	private $_decoul;
	private $_cocoul;

public function __construct(array $donnees)
{
	$this->hydrate($donnees);
}

public function hydrate(array $donnees)
{
	foreach ($donnees as $key => $value)
	{
		$method = "set".ucfirst($key);
		if (method_exists($this, $method))
		{
			$this->$method($value);
		}
	}
}
public function recoul(){return $this->_recoul;}
public function decoul(){return $this->_decoul;}
public function cocoul(){return $this->_cocoul;}

public function setrecoul($unrecoul){$this->_recoul = $unrecoul;}
public function setdecoul($undecoul){$this->_decoul = $undecoul;}
public function setcocoul($uncocoul){$this->_cocoul = $uncocoul;}


}

?>