<?php

class vins
{
	private $_revins;	/* Référence */
	private $_devins;	/* Désignation */
	private $_repays;	/* Ref pays */
	private $_reregi;	/* Ref Région */
	private $_reappe;	/* Ref Appellation */
	private $_reprod;	/* Ref Producteur */
	private $_recoul;	/* Ref Couleur */
	private $_favori;	/* Favoris */
	private $_retypv;	/* Ref type vin */
	private $_reclas;	/* Ref classement */
	private $_cuvins;   /* Cuvée */
	private $_devinb;   /* Libellé 2 */
	private $_imvins;	/* Image */
	
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

public function Revins(){return $this->_revins;}
public function Devins(){return $this->_devins;}
public function Repays(){return $this->_repays;}
public function Reregi(){return $this->_reregi;}
public function Reappe(){return $this->_reappe;}
public function Reprod(){return $this->_reprod;}
public function Recoul(){return $this->_recoul;}
public function Favori(){return $this->_favori;}
public function Retypv(){return $this->_retypv;}
public function Reclas(){return $this->_reclas;}
public function Cuvins(){return $this->_cuvins;}
public function Devinb(){return $this->_devinb;}
public function Imvins(){return $this->_imvins;}

public function setRevins($unRevins){$this->_revins = $unRevins;}
public function setDevins($unDevins){$this->_devins = $unDevins;}
public function setRepays($unRepays){$this->_repays = $unRepays;}
public function setReregi($unReregi){$this->_reregi = $unReregi;}
public function setReappe($unReappe){$this->_reappe = $unReappe;}
public function setReprod($unReprod){$this->_reprod = $unReprod;}
public function setRecoul($unRecoul){$this->_recoul = $unRecoul;}
public function setFavori($unFavori){$this->_favori = $unFavori;}
public function setRetypv($unRetypv){$this->_retypv = $unRetypv;}
public function setReclas($unReclas){$this->_reclas = $unReclas;}
public function setCuvins($unCuvins){$this->_cuvins = $unCuvins;}
public function setDevinb($unDevinb){$this->_devinb = $unDevinb;}
public function setImvins($unImvins){$this->_imvins = $unImvins;}

public function Depays($db)
{
	$pays_dao = new pays_dao($db);
	$unpays   = $pays_dao->get($this->_repays);
	return $unpays->Depays();
}

public function Deregi($db)
{
	$regi_dao = new regi_dao($db);
	$unregi   = $regi_dao->get($this->_reregi);
	return $unregi->Deregi();
}

public function Deappe($db)
{
	$appe_dao = new appe_dao($db);
	$unappe   = $appe_dao->get($this->_reappe);
	return $unappe->Deappe();
}

public function Deprod($db)
{
	$prod_dao = new prod_dao($db);
	$unprod   = $prod_dao->get($this->_reprod);
	return $unprod->Deprod();
}

public function Decoul($db)
{
	$coul_dao = new coul_dao($db);
	$uncoul   = $coul_dao->get($this->_recoul);
	return $uncoul->Decoul();
}

public function Cocoul($db)
{
	$coul_dao = new coul_dao($db);
	$uncoul   = $coul_dao->get($this->_recoul);
	return $uncoul->Cocoul();
}

public function Detypv($db)
{
	$typv_dao = new typv_dao($db);
	$untypv   = $typv_dao->get($this->_retypv);
	return $untypv->Detypv();
}

public function Declas($db)
{
	$clas_dao = new clas_dao($db);
	$unclas   = $clas_dao->get($this->_reclas);
	return $unclas->Declas();
}

public function NbrBout($db)
{
	$res = 0;
	$bout_dao = new bout_dao($db);
	$mesbout  = $bout_dao->getListeVins($this->_revins);
	foreach ($mesbout as $unbout)
	{
		$res = $res + 1;
	}
	return $res;
}

public function QteStkTot($db)
{
	$res = 0;
	$bout_dao = new bout_dao($db);
	$mesbout  = $bout_dao->getListeVins($this->_revins);
	foreach ($mesbout as $unbout)
	{
		$res = $res + $unbout->QtStock($db);
	}
	return $res;
}

public function NbrEnt($db)
{
	$res = 0;
	$bout_dao = new bout_dao($db);
	$mesbout  = $bout_dao->getListeVins($this->_revins);
	foreach ($mesbout as $unbout)
	{
		$res = $res + $unbout->QtEntr($db);
	}
	return $res;
}

public function NbrSor($db)
{
	$res = 0;
	$bout_dao = new bout_dao($db);
	$mesbout  = $bout_dao->getListeVins($this->_revins);
	foreach ($mesbout as $unbout)
	{
		$res = $res + $unbout->QtSort($db);
	}
	return $res;
}

public function NbrRan($db)
{
	$res = 0;
	$bout_dao = new bout_dao($db);
	$mesbout  = $bout_dao->getListeVins($this->_revins);
	foreach ($mesbout as $unbout)
	{
		$res = $res + $unbout->QtRang($db);
	}
	return $res;
}

}
?>