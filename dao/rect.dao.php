<?php
class rect_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(rect $rect)
{
	$req = 'INSERT INTO rect (derect) VALUES ("'. $rect->derect(). '")';
	echo $req;
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($rerect)
{
	$this->_db->exec('DELETE FROM rect WHERE rerect = '.$rerect);
}

public function get($rerect)
{
	$unrerect = (int) $rerect;
	$q = $this->_db->query('SELECT * FROM rect WHERE rerect = '.$unrerect);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new rect($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM rect WHERE rerect = (SELECT MAX(rerect) FROM rect);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new rect($donnees);
}

public function getList()
{
	$rect_liste = array();

	$q = $this->_db->query('SELECT * FROM rect');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$rect_liste[] = new rect($donnees);
	}

	return $rect_liste;
}

public function update(rect $rect)
{
	$req = 'UPDATE rect SET derect = "'.$rect->derect().'" WHERE rerect = '.$rect->rerect();
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>