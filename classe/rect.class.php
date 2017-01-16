<?php

class rect
{
	private $_rerect;	/* Référence */
	private $_derect;	/* Désignation */
	
	
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

public function Rerect(){return $this->_rerect;}
public function Derect(){return $this->_derect;}

public function setRerect($unRerect){$this->_rerect = $unRerect;}
public function setDerect($unDerect){$this->_derect = $unDerect;}

}
?>