<?php

require '../classe/tbse.class.php';
require '../dao/tbse.dao.php';
require '../index/conn_db.php';

$tbse_dao = new tbse_dao($db);

if ($_GET['mode'] == "del")
{
	$tbse_dao->delete($_GET['retbse']);
}
else
{
	if (isset($_POST['detbse']) AND $_POST['detbse'] <> "")
	{
		
		if (isset($_POST["retbse"]) AND $_POST["retbse"] <> 0)
		{
			$donnees  = array('retbse'=>$_POST['retbse'],'detbse'=>$_POST['detbse'],'codtab'=>$_POST['codtab']);
			$tbse     = new tbse($donnees);
			$tbse_dao->update($tbse);
		}
		else
		{
			$donnees  = array('detbse'=>$_POST['detbse'],'codtab'=>$_POST['codtab'],);
			$tbse     = new tbse($donnees);
			$tbse_dao->add($tbse);
		}

	}
}

header('Location: ../liste/tbse.liste.php');

require '../index/Footer.php';

?>