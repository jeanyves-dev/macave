<?php

require '../classe/cepa.class.php';
require '../dao/cepa.dao.php';

require '../index/conn_db.php';

$cepa_dao = new cepa_dao($db);

if ($_GET['mode'] == "del")
{
	$cepa_dao->delete($_GET['recepa']);
}
else
{
	if (isset($_POST['decepa']) AND $_POST['decepa'] <>"")
	{
		
		if (isset($_POST["recepa"]) AND $_POST["recepa"] <> 0)
		{
			$donnees  = array('recepa'=>$_POST['recepa'],'decepa'=>$_POST['decepa']);
			$cepa     = new cepa($donnees);
			$cepa_dao->update($cepa);
		}
		else
		{
			$donnees  = array('decepa'=>$_POST['decepa']);
			$cepa     = new cepa($donnees);
			$cepa_dao->add($cepa);
		}

	}
}

header('Location: ../liste/cepa.liste.php');

require '../index/Footer.php';

?>