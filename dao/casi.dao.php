<?php
class casi_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(casi $casi)
{

	$req = 'INSERT INTO casi (decasi,recolo,nbrlig,nbrcol) VALUES ';
	$req = $req. '("'.$casi->decasi().'",';
	$req = $req. $casi->recolo().',';
	$req = $req. $casi->nbrlig().',';
	$req = $req. $casi->nbrcol().')';

	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($recasi)
{
	$this->_db->exec('DELETE FROM casi WHERE recasi = '.$recasi);
}

public function get($recasi)
{
	$recasi = (int) $recasi;
	$q = $this->_db->query('SELECT * FROM casi WHERE recasi = '.$recasi);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new casi($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM casi WHERE recasi = (SELECT MAX(recasi) FROM casi);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new casi($donnees);
}

public function getList()
{
	$casi_liste = array();

	$q = $this->_db->query('SELECT * FROM casi');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$casi_liste[] = new casi($donnees);
	}

	return $casi_liste;
}


public function getListeColo($recolo)
{
	$casi_liste = array();

	$q = $this->_db->query('SELECT * FROM casi WHERE recolo = '.$recolo);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$casi_liste[] = new casi($donnees);
	}

	return $casi_liste;
}

public function update(casi $casi)
{
	$req = 'UPDATE casi SET ';
	$req = $req. 'decasi = "'.$casi->decasi().'", ';
	$req = $req. 'recolo = '.$casi->recolo();
	$req = $req. ',nbrlig = '.$casi->nbrlig();
	$req = $req. ',nbrcol = '.$casi->nbrcol();
	$req = $req. ' WHERE recasi = '.$casi->recasi();
	
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