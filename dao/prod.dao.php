<?php
class prod_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(prod $prod)
{
	$req = 'INSERT INTO prod (deprod,adresa, adresb, codpos, villep, typrop, admail, adrweb) VALUES ';
	$req = $req. '("'.$prod->deprod().'",';
	$req = $req. '"'.$prod->adresa().'",';
	$req = $req. '"'.$prod->adresb().'",';
	$req = $req. '"'.$prod->codpos().'",';
	$req = $req. '"'.$prod->villep().'",';
	$req = $req. '"'.$prod->typrop().'",';
	$req = $req. '"'.$prod->admail().'",';
	$req = $req. '"'.$prod->adrweb().'")';

	echo $req;
	
	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($reprod)
{
	$this->_db->exec('DELETE FROM prod WHERE reprod = '.$reprod);
}

public function get($reprod)
{
	$reprod = (int) $reprod;
	$q = $this->_db->query('SELECT * FROM prod WHERE reprod = '.$reprod);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new prod($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM prod WHERE reprod = (SELECT MAX(reprod) FROM prod);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new prod($donnees);
}
	
public function getList()
{
	$prod_liste = array();

	$q = $this->_db->query('SELECT * FROM prod ORDER BY DEPROD');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$prod_liste[] = new prod($donnees);
	}

	return $prod_liste;
}

public function update(prod $prod)
{
	$req = 'UPDATE prod SET ';
	$req = $req. 'deprod = "'.$prod->deprod().'", ';
	$req = $req. 'adresa = "'.$prod->adresa().'", ';
	$req = $req. 'adresb = "'.$prod->adresb().'", ';
	$req = $req. 'codpos = "'.$prod->codpos().'", ';
	$req = $req. 'villep = "'.$prod->villep().'", ';
	$req = $req. 'typrop = "'.$prod->typrop().'", ';
	$req = $req. 'admail = "'.$prod->admail().'", ';
	$req = $req. 'adrweb = "'.$prod->adrweb().'" ';
	$req = $req. 'WHERE reprod = '.$prod->reprod();
	
	$q = $this->_db->prepare($req);

	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>