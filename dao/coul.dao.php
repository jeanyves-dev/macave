<?php
class coul_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(coul $coul)
{

	$req  = 'INSERT INTO coul (decoul,cocoul) VALUES ("'.$coul->decoul().'","'.$coul->cocoul().'"); ';
	
	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($recoul)
{
	$this->_db->exec('DELETE FROM coul WHERE recoul = '.$recoul);
}

public function get($recoul)
{
	$recoul = (int) $recoul;
	$q = $this->_db->query('SELECT * FROM coul WHERE recoul = '.$recoul);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new coul($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM coul WHERE recoul = (SELECT MAX(recoul) FROM coul);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new coul($donnees);
}

public function getList()
{
	$coul_liste = array();

	$q = $this->_db->query('SELECT * FROM coul');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$coul_liste[] = new coul($donnees);
	}

	return $coul_liste;
}

public function update(coul $coul)
{
	$req = 'UPDATE coul SET decoul = "'.$coul->decoul().'", cocoul = "'.$coul->cocoul().'" WHERE recoul = '.$coul->recoul();
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>