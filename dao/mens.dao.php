<?php
class mens_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(mens $mens)
{
	$req = 'INSERT INTO mens (demens,limenu,remenu,norang) VALUES ';
	$req = $req. '("'.$mens->demens().'",';
	$req = $req. '"'.$mens->limenu().'",';
	$req = $req. $mens->remenu().',';
	$req = $req. $mens->norang().')';
	
	echo $req;
	
	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($remens)
{
	$this->_db->exec('DELETE FROM mens WHERE remens = '.$remens);
}

public function get($remens)
{
	$remens = (int) $remens;
	$q = $this->_db->query('SELECT * FROM mens WHERE remens = '.$remens);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new mens($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM mens WHERE remens = (SELECT MAX(remens) FROM mens);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new mens($donnees);
}

public function getList()
{
	$mens_liste = array();
	$q = $this->_db->query('SELECT * FROM mens ORDER BY remenu, norang');
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$mens_liste[] = new mens($donnees);
	}
	return $mens_liste;
}

public function getListMenu($remenu)
{
	$mens_liste = array();
	$q = $this->_db->query('SELECT * FROM mens WHERE remenu = '.$remenu.' ORDER BY norang');
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$mens_liste[] = new mens($donnees);
	}
	return $mens_liste;
}

public function update(mens $mens)
{
	$req = 'UPDATE mens SET ';
	$req = $req. 'demens = "'.$mens->demens().'", ';
	$req = $req. 'limenu = "'.$mens->limenu().'", ';
	$req = $req. 'remenu = '.$mens->remenu().', ';
	$req = $req. 'norang = '.$mens->norang();
	$req = $req. ' WHERE remens = '.$mens->remens();
	
	$q = $this->_db->prepare($req);

	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>