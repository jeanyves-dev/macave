<?php

class cepa
{
	private $_recepa;	/* Référence */
	private $_decepa;	/* Désignation */
	
	
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

public function Recepa(){return $this->_recepa;}
public function Decepa(){return $this->_decepa;}

public function setRecepa($unRecepa){$this->_recepa = $unRecepa;}
public function setDecepa($unDecepa){$this->_decepa = $unDecepa;}

}
?>