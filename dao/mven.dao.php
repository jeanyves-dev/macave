<?php
class mven_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(mven $mven)
{

	$damven = substr($mven->damven(),6,4).".".substr($mven->damven(),3,2).".".substr($mven->damven(),0,2);
	$req = 'INSERT INTO mven (damven,refour,nomven,canapp) VALUES ("'.$damven.'",'.$mven->refour().',"'.$mven->nomven().'","'.$mven->canapp().'")';
	echo $req;
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($remven)
{
	$this->_db->exec('DELETE FROM mven WHERE remven = '.$remven);
}

public function get($remven)
{
	$unremven = (int) $remven;
	$q = $this->_db->query('SELECT * FROM mven WHERE remven = '.$unremven);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new mven($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM mven WHERE remven = (SELECT MAX(remven) FROM mven);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new mven($donnees);
}

public function getList()
{
	$mven_liste = array();

	$q = $this->_db->query('SELECT * FROM mven ORDER BY damven DESC');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$mven_liste[] = new mven($donnees);
	}

	return $mven_liste;
}

public function update(mven $mven)
{
	$damven = substr($mven->damven(),6,4).".".substr($mven->damven(),3,2).".".substr($mven->damven(),0,2);
	
	$req = 'UPDATE mven SET ';
	$req = $req. 'refour = '.$mven->refour();
	$req = $req. ',damven = "'.$damven.'"';
	$req = $req. ',nomven = "'.$mven->nomven().'"';
	$req = $req. ',canapp = "'.$mven->canapp().'"';
	$req = $req. ' WHERE remven = '.$mven->remven();
	
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