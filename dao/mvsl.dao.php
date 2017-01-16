<?php
class mvsl_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(mvsl $mvsl)
{
	$req = 'INSERT INTO mvsl (remvso,rebout,nomvsl,qtmvsl,reappr) VALUES ';
	$req = $req. '('.$mvsl->remvso().',';
	$req = $req. $mvsl->rebout().',';
	$req = $req. '"'.$mvsl->nomvsl().'",';
	$req = $req. $mvsl->qtmvsl().',';
	$req = $req. $mvsl->reappr().')';
	
	echo $req;
	
	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($remvsl)
{
	$this->_db->exec('DELETE FROM mvsl WHERE remvsl = '.$remvsl);
}

public function get($remvsl)
{
	$remvsl = (int) $remvsl;
	$q = $this->_db->query('SELECT * FROM mvsl WHERE remvsl = '.$remvsl);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new mvsl($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM mvsl WHERE remvsl = (SELECT MAX(remvsl) FROM mvsl);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new mvsl($donnees);
}

public function getList()
{
	$mvsl_liste = array();
	$q = $this->_db->query('SELECT * FROM mvsl');
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$mvsl_liste[] = new mvsl($donnees);
	}
	return $mvsl_liste;
}

public function getListmvso($remvso)
{
	$mvsl_liste = array();
	$q = $this->_db->query('SELECT * FROM mvsl WHERE remvso = '.$remvso);
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$mvsl_liste[] = new mvsl($donnees);
	}
	return $mvsl_liste;
}

public function getListeBout($rebout)
{
	$mvsl_liste = array();

	$q = $this->_db->query('SELECT * FROM mvsl where rebout = '.$rebout);
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{$mvsl_liste[] = new mvsl($donnees);}
	return $mvsl_liste;
}

public function getNbrSortie($rebout)
{
	$res = 0;

	$q = $this->_db->query('SELECT SUM(qtmvsl) as NbrSor FROM mvsl WHERE rebout = '.$rebout);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{$res = $donnees['NbrSor'];}
		
	return $res;
}

public function getSortCoul($recoul)
{
	$req = 'SELECT SUM(qtmvsl) as StockCoul FROM mvsl,bout,vins WHERE mvsl.rebout = bout.rebout AND bout.revins = vins.revins AND vins.recoul = '.$recoul.';';
	$q = $this->_db->query($req);
	$res = 0;
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$res = $res + $donnees['StockCoul'];
	}
	return $res;
}

public function getSortTotal()
{
	$q = $this->_db->query('SELECT SUM(qtmvsl) as StockTot FROM mvsl;');
	$res = 0;
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$res = $res + $donnees['StockTot'];
	}
	return $res;
}

public function update(mvsl $mvsl)
{
	$req = 'UPDATE mvsl SET';
	$req = $req. ' remvso = '.$mvsl->remvso().',';
	$req = $req. ' rebout = '.$mvsl->rebout().',';
	$req = $req. ' nomvsl = "'.$mvsl->nomvsl().'",';
	$req = $req. ' qtmvsl = '.$mvsl->qtmvsl().',';
	$req = $req. ' reappr = '.$mvsl->reappr();
	$req = $req. ' WHERE remvsl = '.$mvsl->remvsl();
	
	$q = $this->_db->prepare($req);

	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>