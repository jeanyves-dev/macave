<?php
class stat_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

/* Stat par pays */
public function getStat1($repays)
{
	$nbrtot = 0;
	$q = $this->_db->query('SELECT SUM(qtmvel) AS nbr FROM vins, bout, mvel WHERE vins.revins = bout.revins AND bout.rebout = mvel.rebout AND vins.repays = '.$repays);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	$nbrtot = $donnees["nbr"];
	
	$q = $this->_db->query('SELECT SUM(qtmvsl) AS nbr FROM vins, bout, mvsl WHERE vins.revins = bout.revins AND bout.rebout = mvsl.rebout AND vins.repays = '.$repays);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	$nbrtot = $nbrtot - $donnees["nbr"];
	
	return $nbrtot;
	
}

/* Stat par region */
public function getStat2($reregi)
{
	$nbrtot = 0;
	$q = $this->_db->query('SELECT SUM(qtmvel) AS nbr FROM vins, bout, mvel WHERE vins.revins = bout.revins AND bout.rebout = mvel.rebout AND vins.reregi = '.$reregi);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	$nbrtot = $donnees["nbr"];
	
	$q = $this->_db->query('SELECT SUM(qtmvsl) AS nbr FROM vins, bout, mvsl WHERE vins.revins = bout.revins AND bout.rebout = mvsl.rebout AND vins.reregi = '.$reregi);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	$nbrtot = $nbrtot - $donnees["nbr"];
	
	return $nbrtot;
	
}

/* Stat par appellation */
public function getStat3($reappe)
{
	$nbrtot = 0;
	$q = $this->_db->query('SELECT SUM(qtmvel) AS nbr FROM vins, bout, mvel WHERE vins.revins = bout.revins AND bout.rebout = mvel.rebout AND vins.reappe = '.$reappe);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	$nbrtot = $donnees["nbr"];
	
	$q = $this->_db->query('SELECT SUM(qtmvsl) AS nbr FROM vins, bout, mvsl WHERE vins.revins = bout.revins AND bout.rebout = mvsl.rebout AND vins.reappe = '.$reappe);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	$nbrtot = $nbrtot - $donnees["nbr"];
	
	return $nbrtot;
}

/* Stat par couleur */
public function getStat8($recoul)
{
	$nbrtot = 0;
	$q = $this->_db->query('SELECT SUM(qtmvel) AS nbr FROM vins, bout, mvel WHERE vins.revins = bout.revins AND bout.rebout = mvel.rebout AND vins.recoul = '.$recoul);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	$nbrtot = $donnees["nbr"];
	
	$q = $this->_db->query('SELECT SUM(qtmvsl) AS nbr FROM vins, bout, mvsl WHERE vins.revins = bout.revins AND bout.rebout = mvsl.rebout AND vins.recoul = '.$recoul);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	$nbrtot = $nbrtot - $donnees["nbr"];
	
	return $nbrtot;
}

/* Stat par type de vins */
public function getStat9($retypv)
{
	$nbrtot = 0;
	$q = $this->_db->query('SELECT SUM(qtmvel) AS nbr FROM vins, bout, mvel WHERE vins.revins = bout.revins AND bout.rebout = mvel.rebout AND vins.retypv = '.$retypv);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	$nbrtot = $donnees["nbr"];
	
	$q = $this->_db->query('SELECT SUM(qtmvsl) AS nbr FROM vins, bout, mvsl WHERE vins.revins = bout.revins AND bout.rebout = mvsl.rebout AND vins.retypv = '.$retypv);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	$nbrtot = $nbrtot - $donnees["nbr"];
	
	return $nbrtot;
}

/* Stat par classement */
public function getStat10($reclas)
{
	$nbrtot = 0;
	$q = $this->_db->query('SELECT SUM(qtmvel) AS nbr FROM vins, bout, mvel WHERE vins.revins = bout.revins AND bout.rebout = mvel.rebout AND vins.reclas = '.$reclas);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	$nbrtot = $donnees["nbr"];
	
	$q = $this->_db->query('SELECT SUM(qtmvsl) AS nbr FROM vins, bout, mvsl WHERE vins.revins = bout.revins AND bout.rebout = mvsl.rebout AND vins.reclas = '.$reclas);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	$nbrtot = $nbrtot - $donnees["nbr"];
	
	return $nbrtot;
}

/* Stat Entrée par année */
public function getStat4()
{
	$res = array();
	$nbrtot = 0;
	$q = $this->_db->query('SELECT SUM(qtmvel) AS nbr, YEAR(damven) as ann FROM mvel, mven WHERE mvel.remven = mven.remven GROUP BY YEAR(damven)');
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$res['ann'] = $donnees["ann"];
		$res['nbr'] = $donnees["nbr"];
	}

	return $res;
}

/* Stat par canal d'approvisionnement */
public function getStat11($canapp)
{
	$nbrtot = 0;
	$q = $this->_db->query('SELECT SUM(qtmvel) AS nbr FROM bout, mvel, mven WHERE bout.rebout = mvel.rebout AND mven.remven = mvel.remven AND mven.canapp = '.$canapp);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	$nbrtot = $donnees["nbr"];
	
	return $nbrtot;
}


public function get($rebout)
{
	$rebout = (int) $rebout;
	$q = $this->_db->query('SELECT * FROM bout WHERE rebout = '.$rebout);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new bout($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM bout WHERE rebout = (SELECT MAX(rebout) FROM bout);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new bout($donnees);
}

public function getLastRef()
{
	$q = $this->_db->query('SELECT rebout FROM bout WHERE rebout = (SELECT MAX(rebout) FROM bout);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return $donnees["rebout"];
}

public function getList()
{
	$bout_liste = array();

	$q = $this->_db->query('SELECT * FROM bout');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$bout_liste[] = new bout($donnees);
	}

	return $bout_liste;
}

public function getListeVins($revins)
{
	$bout_liste = array();

	$q = $this->_db->query('SELECT * FROM bout WHERE revins = '.$revins);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$bout_liste[] = new bout($donnees);
	}

	return $bout_liste;
}

public function getNbBoutVins($revins)
{
	$NbrBout = 0;

	$q = $this->_db->query('SELECT * FROM bout WHERE revins = '.$revins);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$NbrBout = $NbrBout + 1;
	}

	return $NbrBout;
}



public function getListeABoire($anaboi)
{
	$bout_liste = array();

	$q = $this->_db->query('SELECT * FROM bout WHERE anaboi = '.$anaboi);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$bout_liste[] = new bout($donnees);
	}

	return $bout_liste;
}

public function getListeDistAnaboi()
{
	$bout_liste = array();

	$q = $this->_db->query('SELECT DISTINCT anaboi FROM bout;');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$bout_liste[] = $donnees["anaboi"];
	}

	return $bout_liste;
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>