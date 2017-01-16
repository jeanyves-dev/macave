<?php

class colo
{
	private $_recolo;	/* Référence */
	private $_decolo;	/* Désignation */
	private $_reempl;	/* Ref empl */
	
	
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

public function Recolo(){return $this->_recolo;}
public function Decolo(){return $this->_decolo;}
public function Reempl(){return $this->_reempl;}

public function setRecolo($unRecolo){$this->_recolo = $unRecolo;}
public function setDecolo($unDecolo){$this->_decolo = $unDecolo;}
public function setReempl($unReempl){$this->_reempl = $unReempl;}

public function Deempl($db)
{
	$empl_dao = new empl_dao($db);
	$unempl   = $empl_dao->get($this->_reempl);
	return $unempl->Deempl();
}

}
?>