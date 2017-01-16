<?php

require '../classe/typv.class.php';
require '../dao/typv.dao.php';

require '../index/conn_db.php';

$typv_dao = new typv_dao($db);

if ($_GET['mode'] == "del")
{
	$typv_dao->delete($_GET['retypv']);
}
else
{
	if (isset($_POST['detypv']) AND $_POST['detypv'] <>"")
	{
		
		if (isset($_POST["retypv"]) AND $_POST["retypv"] <> 0)
		{
			$donnees  = array('retypv'=>$_POST['retypv'],'detypv'=>$_POST['detypv']);
			$typv     = new typv($donnees);
			$typv_dao->update($typv);
		}
		else
		{
			$donnees  = array('detypv'=>$_POST['detypv']);
			$typv     = new typv($donnees);
			$typv_dao->add($typv);
		}

	}
}

header('Location: ../liste/typv.liste.php');

require '../index/Footer.php';

?>