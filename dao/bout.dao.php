<?php

class bout_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(bout $bout)
{

	IF ($bout->degres() == "")
		{$degres = 0;}
	else
		{$degres = $bout->degres();}

	$req = 'INSERT INTO bout (revins,regaba,anmile,anapog,anaboi,bonote,degres) VALUES ';
	$req = $req. '('.$bout->revins().',';
	$req = $req. $bout->regaba().',';
	$req = $req. $bout->anmile().',';
	$req = $req. $bout->anapog().',';
	$req = $req. $bout->anaboi().',';
	$req = $req. $bout->bonote().',';
	$req = $req. $degres.')';
	
	echo $req;

	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete(bout $bout)
{
	$this->_db->exec('DELETE FROM bout WHERE rebout = '.$bout->rebout());
}

public function get($rebout)
{
	$rebout = (int) $rebout;
	$q = $this->_db->query('SELECT * FROM bout WHERE rebout = '.$rebout);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new bout($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM bout WHERE rebout = (SELECT MAX(rebout) FROM bout);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new bout($donnees);
}

public function getLastRef()
{
	$q = $this->_db->query('SELECT rebout FROM bout WHERE rebout = (SELECT MAX(rebout) FROM bout);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return $donnees["rebout"];
}

public function getList()
{
	$bout_liste = array();

	$q = $this->_db->query('SELECT * FROM bout');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$bout_liste[] = new bout($donnees);
	}

	return $bout_liste;
}

public function getListeVins($revins)
{
	$bout_liste = array();

	$q = $this->_db->query('SELECT * FROM bout WHERE revins = '.$revins);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$bout_liste[] = new bout($donnees);
	}

	return $bout_liste;
}

public function getNbBoutVins($revins)
{
	$NbrBout = 0;

	$q = $this->_db->query('SELECT * FROM bout WHERE revins = '.$revins);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$NbrBout = $NbrBout + 1;
	}

	return $NbrBout;
}

public function getRech($zone,$valeur)
{
	$bout_liste = array();
	
	echo "<script>alert(".$zone.");</script>"; 
	
	switch ($zone)
	{
	case "devins":
        $req = 'SELECT * FROM bout,vins WHERE bout.revins = vins.revins AND devins LIKE "%'.$valeur.'%";';
        break;
	case "depays":
        $req = 'SELECT * FROM bout,vins,pays WHERE bout.revins = vins.revins AND pays.repays = vins.repays AND pays.depays LIKE "%'.$valeur.'%";';
        break;
	case "deregi":
        $req = 'SELECT * FROM bout,vins,regi WHERE bout.revins = vins.revins AND regi.reregi = vins.reregi AND regi.deregi LIKE "%'.$valeur.'%";';
        break;
	case "deappe":
        $req = 'SELECT * FROM bout,vins,appe WHERE bout.revins = vins.revins AND appe.reappe = vins.reappe AND appe.deappe LIKE "%'.$valeur.'%";';
        break;
	case "decoul":
        $req = 'SELECT * FROM bout,vins,coul WHERE bout.revins = vins.revins AND coul.recoul = vins.recoul AND coul.decoul LIKE "%'.$valeur.'%";';
        break;
	case "anmile":
        $req = 'SELECT * FROM bout WHERE bout.anmile LIKE "%'.$valeur.'%";';
        break;
	}
	
	$q = $this->_db->query($req);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$bout_liste[] = new bout($donnees);
	}

	return $bout_liste;
}

public function getListeABoire($anaboi)
{
	$bout_liste = array();

	$q = $this->_db->query('SELECT * FROM bout WHERE anaboi = '.$anaboi);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$bout_liste[] = new bout($donnees);
	}

	return $bout_liste;
}

public function getListeDistAnaboi()
{
	$bout_liste = array();

	$q = $this->_db->query('SELECT DISTINCT anaboi FROM bout;');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$bout_liste[] = $donnees["anaboi"];
	}

	return $bout_liste;
}

public function update(bout $bout)
{
	$req = 'UPDATE bout SET ';
	$req = $req. 'revins = '.$bout->revins();
	$req = $req. ',regaba = '.$bout->regaba();
	$req = $req. ',anmile = '.$bout->anmile();
	$req = $req. ',anapog = '.$bout->anapog();
	$req = $req. ',anaboi = '.$bout->anaboi();
	$req = $req. ',bonote = '.$bout->bonote();
	$req = $req. ',degres = '.$bout->degres();
	$req = $req. ' WHERE rebout = '.$bout->rebout();
	
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