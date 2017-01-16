<?php
class mvel_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(mvel $mvel)
{
	$req = 'INSERT INTO mvel (remven,rebout,nomvel,qtmvel) VALUES ';
	$req = $req. '('.$mvel->remven().',';
	$req = $req. $mvel->rebout().',';
	$req = $req. '"'.$mvel->nomvel().'",';
	$req = $req. $mvel->qtmvel().')';
	
	echo $req;
	
	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($remvel)
{
	$this->_db->exec('DELETE FROM mvel WHERE remvel = '.$remvel);
}

public function get($remvel)
{
	$remvel = (int) $remvel;
	$q = $this->_db->query('SELECT * FROM mvel WHERE remvel = '.$remvel);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new mvel($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM mvel WHERE remvel = (SELECT MAX(remvel) FROM mvel);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new mvel($donnees);
}

public function getList()
{
	$mvel_liste = array();
	$q = $this->_db->query('SELECT * FROM mvel');
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$mvel_liste[] = new mvel($donnees);
	}
	return $mvel_liste;
}

public function getListMven($remven)
{
	$mvel_liste = array();
	$q = $this->_db->query('SELECT * FROM mvel WHERE remven = '.$remven);
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$mvel_liste[] = new mvel($donnees);
	}
	return $mvel_liste;
}

public function getListeBout($rebout)
{
	$mvel_liste = array();

	$q = $this->_db->query('SELECT * FROM mvel where rebout = '.$rebout);
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{$mvel_liste[] = new mvel($donnees);}
	return $mvel_liste;
}

public function getNbrEntree($rebout)
{
	$res = 0;
	
	$q = $this->_db->query('SELECT SUM(qtmvel) as NbrEnt FROM mvel WHERE rebout = '.$rebout);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{$res = $donnees['NbrEnt'];}
		
	return $res;
}

public function getEntrCoul($recoul)
{
	$req = 'SELECT SUM(qtmvel) as StockCoul FROM mvel,bout,vins WHERE mvel.rebout = bout.rebout AND bout.revins = vins.revins AND vins.recoul = '.$recoul.';';
	$q = $this->_db->query($req);
	$res = 0;
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$res = $res + $donnees['StockCoul'];
	}
	return $res;
}

public function getEntrTotal()
{
	$q = $this->_db->query('SELECT SUM(qtmvel) as StockTot FROM mvel;');
	$res = 0;
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$res = $res + $donnees['StockTot'];
	}
	return $res;
}

public function update(mvel $mvel)
{
	$req = 'UPDATE mvel SET';
	$req = $req. ' remven = '.$mvel->remven().',';
	$req = $req. ' rebout = '.$mvel->rebout().',';
	$req = $req. ' nomvel = "'.$mvel->nomvel().'",';
	$req = $req. ' qtmvel = '.$mvel->qtmvel();
	$req = $req. ' WHERE remvel = '.$mvel->remvel();
	
	$q = $this->_db->prepare($req);

	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>