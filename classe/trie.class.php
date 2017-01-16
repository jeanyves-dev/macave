<?php

class trie
{
	private $_retabl;	/* Table */
	private $_champs;	/* Champs */
	private $_senstr;	/* Sens */
	
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

public function Retabl(){return $this->_retabl;}
public function Champs(){return $this->_champs;}
public function Senstr(){return $this->_senstr;}

public function setRetabl($unRetabl){$this->_retabl = $unRetabl;}
public function setChamps($unChamps){$this->_champs = $unChamps;}
public function setSenstr($unSenstr){$this->_senstr = $unSenstr;}

}
?>