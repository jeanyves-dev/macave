<?php
class degu_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(degu $degu)
{
	$dadegu = substr($degu->dadegu(),6,4).".".substr($degu->dadegu(),3,2).".".substr($degu->dadegu(),0,2);

	$req = 'INSERT INTO degu (nodegu,dadegu) VALUES ';
	$req = $req. '("'.$degu->nodegu().'",';
	$req = $req. '"'.$dadegu.'")';
	
	echo $req;
	
	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($redegu)
{
	$this->_db->exec('DELETE FROM degu WHERE redegu = '.$redegu);
}

public function get($redegu)
{
	$redegu = (int) $redegu;
	$q = $this->_db->query('SELECT * FROM degu WHERE redegu = '.$redegu);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new degu($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM degu WHERE redegu = (SELECT MAX(redegu) FROM degu);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new degu($donnees);
}

public function getList()
{
	$degu_liste = array();
	$q = $this->_db->query('SELECT * FROM degu ORDER BY redegu');
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$degu_liste[] = new degu($donnees);
	}
	return $degu_liste;
}

public function update(degu $degu)
{
	$dadegu = substr($degu->dadegu(),6,4).".".substr($degu->dadegu(),3,2).".".substr($degu->dadegu(),0,2);

	$req = 'UPDATE degu SET ';
	$req = $req. 'nodegu = "'.$degu->nodegu().'", ';
	$req = $req. 'dadegu = "'.$dadegu.'"';
	$req = $req. ' WHERE redegu = '.$degu->redegu();
	
	$q = $this->_db->prepare($req);

	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>