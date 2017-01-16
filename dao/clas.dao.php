<?php
class clas_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(clas $clas)
{
	$req = 'INSERT INTO clas (declas) VALUES ("'. $clas->declas(). '")';
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($reclas)
{
	$this->_db->exec('DELETE FROM clas WHERE reclas = '.$reclas);
}

public function get($reclas)
{
	$unreclas = (int) $reclas;
	$q = $this->_db->query('SELECT * FROM clas WHERE reclas = '.$unreclas);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new clas($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM clas WHERE reclas = (SELECT MAX(reclas) FROM clas);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new clas($donnees);
}

public function getList()
{
	$clas_liste = array();

	$q = $this->_db->query('SELECT * FROM clas');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$clas_liste[] = new clas($donnees);
	}

	return $clas_liste;
}

public function update(clas $clas)
{
	$req = 'UPDATE clas SET declas = "'.$clas->declas().'" WHERE reclas = '.$clas->reclas();
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>