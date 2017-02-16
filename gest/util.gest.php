<?php

require '../classe/util.class.php';
require '../dao/util.dao.php';
require '../index/conn_db.php';

$util_dao = new util_dao($db);

if ($_GET['mode'] == "del")
{
	$util_dao->delete($_GET['inutil']);
}
else
{
	if (isset($_POST['noutil']) AND $_POST['noutil'] <> "")
	{
		
		if (isset($_GET["inutil"]) AND $_GET["inutil"] <> 0)
		{
			$donnees  = array('inutil'=>$_POST['inutil'],
							  'mputil'=>$_POST['mputil'],
							  'noutil'=>$_POST['noutil'],
							  'prutil'=>$_POST['prutil']);
			$util     = new util($donnees);
			$util_dao->update($util);
		}
		else
		{
			$donnees  = array('inutil'=>$_POST['inutil'],
							  'mputil'=>$_POST['mputil'],
							  'noutil'=>$_POST['noutil'],
							  'prutil'=>$_POST['prutil']);
			$util     = new util($donnees);
			$util_dao->add($util);
		}

	}
}

header('Location: ../liste/util.liste.php');

require '../index/footer.php';

?>