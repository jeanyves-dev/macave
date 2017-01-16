<?php
class enso_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(enso $enso)
{

	$req = 'INSERT INTO enso (rebout,daenso,qtenso,seenso,refour,reappr) VALUES ';
	$req = $req. '('.$enso->rebout().',';
	$req = $req. '"'.$enso->daenso().'",';
	$req = $req. $enso->qtenso().',';
	$req = $req. $enso->seenso().',';
	$req = $req. $enso->refour().',';
	$req = $req. $enso->reappr().')';
	
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function delete(enso $enso)
{
	$this->_db->exec('DELETE FROM enso WHERE reenso = '.$enso->reenso());
}

public function get($reenso)
{
	$reenso = (int) $reenso;
	$q = $this->_db->query('SELECT * FROM enso WHERE reenso = '.$reenso);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new enso($donnees);
}

public function getStockTotal()
{
	$q = $this->_db->query('SELECT SUM(qtenso) as StockTot, seenso FROM enso GROUP BY seenso;');
	$res = 0;
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		if ($donnees['seenso'] == 1)
		{$res = $res + $donnees['StockTot'];}
		else
		{$res = $res - $donnees['StockTot'];}
		
	}
	return $res;
}

public function getStockCoul($recoul)
{
	$req = 'SELECT SUM(qtenso) as StockCoul, seenso FROM enso,bout,vins WHERE enso.rebout = bout.rebout AND bout.revins = vins.revins AND vins.recoul = '.$recoul.' GROUP BY seenso;';
	$q = $this->_db->query($req);
	$res = 0;
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		if ($donnees['seenso'] == 1)
		{$res = $res + $donnees['StockCoul'];}
		else
		{$res = $res - $donnees['StockCoul'];}
	}
	return $res;
}

public function getList()
{
	$enso_liste = array();

	$q = $this->_db->query('SELECT * FROM enso');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{$enso_liste[] = new enso($donnees);}
	return $enso_liste;
}

public function getNbrEntree($rebout)
{
	$enso_liste = array();

	$q = $this->_db->query('SELECT SUM(qtenso) as NbrEnt FROM enso WHERE seenso = 1 AND rebout = '.$rebout);
	$res = 0;

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{$res = $donnees['NbrEnt'];}
	return $res;
}

public function getNbrSortie($rebout)
{
	$enso_liste = array();

	$q = $this->_db->query('SELECT SUM(qtenso) as NbrSor FROM enso WHERE seenso = 2 AND rebout = '.$rebout);
	$res = 0;

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{$res = $donnees['NbrSor'];}
	return $res;
}

public function getListeBout($rebout)
{
	$enso_liste = array();

	$q = $this->_db->query('SELECT * FROM enso where rebout = '.$rebout);
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{$enso_liste[] = new enso($donnees);}
	return $enso_liste;
}

public function getListeBoutEntree($rebout)
{
	$enso_liste = array();

	$q = $this->_db->query('SELECT * FROM enso WHERE seenso = 1 AND rebout = '.$rebout);
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{$enso_liste[] = new enso($donnees);}
	return $enso_liste;
}

public function getListeBoutSortie($rebout)
{
	$enso_liste = array();

	$q = $this->_db->query('SELECT * FROM enso WHERE seenso = 2 AND rebout = '.$rebout);
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{$enso_liste[] = new enso($donnees);}
	return $enso_liste;
}

public function update(enso $enso)
{
	$req = 'UPDATE enso SET ';
	$req = $req. 'rebout = '.$enso->rebout();
	$req = $req. ',daenso = "'.$enso->daenso().'"';
	$req = $req. ',qtenso = '.$enso->qtenso();
	$req = $req. ',seenso = '.$enso->seenso();
	$req = $req. ',refour = '.$enso->refour();
	$req = $req. ',reappr = '.$enso->reappr();
	$req = $req. ' WHERE reenso = '.$enso->reenso();
	
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