<?php

class bout
{
	private $_rebout;	/* Référence */
	private $_revins;	/* Ref vin */
	private $_regaba;	/* Ref Gabarit */
	private $_anmile;	/* Année milésime */
	private $_anapog;	/* Année apogé */
	private $_anaboi;	/* Année à boire */
	private $_bonote;	/* Note */
	
	private $_devins;	/* Vin */
	private $_degaba;	/* Gabarit */
	private $_degres;	/* Degrès alcool */

	
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

public function Rebout(){return $this->_rebout;}
public function Revins(){return $this->_revins;}
public function Regaba(){return $this->_regaba;}
public function Anmile(){return $this->_anmile;}
public function Anapog(){return $this->_anapog;}
public function Anaboi(){return $this->_anaboi;}
public function Bonote(){return $this->_bonote;}
public function Degres(){IF ($this->_degres == 0){return "";} else {return $this->_degres;}}

public function setRebout($unRebout){$this->_rebout = $unRebout;}
public function setRevins($unRevins){$this->_revins = $unRevins;}
public function setRegaba($unRegaba){$this->_regaba = $unRegaba;}
public function setAnmile($unAnmile){$this->_anmile = $unAnmile;}
public function setAnapog($unAnapog){$this->_anapog = $unAnapog;}
public function setAnaboi($unAnaboi){$this->_anaboi = $unAnaboi;}
public function setBonote($unBonote){$this->_bonote = $unBonote;}
public function setDegres($unDegres){$this->_degres = $unDegres;}

public function Devins($db)
{
	$vins_dao = new vins_dao($db);
	$unvins   = $vins_dao->get($this->_revins);
	return $unvins->Devins();
}

public function Decoul($db)
{
	$vins_dao = new vins_dao($db);
	$coul_dao = new coul_dao($db);
	$unvins   = $vins_dao->get($this->_revins);
	$uncoul   = $coul_dao->get($unvins->recoul());
	return $uncoul->Decoul();
}

public function Degaba($db)
{
	$gaba_dao = new gaba_dao($db);
	$ungaba   = $gaba_dao->get($this->_regaba);;
	return $ungaba->Degaba();
}

public function QtStock($db)
{
	$stock = 0;
	$mvel_dao = new mvel_dao($db);
	$mvsl_dao = new mvsl_dao($db);
	$mesmvel  = $mvel_dao->getListeBout($this->_rebout);
	$mesmvsl  = $mvsl_dao->getListeBout($this->_rebout);
	foreach ($mesmvel as $unmvel)
	{$stock = $stock + $unmvel->Qtmvel();}
	foreach ($mesmvsl as $unmvsl)
	{$stock = $stock - $unmvsl->Qtmvsl();}
	
	return $stock;
}

public function QtRang($db)
{
	$rang_dao = new rang_dao($db);
	return $rang_dao->getQtRangBout($this->_rebout);
}

public function QtEntr($db)
{
	$Entr = 0;
	$mvel_dao = new mvel_dao($db);
	$Entr = $Entr + $mvel_dao->getNbrEntree($this->_rebout);
	return $Entr;
}

public function QtSort($db)
{
	$Sort = 0;
	$mvsl_dao = new mvsl_dao($db);
	$Sort = $Sort + $mvsl_dao->getNbrSortie($this->_rebout);
	return $Sort;
}

public function TarAvg($db)
{
	$moyenne = 0;
	$somme   = 0;
	$idx     = 0;
	
	$tari_dao = new tari_dao($db);
	
	$mestari  = $tari_dao->getListBout($this->_rebout);
	foreach ($mestari as $untari)
	{
		$somme = $somme + $untari->Mtbout();
		$idx = $idx + 1;
	}
	
	IF ($idx > 0)
		{$moyenne = $somme / $idx;}
	
	$moyenne = round($moyenne, 2);
	
	return $moyenne;
}

}
?>