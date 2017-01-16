<?php

class empl
{
	private $_reempl;	/* Référence */
	private $_deempl;	/* Désignation */
	
	
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

public function Reempl(){return $this->_reempl;}
public function Deempl(){return $this->_deempl;}

public function setReempl($unReempl){$this->_reempl = $unReempl;}
public function setDeempl($unDeempl){$this->_deempl = $unDeempl;}

}
?>