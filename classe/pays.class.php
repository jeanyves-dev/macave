<?php

class pays
{
	private $_repays;	/* Référence */
	private $_depays;	/* Désignation */
	
	
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

public function Repays(){return $this->_repays;}
public function Depays(){return $this->_depays;}

public function setRepays($unRepays){$this->_repays = $unRepays;}
public function setDepays($unDepays){$this->_depays = $unDepays;}

}
?>