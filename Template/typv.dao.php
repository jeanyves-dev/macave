<?php
class typv_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(typv $typv)
{
	$req = 'INSERT INTO typv (detypv) VALUES ("'. $typv->detypv(). '")';
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($retypv)
{
	$this->_db->exec('DELETE FROM typv WHERE retypv = '.$retypv);
}

public function get($retypv)
{
	$unretypv = (int) $retypv;
	$q = $this->_db->query('SELECT * FROM typv WHERE retypv = '.$unretypv);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new typv($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM typv WHERE retypv = (SELECT MAX(retypv) FROM typv);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new typv($donnees);
}

public function getList()
{
	$typv_liste = array();

	$q = $this->_db->query('SELECT * FROM typv');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$typv_liste[] = new typv($donnees);
	}

	return $typv_liste;
}

public function update(typv $typv)
{
	$req = 'UPDATE typv SET detypv = "'.$typv->detypv().'" WHERE retypv = '.$typv->retypv();
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>