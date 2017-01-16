<?php

class menu
{
	private $_remenu;	/* Référence */
	private $_demenu;	/* Désignation */
	
	
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

public function Remenu(){return $this->_remenu;}
public function Demenu(){return $this->_demenu;}

public function setRemenu($unRemenu){$this->_remenu = $unRemenu;}
public function setDemenu($unDemenu){$this->_demenu = $unDemenu;}

}
?>