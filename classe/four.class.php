<?php

class four
{
	private $_refour;	/* Référence */
	private $_defour;	/* Nom */
	private $_adresa;	/* Adresse 1 */
	private $_adresb;	/* Adresse 2 */
	private $_codpos;	/* Code postale */
	private $_villef;	/* Ville */
	private $_numtel;   /* Téléphone */
	private $_numfax;	/* Fax */
	private $_admail;	/* Mail */
	private $_sitweb;	/* Site web */
	
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

public function Refour(){return $this->_refour;}
public function Defour(){return $this->_defour;}
public function Adresa(){return $this->_adresa;}
public function Adresb(){return $this->_adresb;}
public function Codpos(){return $this->_codpos;}
public function Villef(){return $this->_villef;}
public function Numtel(){return $this->_numtel;}
public function Numfax(){return $this->_numfax;}
public function Admail(){return $this->_admail;}
public function Sitweb(){return $this->_sitweb;}

public function setRefour($unRefour){$this->_refour = $unRefour;}
public function setDefour($unDefour){$this->_defour = $unDefour;}
public function setAdresa($unAdresa){$this->_adresa = $unAdresa;}
public function setAdresb($unAdresb){$this->_adresb = $unAdresb;}
public function setCodpos($unCodpos){$this->_codpos = $unCodpos;}
public function setVillef($unVillef){$this->_villef = $unVillef;}
public function setNumtel($unNumtel){$this->_numtel = $unNumtel;}
public function setNumfax($unNumfax){$this->_numfax = $unNumfax;}
public function setAdmail($unAdmail){$this->_admail = $unAdmail;}
public function setSitweb($unSitweb){$this->_sitweb = $unSitweb;}

}
?>