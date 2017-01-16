<?php

/* Connexion à la base */
require '../index/conn_db.php';

/* Initialise les variables */
$nomtab = "";
$ficcla = "";
$r = chr(13);
$t = chr(9);

$meschamps = array();

if ((isset($_POST['nomtab'])) and ($_POST['nomtab'] <> ""))
{
	$nomtab = $_POST['nomtab'];
	$ficcla = '../dao/'.$nomtab.'.dao.php';
	
	/* Liste des champs */
	$q = $db->query("SHOW COLUMNS FROM ".$nomtab);
	
	/* entête du fichier */
	$fic = '<?php'.$r.$r;
	$fic = $fic.'class '.$nomtab.'_dao'.$r;
	$fic = $fic.'{'.$r;
	
	/* Variable DB */
	$fic = $fic.'private $_db;'.$r.$r;
	
	/* Constructeur */
	$fic = $fic.'public function __construct($db)';
	$fic = $fic.'{';
	$fic = $fic.$t.'$this->setDb($db);';
	$fic = $fic.'}';
	
	/* Fonction add */
	$ListeChamps = "";
	while ($meschamps = $q->fetch(PDO::FETCH_ASSOC))
		{$ListeChamps = $ListeChamps.strtolower($meschamps['Field']).',';}
	IF ($ListeChamps <> "")
		{$ListeChamps = substr($ListeChamps, 0, -1);}
	
	$ListeData = "";
	while ($meschamps = $q->fetch(PDO::FETCH_ASSOC))
	{
		IF (substr($meschamps['Type'],0,3) == "Int")
			{$ListeData = $ListeData.'.$'.$nomtab.'->'.strtolower($meschamps['Field']).'().,';}
		IF (substr($meschamps['Type'],0,3) == "Var")
			{$ListeData = $ListeData.'".$'.$nomtab.'->'.strtolower($meschamps['Field']).'().",';}
	}
	
	echo $ListeData;
	
	$fic = $fic.'public function add('.$nomtab.' $'.$nomtab.')'.$r;
	$fic = $fic.'{'.$r;
	$fic = $fic.$t.'$req = "INSERT INTO '.$nomtab.' ('.$ListeChamps.') VALUES ";'.$r;
	$fic = $fic.$t.'$req = $req.';
	$fic = $fic."'(".$ListeData.")';".$r;
	
	$fic = $fic.$t.'echo $req;';
	
	$fic = $fic.$t.'$q = $this->_db->prepare($req);'.$r;
	$fic = $fic.$t.'$q->execute();'.$r;
	$fic = $fic.'}'.$r;
	
	$fic = $fic.$r;
	
	/* Fonction Delete */
	$fic = $fic.'public function delete($re'.$nomtab.')'.$r;
	$fic = $fic.'{'.$r;
	$fic = $fic.'$this->_db->exec("DELETE FROM '.$nomtab.' WHERE re'.$nomtab.' = ".$re'.$nomtab.')'.$r;
	$fic = $fic.'}'.$r;
	$fic = $fic.$r;
	
	/* Fonction GET */
	$fic = $fic.'public function get($re'.$nomtab.')'.$r;
	$fic = $fic.'{'.$r;
	$fic = $fic.$t.'$re'.$nomtab.' = (int) $re'.$nomtab.';'.$r;
	$fic = $fic.$t.'$q = $this->_db->query("SELECT * FROM '.$nomtab.' WHERE re'.$nomtab.' = ".$re'.$nomtab.');'.$r;
	$fic = $fic.$t.'$donnees = $q->fetch(PDO::FETCH_ASSOC);'.$r;
	$fic = $fic.$t.'return new '.$nomtab.'($donnees);'.$r;
	$fic = $fic.'}'.$r;
	$fic = $fic.$r;
	
	/* Fonction GET LAST */
	$fic = $fic.'public function getLast()'.$r;
	$fic = $fic.'{'.$r;
	$fic = $fic.$t.'$q = $this->_db->query("SELECT * FROM '.$nomtab.' WHERE re'.$nomtab.' = (SELECT MAX(re'.$nomtab.') FROM '.$nomtab.');");'.$r;
	$fic = $fic.$t.'$donnees = $q->fetch(PDO::FETCH_ASSOC);'.$r;
	$fic = $fic.$t.'return new '.$nomtab.'($donnees);'.$r;
	$fic = $fic.'}'.$r;
	
	/* Fonction GET LISTE */
	$fic = $fic.'public function getList()'.$r;
	$fic = $fic.'{'.$r;
	$fic = $fic.$t.'$'.$nomtab.'_liste = array();'.$r;
	$fic = $fic.$t.'$q = $this->_db->query("SELECT * FROM '.$nomtab.'");'.$r;
	$fic = $fic.$t.'while ($donnees = $q->fetch(PDO::FETCH_ASSOC))'.$r;
	$fic = $fic.$t.$t.'{$'.$nomtab.'_liste[] = new '.$nomtab.'($donnees);}'.$r;
	$fic = $fic.$t.'$return $'.$nomtab.'_liste;'.$r;
	$fic = $fic.'}'.$r;
	
	/* Fonction update */
	
	$fic = $fic.'public function update('.$nomtab.' $'.$nomtab.')'.$r;
	$fic = $fic.'{'.$r;
	
	$fic = $fic.$t.'$req = "UPDATE appe SET ";'.$r;
	
	while ($meschamps = $q->fetch(PDO::FETCH_ASSOC))
	{
		IF (substr($meschamps['Type'],0,3) == "Int")
			{$fic = $fic.$t.'$req = $req. "'.$meschamps['Field'].' = ".$'.$nomtab.'->'.$meschamps['Field'].'();';}
		IF (substr($meschamps['Type'],0,3) == "Var")
			{$ListeData = $ListeData.'".$'.$nomtab.'->'.strtolower($meschamps['Field']).'().",';}
		
	}
	
	$fic = $fic.$t.'$req = $req. " WHERE re'.$nomtab.' = ".$'.$nomtab.'->re'.$nomtab.'();'.$r;
	$fic = $fic.$t.'$q = $this->_db->prepare($req);'.$r;
	$fic = $fic.$t.'$q->execute();'.$r;
	$fic = $fic.'}'.$r;
	

		
		/*$req = $req. 'deappe = "'.$appe->deappe().'", ';*/
		
		

	
	
	/* Fonction set DB */
	$fic = $fic.'public function setDb(PDO $db)'.$r;
	$fic = $fic.'{'.$r;
	$fic = $fic.$t.'$this->_db = $db;'.$r;
	$fic = $fic.'}'.$r;
	
	/* Fin du fichier */
	$fic = $fic.$r.$r.'}';
	$fic = $fic.'?>';
	
	/* Enregistre le fichier */
	$monfichier = fopen($ficcla, 'w+');
	fputs($monfichier, $fic);
	fclose($monfichier);
	
}

?>
