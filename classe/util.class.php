<?php

class util
{
	private $_inutil;	/* Initiale */
	private $_mputil;	/* Mot de passe */
	private $_noutil;	/* Nom */
	private $_prutil;	/* Prénom */
	
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

public function inutil(){return $this->_inutil;}
public function mputil(){return $this->_mputil;}
public function noutil(){return $this->_noutil;}
public function prutil(){return $this->_prutil;}


public function setinutil($uninutil){$this->_inutil = $uninutil;}
public function setmputil($unmputil){$this->_mputil = $unmputil;}
public function setnoutil($unnoutil){$this->_noutil = $unnoutil;}
public function setprutil($unprutil){$this->_prutil = $unprutil;}


}
?>