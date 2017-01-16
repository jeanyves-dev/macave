<?php
class acco_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(acco $acco)
{
	$req = 'INSERT INTO acco (revins,replat) VALUES ';
	$req = $req. '('.$acco->revins().','.$acco->replat().')';
	
	echo $req;
	
	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($reacco)
{
	$this->_db->exec('DELETE FROM acco WHERE reacco = '.$reacco);
}

public function get($reacco)
{
	$reacco = (int) $reacco;
	$q = $this->_db->query('SELECT * FROM acco WHERE reacco = '.$reacco);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new acco($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM acco WHERE reacco = (SELECT MAX(reacco) FROM acco);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new acco($donnees);
}

public function getList()
{
	$acco_liste = array();
	$q = $this->_db->query('SELECT * FROM acco');
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$acco_liste[] = new acco($donnees);
	}
	return $acco_liste;
}

public function update(acco $acco)
{
	$req = 'UPDATE acco SET ';
	$req = $req. 'revins = '.$acco->revins().', ';
	$req = $req. 'replat = '.$acco->replat();
	$req = $req. ' WHERE reacco = '.$acco->reacco();
	
	$q = $this->_db->prepare($req);

	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>