<?php

require '../classe/pays.class.php';
require '../dao/pays.dao.php';

require '../index/conn_db.php';

$pays_dao = new pays_dao($db);

if ($_GET['mode'] == "del")
{
	$pays_dao->delete($_GET['repays']);
}
else
{
	if (isset($_POST['depays']) AND $_POST['depays'] <>"")
	{
		
		if (isset($_POST["repays"]) AND $_POST["repays"] <> 0)
		{
			$donnees  = array('repays'=>$_POST['repays'],'depays'=>$_POST['depays']);
			$pays     = new pays($donnees);
			$pays_dao->update($pays);
		}
		else
		{
			$donnees  = array('depays'=>$_POST['depays']);
			$pays     = new pays($donnees);
			$pays_dao->add($pays);
		}

	}
}

header('Location: ../liste/pays.liste.php');

require '../index/Footer.php';

?>