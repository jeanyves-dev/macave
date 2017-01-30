<?php

require 'index/conn_db.php';

if (file_exists('version/novers.txt') == FALSE)
{
	
	echo "test";
	/* novers.txt n'existe pas, on créer la base de données à vide et on initialise la version à 1 */
	$fic = fopen('version/macave.sql', 'r');
	
	while (!feof($fic))
		{$req = $req.fgets($fic);}
	
	$q = $db->prepare($req);
	$q->execute();
	$q->closeCursor();
	fclose($fic);
		
	$fic = fopen('version/novers.txt', 'a+');
	fputs($fic, '01000');
	fclose($fic);
	
	$novers = '01000';
	
}
else
{
	/* novers.txt existe on lit la valeur du numéro de version */
	$fic = fopen('version/novers.txt', 'r');
	$novers = fgets($fic);
	fclose($fic);
}

/* Boucle sur novers jusqu'à ce qu'on arrive à la dernière version */
while ($novers <> "01010")
{
	$novers = update_bdd($novers,$db);
}

/* Effectue une condition multiple pour chaque numéro de version */
function update_bdd($pi_novers,$pi_db)
{

	switch ($pi_novers)
	{
		case "01000":
			$novers = '01010';
			update(pi_novers, $novers,$pi_db);
			break;

			
	}

	return $novers;

}

/* Met à jour la base de données et met à jour le fichier novers.txt */
function update($pi_annval, $pi_nouval,$pi_db)
{

	$fic = fopen('version/'.$pi_nouval.'.sql', 'r');
	while (!feof($fic))
		{$req = $req.fgets($fic);}
	$q = $pi_db->prepare($req);
	$q->execute();
	$q->closeCursor();	
	fclose($fic);
	
	$fic = fopen('version/novers.txt', 'a+');
	ftruncate($fic,0);
	fputs($fic, $pi_nouval);
	fclose($fic);

}



?>