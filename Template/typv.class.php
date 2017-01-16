<?php

class typv
{
	private $_retypv;	/* Référence */
	private $_detypv;	/* Désignation */
	
	
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

public function Retypv(){return $this->_retypv;}
public function Detypv(){return $this->_detypv;}

public function setRetypv($unRetypv){$this->_retypv = $unRetypv;}
public function setDetypv($unDetypv){$this->_detypv = $unDetypv;}

}
?>