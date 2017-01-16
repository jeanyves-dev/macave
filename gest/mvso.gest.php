<?php

require '../classe/mvso.class.php';
require '../dao/mvso.dao.php';

require '../index/conn_db.php';

$mvso_dao = new mvso_dao($db);

$remvso = 0;

if ($_GET['mode'] == "del")
{
	$mvso_dao->delete($_GET['remvso']);
}
else
{
	if (isset($_POST['damvso']) AND $_POST['damvso'] <> "")
	{
		
		if (isset($_POST["remvso"]) AND $_POST["remvso"] <> 0)
		{
			$donnees  = array('remvso'=>$_POST['remvso'],
							  'damvso'=>$_POST['damvso'],
							  'nomvso'=>$_POST['nomvso']);
			$mvso     = new mvso($donnees);
			$mvso_dao->update($mvso);
			$remvso = $_POST['remvso'];
		}
		else
		{
			$donnees  = array('damvso'=>$_POST['damvso'],'nomvso'=>$_POST['nomvso']);
			$mvso     = new mvso($donnees);
			$mvso_dao->add($mvso);
			$mvso = $mvso_dao->getLast();
			$remvso = $mvso->Remvso();
		}
	}
}

$lien = 'Location: ../liste/mvso.liste.php?remvso='.$remvso;
header($lien);

require '../index/Footer.php';

?>