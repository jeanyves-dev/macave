<?php
class appr_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(appr $appr)
{
	$req = 'INSERT INTO appr (deappr) VALUES ("'. $appr->deappr(). '")';
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($reappr)
{
	$this->_db->exec('DELETE FROM appr WHERE reappr = '.$reappr);
}

public function get($reappr)
{
	$unreappr = (int) $reappr;
	$q = $this->_db->query('SELECT * FROM appr WHERE reappr = '.$unreappr);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new appr($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM appr WHERE reappr = (SELECT MAX(reappr) FROM appr);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new appr($donnees);
}

public function getList()
{
	$appr_liste = array();

	$q = $this->_db->query('SELECT * FROM appr');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$appr_liste[] = new appr($donnees);
	}

	return $appr_liste;
}

public function update(appr $appr)
{
	$req = 'UPDATE appr SET deappr = "'.$appr->deappr().'" WHERE reappr = '.$appr->reappr();
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>