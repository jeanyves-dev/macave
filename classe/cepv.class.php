<?php

class cepv
{
	private $_revins;	/* vins */
	private $_recepa;	/* cépage */
	private $_qtcepv;	/* Quantité en % */
	
	
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

public function Revins(){return $this->_revins;}
public function Recepa(){return $this->_recepa;}
public function Qtcepv(){return $this->_qtcepv;}

public function setRevins($unRevins){$this->_revins = $unRevins;}
public function setRecepa($unRecepa){$this->_recepa = $unRecepa;}
public function setQtcepv($unQtcepv){$this->_qtcepv = $unQtcepv;}

public function Decepa($db)
{
	$cepa_dao = new cepa_dao($db);
	$uncepa   = $cepa_dao->get($this->_recepa);
	return $uncepa->Decepa();
}

}
?>