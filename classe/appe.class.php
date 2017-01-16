<?php

class appe
{
	private $_reappe;	/* Référence */
	private $_deappe;	/* Désignation */
	private $_reregi;	/* Ref région */
	
	
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

public function Reappe(){return $this->_reappe;}
public function Deappe(){return $this->_deappe;}
public function Reregi(){return $this->_reregi;}

public function setReappe($unReappe){$this->_reappe = $unReappe;}
public function setDeappe($unDeappe){$this->_deappe = $unDeappe;}
public function setReregi($unReregi){$this->_reregi = $unReregi;}

public function Deregi($db)
{
	$regi_dao = new regi_dao($db);
	$unregi   = $regi_dao->get($this->_reregi);
	return $unregi->Deregi();
}

}
?>