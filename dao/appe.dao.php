<?php
class appe_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(appe $appe)
{
	$req = 'INSERT INTO appe (deappe,reregi) VALUES ';
	$req = $req. '("'.$appe->deappe().'",';
	$req = $req. $appe->reregi().')';
	
	echo $req;
	
	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($reappe)
{
	$this->_db->exec('DELETE FROM appe WHERE reappe = '.$reappe);
}

public function get($reappe)
{
	$reappe = (int) $reappe;
	$q = $this->_db->query('SELECT * FROM appe WHERE reappe = '.$reappe);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new appe($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM appe WHERE reappe = (SELECT MAX(reappe) FROM appe);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new appe($donnees);
}

public function getList()
{
	$appe_liste = array();
	$q = $this->_db->query('SELECT * FROM appe ORDER BY DEAPPE');
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$appe_liste[] = new appe($donnees);
	}
	return $appe_liste;
}

public function getListRegi($reregi)
{
	$appe_liste = array();
	$q = $this->_db->query('SELECT * FROM appe WHERE reregi = '.$reregi.' ORDER BY DEAPPE');
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$appe_liste[] = new appe($donnees);
	}
	return $appe_liste;
}

public function update(appe $appe)
{
	$req = 'UPDATE appe SET ';
	$req = $req. 'deappe = "'.$appe->deappe().'", ';
	$req = $req. 'reregi = '.$appe->reregi();
	$req = $req. ' WHERE reappe = '.$appe->reappe();
	
	$q = $this->_db->prepare($req);

	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>