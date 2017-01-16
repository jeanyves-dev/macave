<?php
class cepv_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(cepv $cepv)
{
	$req = 'INSERT INTO cepv (revins, recepa, qtcepv) VALUES ('.$cepv->revins().','.$cepv->recepa().','.$cepv->qtcepv().')';
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($revins,$recepa)
{
	$this->_db->exec('DELETE FROM cepv WHERE revins = '.$revins.' AND recepa = '.$recepa);
}

public function get($revins,$recepa)
{
	$revins = (int) $revins;
	$recepa = (int) $recepa;
	$q = $this->_db->query('SELECT * FROM cepv WHERE revins = '.$revins.' AND recepa = '.$recepa);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new cepv($donnees);
}

public function getList($revins)
{
	$cepv_liste = array();

	$q = $this->_db->query('SELECT * FROM cepv WHERE revins = '.$revins);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$cepv_liste[] = new cepv($donnees);
	}

	return $cepv_liste;
}

public function update(cepv $cepv)
{

	
	$req = 'UPDATE cepv SET revins = '.$cepv->revins().', recepa = '.$cepv->recepa().', qtcepv = '.$cepv->Qtcepv().' WHERE revins = '.$cepv->revins().' AND recepa = '.$cepv->recepa();
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>