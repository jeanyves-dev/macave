<?php

class appr
{
	private $_reappr;	/* Référence */
	private $_deappr;	/* Désignation */
	
	
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

public function Reappr(){return $this->_reappr;}
public function Deappr(){return $this->_deappr;}

public function setReappr($unReappr){$this->_reappr = $unReappr;}
public function setDeappr($unDeappr){$this->_deappr = $unDeappr;}

}
?>