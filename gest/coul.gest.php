<?php

require '../classe/coul.class.php';
require '../dao/coul.dao.php';

require '../index/conn_db.php';

$coul_dao = new coul_dao($db);

if ($_GET['mode'] == "del")
{
	$coul_dao->delete($_GET['recoul']);
}
else
{
	if (isset($_POST['decoul']) AND $_POST['decoul'] <>"")
	{
		if (isset($_POST["recoul"]) AND $_POST["recoul"] <> 0)
		{
			ECHO $_POST['cocoul'];
			$donnees  = array('recoul'=>$_POST['recoul'],
							  'decoul'=>$_POST['decoul'],
							  'cocoul'=>$_POST['cocoul']);
			$coul     = new coul($donnees);
			echo $coul->Cocoul();
			$coul_dao->update($coul);
		}
		else
		{
			$donnees  = array('decoul'=>$_POST['decoul'],'cocoul'=>$_POST['cocoul']);
			$coul     = new coul($donnees);
			$coul_dao->add($coul);
		}
	}
}

header('Location: ../liste/coul.liste.php');

require '../index/Footer.php';

?>