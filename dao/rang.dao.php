<?php
class rang_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(rang $rang)
{
	$req = 'INSERT INTO rang (recasi,rebout,poslig,poscol) VALUES ('.$rang->Recasi().','.$rang->rebout().','.$rang->poslig().','.$rang->poscol().')';
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($rerang)
{
	$this->_db->exec('DELETE FROM rang WHERE rerang = '.$rerang);
}

public function get($rerang)
{
	$unrerang = (int) $rerang;
	$q = $this->_db->query('SELECT * FROM rang WHERE rerang = '.$unrerang);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new rang($donnees);
}

public function getCasi($recasi,$poslig,$poscol)
{
	$unrecasi = (int) $recasi;
	$req = 'SELECT * FROM rang WHERE recasi = '.$unrecasi.' AND poslig =  '.$poslig.' AND poscol =  '.$poscol;
	$q = $this->_db->query($req);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	if (empty($donnees) == FALSE)
		{return new rang($donnees);}
	else
		{return "";}
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM rang WHERE rerang = (SELECT MAX(rerang) FROM rang);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new rang($donnees);
}

public function getList()
{
	$rang_liste = array();

	$q = $this->_db->query('SELECT * FROM rang');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$rang_liste[] = new rang($donnees);
	}

	return $rang_liste;
}

public function getQtRangBout($rebout)
{
	$qtrang = 0;

	$q = $this->_db->query('SELECT COUNT(*) AS qtrang FROM rang WHERE rebout = '.$rebout);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{$qtrang = $donnees["qtrang"];}

	return $qtrang;
}

public function getQtRangBoutCasi($rebout,$recasi)
{
	$qtrang = 0;

	$q = $this->_db->query('SELECT COUNT(*) AS qtrang FROM rang WHERE rebout = '.$rebout.' AND recasi = '.$recasi);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{$qtrang = $donnees["qtrang"];}

	return $qtrang;
}

public function getListBout($rebout)
{
	$rang_liste = array();

	$q = $this->_db->query('SELECT * FROM rang WHERE rebout = '.$rebout);

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{$rang_liste[] = new rang($donnees);}

	return $rang_liste;
}

public function getListCasiBout($rebout)
{

	$q = $this->_db->query('SELECT COUNT(rang.rerang) AS NbrRang, rang.recasi, casi.decasi FROM rang, casi WHERE casi.recasi = rang.recasi AND rang.rebout = '.$rebout.' GROUP BY rang.recasi, decasi');

	if ($donnees = $q->fetchAll())
		/*{return $donnees;}*/
		{$rang_liste[] = new rang($donnees);}
		
		$rang_liste = array();

	;
}

public function update(rang $rang)
{
	$req = 'UPDATE rang SET recasi = '.$rang->recasi().',rebout = '.$rang->rebout().',poslig = '.$rang->poslig().',poscol = '.$rang->poscol().' WHERE rerang = '.$rang->rerang();
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>