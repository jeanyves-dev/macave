<?php
class rdvc_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(rdvc $rdvc)
{
	$req = 'INSERT INTO rdvc (derdvc) VALUES ("'. $rdvc->derdvc(). '")';
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($rerdvc)
{
	$this->_db->exec('DELETE FROM rdvc WHERE rerdvc = '.$rerdvc);
}

public function get($rerdvc)
{
	$unrerdvc = (int) $rerdvc;
	$q = $this->_db->query('SELECT * FROM rdvc WHERE rerdvc = '.$unrerdvc);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new rdvc($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM rdvc WHERE rerdvc = (SELECT MAX(rerdvc) FROM rdvc);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new rdvc($donnees);
}

public function getList()
{
	$rdvc_liste = array();

	$q = $this->_db->query('SELECT * FROM rdvc');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$rdvc_liste[] = new rdvc($donnees);
	}

	return $rdvc_liste;
}

public function update(rdvc $rdvc)
{
	$req = 'UPDATE rdvc SET derdvc = "'.$rdvc->derdvc().'" WHERE rerdvc = '.$rdvc->rerdvc();
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>