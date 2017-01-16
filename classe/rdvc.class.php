<?php

class rdvc
{
	private $_rerdvc;	/* Référence */
	private $_derdvc;	/* Désignation */
	
	
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

public function Rerdvc(){return $this->_rerdvc;}
public function Derdvc(){return $this->_derdvc;}

public function setRerdvc($unRerdvc){$this->_rerdvc = $unRerdvc;}
public function setDerdvc($unDerdvc){$this->_derdvc = $unDerdvc;}

}
?>