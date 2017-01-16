<?php
class empl_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(empl $empl)
{
	$req = 'INSERT INTO empl (deempl) VALUES ("'. $empl->deempl(). '")';
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($reempl)
{
	$this->_db->exec('DELETE FROM empl WHERE reempl = '.$reempl);
}

public function get($reempl)
{
	$unreempl = (int) $reempl;
	$q = $this->_db->query('SELECT * FROM empl WHERE reempl = '.$unreempl);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new empl($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM empl WHERE reempl = (SELECT MAX(reempl) FROM empl);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new empl($donnees);
}

public function getFirst()
{
	$q = $this->_db->query('SELECT * FROM empl WHERE reempl = (SELECT MIN(reempl) FROM empl);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new empl($donnees);
}

public function getList()
{
	$empl_liste = array();

	$q = $this->_db->query('SELECT * FROM empl');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$empl_liste[] = new empl($donnees);
	}

	return $empl_liste;
}

public function update(empl $empl)
{
	$req = 'UPDATE empl SET deempl = "'.$empl->deempl().'" WHERE reempl = '.$empl->reempl();
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>