<?php

require '../classe/appr.class.php';
require '../dao/appr.dao.php';

require '../index/conn_db.php';

$appr_dao = new appr_dao($db);

if ($_GET['mode'] == "del")
{
	$appr_dao->delete($_GET['reappr']);
}
else
{
	if (isset($_POST['deappr']) AND $_POST['deappr'] <>"")
	{
		
		if (isset($_POST["reappr"]) AND $_POST["reappr"] <> 0)
		{
			$donnees  = array('reappr'=>$_POST['reappr'],'deappr'=>$_POST['deappr']);
			$appr     = new appr($donnees);
			$appr_dao->update($appr);
		}
		else
		{
			$donnees  = array('deappr'=>$_POST['deappr']);
			$appr     = new appr($donnees);
			$appr_dao->add($appr);
		}

	}
}

header('Location: ../liste/appr.liste.php');

require '../index/Footer.php';

?>