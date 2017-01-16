<?php
class pays_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(pays $pays)
{
	$req = 'INSERT INTO pays (depays) VALUES ("'. $pays->depays(). '")';
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($repays)
{
	$this->_db->exec('DELETE FROM pays WHERE repays = '.$repays);
}

public function get($repays)
{
	$unrepays = (int) $repays;
	$q = $this->_db->query('SELECT * FROM pays WHERE repays = '.$unrepays);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new pays($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM pays WHERE repays = (SELECT MAX(repays) FROM pays);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new pays($donnees);
}

public function getList()
{
	$pays_liste = array();

	$q = $this->_db->query('SELECT * FROM pays  ORDER BY REPAYS');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$pays_liste[] = new pays($donnees);
	}

	return $pays_liste;
}

public function update(pays $pays)
{
	$req = 'UPDATE pays SET depays = "'.$pays->depays().'" WHERE repays = '.$pays->repays();
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>