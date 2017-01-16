<?php
class mvso_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(mvso $mvso)
{
	$damvso = substr($mvso->damvso(),6,4).".".substr($mvso->damvso(),3,2).".".substr($mvso->damvso(),0,2);
	$req = 'INSERT INTO mvso (damvso,nomvso) VALUES ("'.$damvso.'","'.$mvso->nomvso().'")';
	echo $req;
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($remvso)
{
	$this->_db->exec('DELETE FROM mvso WHERE remvso = '.$remvso);
}

public function get($remvso)
{
	$unremvso = (int) $remvso;
	$q = $this->_db->query('SELECT * FROM mvso WHERE remvso = '.$unremvso);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new mvso($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM mvso WHERE remvso = (SELECT MAX(remvso) FROM mvso);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new mvso($donnees);
}

public function getList()
{
	$mvso_liste = array();

	$q = $this->_db->query('SELECT * FROM mvso ORDER BY damvso DESC');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$mvso_liste[] = new mvso($donnees);
	}

	return $mvso_liste;
}

public function update(mvso $mvso)
{
	$damvso = substr($mvso->damvso(),6,4).".".substr($mvso->damvso(),3,2).".".substr($mvso->damvso(),0,2);
	
	$req = 'UPDATE mvso SET ';
	$req = $req. 'damvso = "'.$damvso.'"';
	$req = $req. ',nomvso = "'.$mvso->nomvso().'"';
	$req = $req. ' WHERE remvso = '.$mvso->remvso();
	
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