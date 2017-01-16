<?php

class gaba
{
	private $_regaba;	/* Référence */
	private $_degaba;	/* Désignation */
	private $_conten;	/* Contenance */
	
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

public function Regaba(){return $this->_regaba;}
public function Degaba(){return $this->_degaba;}
public function Conten(){return $this->_conten;}

public function setRegaba($unRegaba){$this->_regaba = $unRegaba;}
public function setDegaba($unDegaba){$this->_degaba = $unDegaba;}
public function setConten($unConten){$this->_conten = $unConten;}

}
?>