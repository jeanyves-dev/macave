<?php

class rang
{
	private $_rerang;	/* Référence */
	private $_recasi;	/* Casier */
	private $_rebout;   /* Bouteille */
	private $_poslig;   /* Position ligne */
	private $_poscol;   /* Position colonne */
	
	
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

public function Rerang(){return $this->_rerang;}
public function Recasi(){return $this->_recasi;}
public function Rebout(){return $this->_rebout;}
public function Poslig(){return $this->_poslig;}
public function Poscol(){return $this->_poscol;}

public function setRerang($unRerang){$this->_rerang = $unRerang;}
public function setRecasi($unRecasi){$this->_recasi = $unRecasi;}
public function setRebout($unRebout){$this->_rebout = $unRebout;}
public function setPoslig($unPoslig){$this->_poslig = $unPoslig;}
public function setPoscol($unPoscol){$this->_poscol = $unPoscol;}

public function Decasi($db)
{
	$casi_dao = new casi_dao($db);
	$uncasi   = $casi_dao->get($this->_recasi);
	return $uncasi->Decasi();
}

public function Decolo($db)
{
	$casi_dao = new casi_dao($db);
	$colo_dao = new colo_dao($db);
	
	$uncasi   = $casi_dao->get($this->_recasi);
	$uncolo   = $colo_dao->get($uncasi->Recolo());
	
	return $uncolo->Decolo();
}

public function Deempl($db)
{
	$casi_dao = new casi_dao($db);
	$colo_dao = new colo_dao($db);
	$empl_dao = new empl_dao($db);
	
	$uncasi   = $casi_dao->get($this->_recasi);
	$uncolo   = $colo_dao->get($uncasi->Recolo());
	$unempl   = $empl_dao->get($uncolo->Reempl());
	
	return $unempl->Deempl();
}

}
?>