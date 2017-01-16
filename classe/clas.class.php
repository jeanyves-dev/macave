<?php

class clas
{
	private $_reclas;	/* Référence */
	private $_declas;	/* Désignation */
	
	
public function __construct(array $donnees)
{
	$this->hydrate($donnees);
}

public function hydrate(array $donnees)
{
	foreach ($donnees as $key => $value)
	{
		$method = 'set'.ucfirst($key);
		if (method_exists($this, $method))
		{
			$this->$method($value);
		}
	}
}

public function Reclas(){return $this->_reclas;}
public function Declas(){return $this->_declas;}

public function setReclas($unReclas){$this->_reclas = $unReclas;}
public function setDeclas($unDeclas){$this->_declas = $unDeclas;}

}
?>