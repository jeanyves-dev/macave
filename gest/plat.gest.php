<?php

require '../classe/plat.class.php';
require '../dao/plat.dao.php';

require '../index/conn_db.php';

$plat_dao = new plat_dao($db);

if ($_GET['mode'] == "del")
{
	$plat_dao->delete($_GET['replat']);
}
else
{
	if (isset($_POST['deplat']) AND $_POST['deplat'] <>"")
	{
		
		if (isset($_POST["replat"]) AND $_POST["replat"] <> 0)
		{
			$donnees  = array('replat'=>$_POST['replat'],'deplat'=>$_POST['deplat']);
			$plat     = new plat($donnees);
			$plat_dao->update($plat);
		}
		else
		{
			$donnees  = array('deplat'=>$_POST['deplat']);
			$plat     = new plat($donnees);
			$plat_dao->add($plat);
		}

	}
}

header('Location: ../liste/plat.liste.php');

require '../index/Footer.php';

?>