<?php
class cepa_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(cepa $cepa)
{

	$req  = 'INSERT INTO cepa (decepa) VALUES ("'.$cepa->Decepa().'")';
	
	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete(cepa $cepa)
{
	$this->_db->exec('DELETE FROM cepa WHERE recepa = '.$cepa->recepa());
}

public function get($recepa)
{
	$recepa = (int) $recepa;
	$q = $this->_db->query('SELECT * FROM cepa WHERE recepa = '.$recepa);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new cepa($donnees);
}

public function getList()
{
	$cepa_liste = array();

	$q = $this->_db->query('SELECT * FROM cepa');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$cepa_liste[] = new cepa($donnees);
	}

	return $cepa_liste;
}

public function update(cepa $cepa)
{
	$req = 'UPDATE cepa SET ';
	$req = $req. 'decepa = "'.$cepa->Decepa().'"';
	$req = $req. ' WHERE recepa = '.$cepa->Recepa();
	
	$q = $this->_db->prepare($req);

	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>