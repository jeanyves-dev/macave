<?php
class plat_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(plat $plat)
{
	$req = 'INSERT INTO plat (deplat) VALUES ("'. $plat->deplat(). '")';
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($replat)
{
	$this->_db->exec('DELETE FROM plat WHERE replat = '.$replat);
}

public function get($replat)
{
	$unreplat = (int) $replat;
	$q = $this->_db->query('SELECT * FROM plat WHERE replat = '.$unreplat);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new plat($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM plat WHERE replat = (SELECT MAX(replat) FROM plat);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new plat($donnees);
}

public function getList()
{
	$plat_liste = array();

	$q = $this->_db->query('SELECT * FROM plat');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$plat_liste[] = new plat($donnees);
	}

	return $plat_liste;
}

public function update(plat $plat)
{
	$req = 'UPDATE plat SET deplat = "'.$plat->deplat().'" WHERE replat = '.$plat->replat();
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>