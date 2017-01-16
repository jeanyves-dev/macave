<?php
class colo_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(colo $colo)
{

	$req = 'INSERT INTO colo (decolo,reempl) VALUES ';
	$req = $req. '("'.$colo->decolo().'",';
	$req = $req. $colo->reempl().')';

	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($recolo)
{
	$this->_db->exec('DELETE FROM colo WHERE recolo = '.$recolo);
}

public function get($recolo)
{
	$recolo = (int) $recolo;
	$q = $this->_db->query('SELECT * FROM colo WHERE recolo = '.$recolo);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new colo($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM colo WHERE recolo = (SELECT MAX(recolo) FROM colo);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new colo($donnees);
}

public function getList()
{
	$colo_liste = array();

	$q = $this->_db->query('SELECT * FROM colo');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$colo_liste[] = new colo($donnees);
	}

	return $colo_liste;
}

public function getListeEmpl($reempl)
{
	$colo_liste = array();

	$q = $this->_db->query('SELECT * FROM colo WHERE reempl = '.$reempl);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$colo_liste[] = new colo($donnees);
	}

	return $colo_liste;
}

public function update(colo $colo)
{
	$req = 'UPDATE colo SET ';
	$req = $req. 'decolo = "'.$colo->decolo().'", ';
	$req = $req. 'reempl = '.$colo->reempl();
	$req = $req. ' WHERE recolo = '.$colo->recolo();
	
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