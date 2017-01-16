<?php

class plat
{
	private $_replat;	/* Référence */
	private $_deplat;	/* Désignation */
	
	
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

public function Replat(){return $this->_replat;}
public function Deplat(){return $this->_deplat;}

public function setReplat($unReplat){$this->_replat = $unReplat;}
public function setDeplat($unDeplat){$this->_deplat = $unDeplat;}

}
?>