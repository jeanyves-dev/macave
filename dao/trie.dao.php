<?php
class trie_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(trie $trie)
{
	$req = 'INSERT INTO trie (retabl,champs,senstr) VALUES ';
	$req = $req. '("'.$trie->retabl().'",';
	$req = $req. ' "'.$trie->champs().'",';
	$req = $req. ' "'.$trie->senstr().'")';
	
	echo $req;
	
	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($retabl)
{
	$this->_db->exec('DELETE FROM trie WHERE retabl = '.$retabl);
}

public function getTabl($retabl)
{
	$q = $this->_db->query('SELECT * FROM trie WHERE retabl = "'.$retabl.'"');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	if ($donnees == false)
	{return new trie(array("","",""));}
	else
	{return new trie($donnees);}
	
}

public function get($retabl,$champs,$senstr)
{
	$retrie = (int) $retrie;
	$q = $this->_db->query('SELECT * FROM trie WHERE retabl = "'.$retabl.'" AND champs = "'.$champs.'" AND senstr = "'.$senstr.'"');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new trie($donnees);
}

public function update(trie $trie)
{

	echo $trie->senstr();
	
	if ($trie->senstr() == "ASC")
	{$sens = "DESC";}
	else
	{$sens = "ASC";}
	
	$req = 'UPDATE trie SET ';
	$req = $req. 'retabl = "'.$trie->retabl().'", ';
	$req = $req. 'champs = "'.$trie->champs().'", ';
	$req = $req. 'senstr = "'.$sens.'"';
	$req = $req. ' WHERE retabl = "'.$trie->retabl().'"';
	
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