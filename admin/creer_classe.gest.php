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
	$ficcla = '../genere/'.$nomtab.'.class.php';

	/* entête du fichier */
	$fic = '<?php'.$r.$r;
	$fic = $fic.'class '.$nomtab.$r;
	$fic = $fic.'{'.$r;
	
	/* Récupère la liste des champs de la table */
	$q = $db->query("SHOW COLUMNS FROM ".$nomtab);
	while ($meschamps = $q->fetch(PDO::FETCH_ASSOC))
	{
		$fic = $fic.$t.'private $_'.strtolower($meschamps['Field']).';'.$r;
	}
	
	$fic = $fic.$r;
	
	/* Constructeur */
	$fic = $fic.'public function __construct(array $donnees)'.$r;
	$fic = $fic.'{'.$r;
	$fic = $fic.$t.'$this->hydrate($donnees);'.$r;
	$fic = $fic.'}'.$r.$r;
	
	/* Fonction hydrate */
	$fic = $fic.'public function hydrate(array $donnees)'.$r;
	$fic = $fic.'{'.$r;
	$fic = $fic.$t.'foreach ($donnees as $key => $value)'.$r;
	$fic = $fic.$t.'{'.$r;
	$fic = $fic.$t.$t.'$method = "set".ucfirst($key);'.$r;
	$fic = $fic.$t.$t.'if (method_exists($this, $method))'.$r;
	$fic = $fic.$t.$t.'{'.$r;
	$fic = $fic.$t.$t.$t.'$this->$method($value);'.$r;
	$fic = $fic.$t.$t.'}'.$r;
	$fic = $fic.$t.'}'.$r;
	$fic = $fic.'}'.$r;
	
	/* Getteur */
	$q = $db->query("SHOW COLUMNS FROM ".$nomtab);
	while ($meschamps = $q->fetch(PDO::FETCH_ASSOC))
	{
		$fic = $fic.'public function '.strtolower($meschamps['Field']).'(){return $this->_'.strtolower($meschamps['Field']).';}'.$r;
	}
	
	$fic = $fic.$r;
	
	/* Setteur */
	$q = $db->query("SHOW COLUMNS FROM ".$nomtab);
	while ($meschamps = $q->fetch(PDO::FETCH_ASSOC))
	{
		$fic = $fic.'public function set'.strtolower($meschamps['Field']).'($un'.strtolower($meschamps['Field']).'){$this->_'.strtolower($meschamps['Field']).' = $un'.strtolower($meschamps['Field']).';}'.$r;
	}
	
	/* Fin du fichier */
	$fic = $fic.$r.$r.'}';
	$fic = $fic.$r.$r.'?>';
	
	/* Enregistre le fichier */
	$monfichier = fopen($ficcla, 'w+');
	fputs($monfichier, $fic);
	fclose($monfichier);
	
}

?>
