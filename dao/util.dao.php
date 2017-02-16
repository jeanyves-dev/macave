<?php
class util_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(util $util)
{
	$req = 'INSERT INTO util (inutil, mputil,noutil,prutil) VALUES ("'.$util->inutil().'","'.$util->mputil().'","'.$util->noutil().'","'.$util->prutil().'")';
	echo $req;
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($inutil)
{
	$this->_db->exec('DELETE FROM util WHERE inutil = '.$inutil);
}

public function get($inutil)
{
	$q = $this->_db->query('SELECT * FROM util WHERE inutil = "'.$uninutil.'"');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new util($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM util WHERE inutil = (SELECT MAX(inutil) FROM util);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new util($donnees);
}

public function getList()
{
	$util_liste = array();

	$q = $this->_db->query('SELECT * FROM util ORDER BY prutil, inutil');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$util_liste[] = new util($donnees);
	}

	return $util_liste;
}

public function update(util $util)
{
	$req = 'UPDATE util SET mputil = "'.$util->mputil().'", noutil = "'.$util->noutil().'", prutil = "'.$util->prutil().'" WHERE inutil = "'.$util->inutil().'"';
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>