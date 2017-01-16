<?php

class mens
{
	private $_remens;	/* Référence */
	private $_demens;	/* Désignation */
	private $_remenu;	/* Ref région */
	private $_limenu;	/* Lien */
	private $_norang;	/* Lien */

	
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

public function Remens(){return $this->_remens;}
public function Demens(){return $this->_demens;}
public function Remenu(){return $this->_remenu;}
public function Limenu(){return $this->_limenu;}
public function Norang(){return $this->_norang;}


public function setRemens($unRemens){$this->_remens = $unRemens;}
public function setDemens($unDemens){$this->_demens = $unDemens;}
public function setRemenu($unRemenu){$this->_remenu = $unRemenu;}
public function setLimenu($unLimenu){$this->_limenu = $unLimenu;}
public function setNorang($unNorang){$this->_norang = $unNorang;}


public function Demenu($db)
{
	$menu_dao = new menu_dao($db);
	$unmenu   = $menu_dao->get($this->_remenu);
	return $unmenu->Demenu();
}

}
?>