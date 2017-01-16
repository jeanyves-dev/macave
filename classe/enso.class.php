<?php

class enso
{
	private $_reenso;	/* Référence */
	private $_rebout;	/* Ref bouteille */
	private $_daenso;	/* Date entrée sortie */
	private $_qtenso;	/* Quantité */
	private $_seenso;	/* Sens : entrée = 1, sortie = 2 */
	private $_refour;	/* Ref fournisseur */
	private $_reappr;	/* Ref appréciation */
	
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

public function Reenso(){return $this->_reenso;}
public function Rebout(){return $this->_rebout;}
public function Daenso(){return $this->_daenso;}
public function Qtenso(){return $this->_qtenso;}
public function Seenso(){return $this->_seenso;}
public function Refour(){return $this->_refour;}
public function Reappr(){return $this->_reappr;}

public function setReenso($unReenso){$this->_reenso = $unReenso;}
public function setRebout($unRebout){$this->_rebout = $unRebout;}
public function setDaenso($unDaenso){$this->_daenso = $unDaenso;}
public function setQtenso($unQtenso){$this->_qtenso = $unQtenso;}
public function setSeenso($unSeenso){$this->_seenso = $unSeenso;}
public function setRefour($unRefour){$this->_refour = $unRefour;}
public function setReappr($unReappr){$this->_reappr = $unReappr;}

public function Defour($db)
{
	$four_dao = new four_dao($db);
	$unfour   = $four_dao->get($this->_refour);;
	return $unfour->Defour();
}

public function Deappr($db)
{
	$appr_dao = new appr_dao($db);
	$unappr   = $appr_dao->get($this->_reappr);;
	return $unappr->Deappr();
}

public function Devins($db)
{
	$bout_dao = new bout_dao($db);
	$unbout   = $bout_dao->get($this->_rebout);;
	return $unbout->Devins($db);
}

}
?>