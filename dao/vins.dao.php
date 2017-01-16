<?php
class vins_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(vins $vins)
{

	$req = 'INSERT INTO vins (devins, repays, reregi, reappe, reprod, recoul,favori,retypv,reclas,cuvins,devinb,imvins) VALUES ';
	$req = $req. '("'.$vins->devins().'",';
	$req = $req. $vins->repays().',';
	$req = $req. $vins->reregi().',';
	$req = $req. $vins->reappe().',';
	$req = $req. $vins->reprod().',';
	$req = $req. $vins->recoul().',';
	$req = $req. $vins->favori().',';
	$req = $req. $vins->retypv().',';
	$req = $req. $vins->reclas().',';
	$req = $req. '"'.$vins->cuvins().'",';
	$req = $req. '"'.$vins->devinb().'",';
	$req = $req. '"'.$vins->imvins().'")';

	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function delete($revins)
{
	$this->_db->exec('DELETE FROM vins WHERE revins = '.$revins());
}

public function get($revins)
{
	$revins = (int) $revins;
	$q = $this->_db->query('SELECT * FROM vins WHERE revins = '.$revins);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new vins($donnees);
}

public function getList($order_champ,$order_sens,$nbraff,$nopage)
{
	$vins_liste = array();
	
	if ($order_champ == "")
	{$order_champ = "vins.devins";}
	if ($order_sens == "")
	{$order_sens = "ASC";}
	
	$limit = "";
	IF ($nbraff <> 0 AND $nopage <> 0)
	{
		$limmax = $nbraff * $nopage;
		$limmin = $limmax - $nbraff;
		$limit = " LIMIT ".$limmin." , ".$limmax;
	}
	
	$req1 = "SELECT vins.* FROM vins";
	$req2 = " LEFT OUTER JOIN pays ON vins.repays = pays.repays";
	$req3 = " LEFT OUTER JOIN regi ON vins.reregi = regi.reregi";
	$req4 = " LEFT OUTER JOIN appe ON vins.reappe = appe.reappe";
	$req5 = " LEFT OUTER JOIN prod ON vins.reprod = prod.reprod";
	$req6 = " LEFT OUTER JOIN coul ON vins.recoul = coul.recoul";
	$req7 = " LEFT OUTER JOIN typv ON vins.retypv = typv.retypv";
	$req = $req1.$req2.$req3.$req4.$req5.$req6.$req7;
	$tri = " ORDER BY ".$order_champ.' '.$order_sens;
	
	$q = $this->_db->query($req.$tri.$limit);
	
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$vins_liste[] = new vins($donnees);
	}

	return $vins_liste;
}

public function getListCoul($order_champ,$order_sens,$nbraff,$nopage,$recoul)
{
	$vins_liste = array();
	
	if ($order_champ == "")
	{$order_champ = "vins.devins";}
	if ($order_sens == "")
	{$order_sens = "ASC";}
	
	$limit = "";
	IF ($nbraff <> 0 AND $nopage <> 0)
	{
		$limmax = $nbraff * $nopage;
		$limmin = $limmax - $nbraff;
		$limit = " LIMIT ".$limmin." , ".$limmax;
	}
	
	$req = "SELECT vins.* FROM vins";
	$req = $req. " LEFT OUTER JOIN pays ON vins.repays = pays.repays";
	$req = $req. " LEFT OUTER JOIN regi ON vins.reregi = regi.reregi";
	$req = $req. " LEFT OUTER JOIN appe ON vins.reappe = appe.reappe";
	$req = $req. " LEFT OUTER JOIN prod ON vins.reprod = prod.reprod";
	$req = $req. " LEFT OUTER JOIN coul ON vins.recoul = coul.recoul";
	$req = $req. " LEFT OUTER JOIN typv ON vins.retypv = typv.retypv";
	
	$req = $req. " WHERE vins.recoul = ". $recoul;
	
	$tri = " ORDER BY ".$order_champ.' '.$order_sens;
	
	$q = $this->_db->query($req.$tri.$limit);
	
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$vins_liste[] = new vins($donnees);
	}

	return $vins_liste;
}

public function getListRegi($order_champ,$order_sens,$nbraff,$nopage,$reregi)
{
	$vins_liste = array();
	
	if ($order_champ == "")
	{$order_champ = "vins.devins";}
	if ($order_sens == "")
	{$order_sens = "ASC";}
	
	$limit = "";
	IF ($nbraff <> 0 AND $nopage <> 0)
	{
		$limmax = $nbraff * $nopage;
		$limmin = $limmax - $nbraff;
		$limit = " LIMIT ".$limmin." , ".$limmax;
	}
	
	$req = "SELECT vins.* FROM vins";
	$req = $req. " LEFT OUTER JOIN pays ON vins.repays = pays.repays";
	$req = $req. " LEFT OUTER JOIN regi ON vins.reregi = regi.reregi";
	$req = $req. " LEFT OUTER JOIN appe ON vins.reappe = appe.reappe";
	$req = $req. " LEFT OUTER JOIN prod ON vins.reprod = prod.reprod";
	$req = $req. " LEFT OUTER JOIN coul ON vins.recoul = coul.recoul";
	$req = $req. " LEFT OUTER JOIN typv ON vins.retypv = typv.retypv";
	
	$req = $req. " WHERE vins.reregi = ". $reregi;
	
	$tri = " ORDER BY ".$order_champ.' '.$order_sens;
	
	$q = $this->_db->query($req.$tri.$limit);
	
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$vins_liste[] = new vins($donnees);
	}

	return $vins_liste;
}

public function getListEnStock($order_champ,$order_sens)
{
	$vins_liste = array();
	
	if ($order_champ == "")
	{$order_champ = "vins.revins";}
	if ($order_sens == "")
	{$order_sens = "ASC";}
	
	$req = "SELECT ifnull(sum(mvel.qtmvel),0) as sum_qtmvel, ifnull(sum(mvsl.qtmvsl),0) as sum_qtmvsl, bout.*, vins.*, pays.*, regi.*, appe.*, prod.deprod, coul.*, typv.*, clas.*
			FROM bout 
			LEFT OUTER JOIN vins ON bout.revins = vins.revins 
			LEFT OUTER JOIN mvel ON bout.rebout = mvel.rebout 
			LEFT OUTER JOIN mvsl ON bout.rebout = mvsl.rebout 
			LEFT OUTER JOIN pays ON vins.repays = pays.repays 
			LEFT OUTER JOIN regi ON vins.reregi = regi.reregi 
			LEFT OUTER JOIN appe ON vins.reappe = appe.reappe 
			LEFT OUTER JOIN prod ON vins.reprod = prod.reprod 
			LEFT OUTER JOIN coul ON vins.recoul = coul.recoul 
			LEFT OUTER JOIN typv ON vins.retypv = typv.retypv 
			LEFT OUTER JOIN clas ON vins.reclas = clas.reclas 
			GROUP BY bout.rebout, vins.revins 
			HAVING sum_qtmvel - sum_qtmvsl > 0";

	$tri = " ORDER BY ".$order_champ.' '.$order_sens;
	
	$q = $this->_db->query($req.$tri);
	
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$vins_liste[] = new vins($donnees);
	}

	return $vins_liste;
}

public function getListDejaConsomme($order_champ,$order_sens)
{
	$vins_liste = array();
	
	if ($order_champ == "")
	{$order_champ = "vins.revins";}
	if ($order_sens == "")
	{$order_sens = "ASC";}
	
	$req = "SELECT ifnull(sum(mvel.qtmvel),0) as sum_qtmvel, ifnull(sum(mvsl.qtmvsl),0) as sum_qtmvsl, bout.*, vins.*, pays.*, regi.*, appe.*, prod.deprod, coul.*, typv.*, clas.*
			FROM bout 
			LEFT OUTER JOIN vins ON bout.revins = vins.revins 
			LEFT OUTER JOIN mvel ON bout.rebout = mvel.rebout 
			LEFT OUTER JOIN mvsl ON bout.rebout = mvsl.rebout 
			LEFT OUTER JOIN pays ON vins.repays = pays.repays 
			LEFT OUTER JOIN regi ON vins.reregi = regi.reregi 
			LEFT OUTER JOIN appe ON vins.reappe = appe.reappe 
			LEFT OUTER JOIN prod ON vins.reprod = prod.reprod 
			LEFT OUTER JOIN coul ON vins.recoul = coul.recoul 
			LEFT OUTER JOIN typv ON vins.retypv = typv.retypv 
			LEFT OUTER JOIN clas ON vins.reclas = clas.reclas 
			GROUP BY bout.rebout, vins.revins 
			HAVING sum_qtmvel + sum_qtmvsl > 0";

	$tri = " ORDER BY ".$order_champ.' '.$order_sens;
	
	$q = $this->_db->query($req.$tri);
	
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$vins_liste[] = new vins($donnees);
	}

	return $vins_liste;
}

public function getListFavori()
{
	$vins_liste = array();
	
	$req = "SELECT * FROM vins WHERE favori = 1;";
	$q = $this->_db->query($req);
	
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$vins_liste[] = new vins($donnees);
	}

	return $vins_liste;
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM vins WHERE revins = (SELECT MAX(revins) FROM vins);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new vins($donnees);
}

public function getNbrVins()
{
	$q = $this->_db->query('SELECT COUNT(*) AS nbvins FROM vins;');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return $donnees["nbvins"];
}

public function RechByDevins($devins)
{
	$vins_liste = array();

	$q = $this->_db->query('SELECT * FROM vins WHERE devins LIKE %'.$devins.'%');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$vins_liste[] = new vins($donnees);
	}

	return $vins_liste;
}

public function updateFavori($favori)
{
	$req = 'UPDATE vins SET ';
	$req = $req. 'favori = '.$favori;
	$req = $req. ' WHERE revins = '.$vins->revins();
	
	$q = $this->_db->prepare($req);
	
	$q->execute();
}

public function update(vins $vins)
{
	$req = 'UPDATE vins SET ';
	$req = $req. 'devins = "'.$vins->devins().'", ';
	$req = $req. 'repays = '.$vins->repays().',';
	$req = $req. 'reregi = '.$vins->reregi().',';
	$req = $req. 'reappe = '.$vins->reappe().',';
	$req = $req. 'reprod = '.$vins->reprod().',';
	$req = $req. 'favori = '.$vins->favori().',';
	$req = $req. 'recoul = '.$vins->recoul().',';
	$req = $req. 'retypv = '.$vins->retypv().',';
	$req = $req. 'reclas = '.$vins->reclas().',';
	$req = $req. 'cuvins = "'.$vins->cuvins().'",';
	$req = $req. 'devinb = "'.$vins->devinb().'",';
	$req = $req. 'imvins = "'.$vins->imvins().'"';
	$req = $req. ' WHERE revins = '.$vins->revins();
	
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