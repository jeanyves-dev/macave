<?php
class gaba_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(gaba $gaba)
{

	$req = 'INSERT INTO gaba SET ';
	$req = $req. 'degaba = "'.$gaba->degaba().'", ';
	$req = $req. 'conten = '.$gaba->conten();
	
	$q = $this->_db->prepare($req);
		
	$q->execute();
}

public function delete(gaba $gaba)
{
	$this->_db->exec('DELETE FROM gaba WHERE regaba = '.$gaba->regaba());
}

public function get($regaba)
{
	$regaba = (int) $regaba;
	$q = $this->_db->query('SELECT * FROM gaba WHERE regaba = '.$regaba);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new gaba($donnees);
}

public function getList()
{
	$gaba_liste = array();

	$q = $this->_db->query('SELECT * FROM gaba');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$gaba_liste[] = new gaba($donnees);
	}

	return $gaba_liste;
}

public function update(gaba $gaba)
{
	$req = 'UPDATE gaba SET ';
	$req = $req. 'degaba = "'.$gaba->Degaba().'", ';
	$req = $req. 'conten = '.$gaba->Conten();
	$req = $req. ' WHERE regaba = '.$gaba->Regaba();
	
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