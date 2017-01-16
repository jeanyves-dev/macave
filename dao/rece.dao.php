<?php
class rece_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(rece $rece)
{
	$req = 'INSERT INTO rece (derece,replat,rerect) VALUES ';
	$req = $req. '("'.$rece->derece().'",'.$rece->replat().','.$rece->rerect().')';
	
	echo $req;
	
	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($rerece)
{
	$this->_db->exec('DELETE FROM rece WHERE rerece = '.$rerece);
}

public function get($rerece)
{
	$rerece = (int) $rerece;
	$q = $this->_db->query('SELECT * FROM rece WHERE rerece = '.$rerece);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new rece($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM rece WHERE rerece = (SELECT MAX(rerece) FROM rece);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new rece($donnees);
}

public function getList()
{
	$rece_liste = array();
	$q = $this->_db->query('SELECT * FROM rece ORDER BY derece');
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$rece_liste[] = new rece($donnees);
	}
	return $rece_liste;
}

public function update(rece $rece)
{
	$req = 'UPDATE rece SET ';
	$req = $req. 'derece = "'.$rece->derece().'", ';
	$req = $req. 'replat = '.$rece->replat().', ';
	$req = $req. 'rerect = '.$rece->rerect();
	$req = $req. ' WHERE rerece = '.$rece->rerece();
	
	$q = $this->_db->prepare($req);

	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>