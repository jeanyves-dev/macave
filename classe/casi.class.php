<?php

class casi
{
	private $_recasi;	/* Référence */
	private $_decasi;	/* Désignation */
	private $_recolo;	/* Ref colo */
	private $_nbrlig;   /* Nombre de ligne */
	private $_nbrcol;	/* Nombre de colonne */
	
	
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

public function Recasi(){return $this->_recasi;}
public function Decasi(){return $this->_decasi;}
public function Recolo(){return $this->_recolo;}
public function Nbrlig(){return $this->_nbrlig;}
public function Nbrcol(){return $this->_nbrcol;}

public function setRecasi($unRecasi){$this->_recasi = $unRecasi;}
public function setDecasi($unDecasi){$this->_decasi = $unDecasi;}
public function setRecolo($unRecolo){$this->_recolo = $unRecolo;}
public function setNbrlig($unNbrlig){$this->_nbrlig = $unNbrlig;}
public function setNbrcol($unNbrcol){$this->_nbrcol = $unNbrcol;}

public function Decolo($db)
{
	$colo_dao = new colo_dao($db);
	$uncolo   = $colo_dao->get($this->_recolo);
	return $uncolo->Decolo();
}

public function Deempl($db)
{
	$colo_dao = new colo_dao($db);
	$empl_dao = new empl_dao($db);
	
	$uncolo   = $colo_dao->get($this->_recasi);
	$unempl   = $empl_dao->get($uncolo->Reempl());
	
	return $unempl->Deempl();
}

}
?>