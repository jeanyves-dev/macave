<?php

class regi
{
	private $_reregi;	/* Référence */
	private $_deregi;	/* Désignation */
	private $_repays;	/* Ref pays */
	
	
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

public function Reregi(){return $this->_reregi;}
public function Deregi(){return $this->_deregi;}
public function Repays(){return $this->_repays;}

public function setReregi($unReregi){$this->_reregi = $unReregi;}
public function setDeregi($unDeregi){$this->_deregi = $unDeregi;}
public function setRepays($unRepays){$this->_repays = $unRepays;}

public function Depays($db)
{
	$pays_dao = new pays_dao($db);
	$unpays   = $pays_dao->get($this->_repays);
	return $unpays->Depays();
}

}
?>