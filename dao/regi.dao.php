<?php
class regi_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(regi $regi)
{

	$req = 'INSERT INTO regi (deregi,repays) VALUES ';
	$req = $req. '("'.$regi->deregi().'",';
	$req = $req. $regi->repays().')';

	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($reregi)
{
	$this->_db->exec('DELETE FROM regi WHERE reregi = '.$reregi);
}

public function get($reregi)
{
	$reregi = (int) $reregi;
	$q = $this->_db->query('SELECT * FROM regi WHERE reregi = '.$reregi);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new regi($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM regi WHERE reregi = (SELECT MAX(reregi) FROM regi);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new regi($donnees);
}

public function getList()
{
	$regi_liste = array();

	$q = $this->_db->query('SELECT * FROM regi  ORDER BY DEREGI');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$regi_liste[] = new regi($donnees);
	}

	return $regi_liste;
}

public function getListPays($repays)
{
	$regi_liste = array();

	$q = $this->_db->query('SELECT * FROM regi WHERE repays = '.$repays.' ORDER BY DEREGI');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$regi_liste[] = new regi($donnees);
	}

	return $regi_liste;
}

public function update(regi $regi)
{
	$req = 'UPDATE regi SET ';
	$req = $req. 'deregi = "'.$regi->deregi().'", ';
	$req = $req. 'repays = '.$regi->repays();
	$req = $req. ' WHERE reregi = '.$regi->reregi();
	
	echo $req;
	
	$q = $this->_db->prepare($req);

	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>