<?php

require '../classe/appe.class.php';
require '../dao/appe.dao.php';

require '../index/conn_db.php';

$appe_dao = new appe_dao($db);

if ($_GET['mode'] == "del")
{
	$appe_dao->delete($_GET['reappe']);
}
else
{
	if (isset($_POST['deappe']) AND $_POST['deappe'] <>"")
	{
		
		if (isset($_POST["reappe"]) AND $_POST["reappe"] <> 0)
		{
			$donnees  = array('reappe'=>$_POST['reappe'],
							  'deappe'=>$_POST['deappe'],
							  'reregi'=>$_POST['reregi']);
			$appe     = new appe($donnees);
			$appe_dao->update($appe);
		}
		else
		{
			$donnees  = array('deappe'=>$_POST['deappe'],'reregi'=>$_POST['reregi']);
			$appe     = new appe($donnees);
			$appe_dao->add($appe);
		}

	}
}

header('Location: ../liste/appe.liste.php');

require '../index/Footer.php';

?>