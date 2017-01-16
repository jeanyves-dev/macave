<?php
class four_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(four $four)
{
	$req = 'INSERT INTO four (defour, adresa, adresb, codpos, villef, numtel, numfax, admail, sitweb) VALUES ';
	$req = $req. '("'.$four->defour().'",';
	$req = $req. '"'.$four->adresa().'",';
	$req = $req. '"'.$four->adresb().'",';
	$req = $req. '"'.$four->codpos().'",';
	$req = $req. '"'.$four->villef().'",';
	$req = $req. '"'.$four->numtel().'",';
	$req = $req. '"'.$four->numfax().'",';
	$req = $req. '"'.$four->admail().'",';
	$req = $req. '"'.$four->sitweb().'")';
	
	echo $req;
	
	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($refour)
{
	$this->_db->exec('DELETE FROM four WHERE refour = '.$refour);
}

public function get($refour)
{
	$refour = (int) $refour;
	$q = $this->_db->query('SELECT * FROM four WHERE refour = '.$refour);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new four($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM four WHERE refour = (SELECT MAX(refour) FROM four);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new four($donnees);
}
	
public function getList()
{
	$four_liste = array();

	$q = $this->_db->query('SELECT * FROM four  ORDER BY DEFOUR');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$four_liste[] = new four($donnees);
	}

	return $four_liste;
}

public function update(four $four)
{
	$req = 'UPDATE four SET ';
	$req = $req. 'defour = "'.$four->defour().'", ';
	$req = $req. 'adresa = "'.$four->adresa().'", ';
	$req = $req. 'adresb = "'.$four->adresb().'", ';
	$req = $req. 'codpos = "'.$four->codpos().'", ';
	$req = $req. 'villef = "'.$four->villef().'", ';
	$req = $req. 'numtel = "'.$four->numtel().'", ';
	$req = $req. 'numfax = "'.$four->numfax().'", ';
	$req = $req. 'admail = "'.$four->admail().'", ';
	$req = $req. 'sitweb = "'.$four->sitweb().'" ';
	$req = $req. 'WHERE refour = '.$four->refour();
	
	$q = $this->_db->prepare($req);

	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>