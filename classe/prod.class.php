<?php

class prod
{
	private $_reprod;	/* Référence */
	private $_deprod;	/* Désignation */
	private $_adresa;	/* Adresse 1 */
	private $_adresb;	/* Adresse 2 */
	private $_codpos;	/* Code postale */
	private $_villep;	/* Ville */
	private $_typrop;   /* Type de propriété */
	private $_admail;   /* mail */
	private $_adrweb;   /* web */

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

public function Reprod(){return $this->_reprod;}
public function Deprod(){return $this->_deprod;}
public function Adresa(){return $this->_adresa;}
public function Adresb(){return $this->_adresb;}
public function Codpos(){return $this->_codpos;}
public function Villep(){return $this->_villep;}
public function Typrop(){return $this->_typrop;}
public function Admail(){return $this->_admail;}
public function Adrweb(){return $this->_adrweb;}

public function setReprod($unReprod){$this->_reprod = $unReprod;}
public function setDeprod($unDeprod){$this->_deprod = $unDeprod;}
public function setAdresa($unAdresa){$this->_adresa = $unAdresa;}
public function setAdresb($unAdresb){$this->_adresb = $unAdresb;}
public function setCodpos($unCodpos){$this->_codpos = $unCodpos;}
public function setVillep($unVillep){$this->_villep = $unVillep;}
public function setTyprop($unTyprop){$this->_typrop = $unTyprop;}
public function setAdmail($unAdmail){$this->_admail = $unAdmail;}
public function setAdrweb($unAdrweb){$this->_adrweb = $unAdrweb;}

public function Detyprop($db)
{
	IF ($this->_typrop <> "")
	{
		$tbsd_dao = new tbsd_dao($db);
		$untbsd   = $tbsd_dao->get("typrop",$this->_typrop);
		return $untbsd->Detbsd();
	}
	else
	{
		return "";
	}
}

}
?>