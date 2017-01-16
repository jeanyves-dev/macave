<?php

require '../classe/colo.class.php';
require '../dao/colo.dao.php';

require '../index/conn_db.php';

$colo_dao = new colo_dao($db);

if ($_GET['mode'] == "del")
{
	$colo_dao->delete($_GET['recolo']);
}
else
{
	if (isset($_POST['decolo']) AND $_POST['decolo'] <>"")
	{
		
		if (isset($_POST["recolo"]) AND $_POST["recolo"] <> 0)
		{
			$donnees  = array('recolo'=>$_POST['recolo'],
							  'decolo'=>$_POST['decolo'],
							  'reempl'=>$_POST['reempl']);
			$colo     = new colo($donnees);
			$colo_dao->update($colo);
		}
		else
		{
			$donnees  = array('decolo'=>$_POST['decolo'],'reempl'=>$_POST['reempl']);
			$colo     = new colo($donnees);
			$colo_dao->add($colo);
		}

	}
}

header('Location: ../liste/colo.liste.php');

require '../index/Footer.php';

?>