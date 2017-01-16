<?php

require '../classe/clas.class.php';
require '../dao/clas.dao.php';

require '../index/conn_db.php';

$clas_dao = new clas_dao($db);

if ($_GET['mode'] == "del")
{
	$clas_dao->delete($_GET['reclas']);
}
else
{
	if (isset($_POST['declas']) AND $_POST['declas'] <>"")
	{
		
		if (isset($_POST["reclas"]) AND $_POST["reclas"] <> 0)
		{
			$donnees  = array('reclas'=>$_POST['reclas'],'declas'=>$_POST['declas']);
			$clas     = new clas($donnees);
			$clas_dao->update($clas);
		}
		else
		{
			$donnees  = array('declas'=>$_POST['declas']);
			$clas     = new clas($donnees);
			$clas_dao->add($clas);
		}

	}
}

header('Location: ../liste/clas.liste.php');

require '../index/Footer.php';

?>