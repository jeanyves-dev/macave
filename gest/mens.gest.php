<?php

require '../classe/mens.class.php';
require '../dao/mens.dao.php';
require '../index/conn_db.php';

$mens_dao = new mens_dao($db);

if ($_GET['mode'] == "del")
{
	$mens_dao->delete($_GET['remens']);
}
else
{
	if (isset($_POST['demens']) AND $_POST['demens'] <>"")
	{
		
		if (isset($_POST["remens"]) AND $_POST["remens"] <> 0)
		{
			$donnees  = array('remens'=>$_POST['remens'],
							  'demens'=>$_POST['demens'],
							  'remenu'=>$_POST['remenu'],
							  'limenu'=>$_POST['limenu'],
							  'norang'=>$_POST['norang']);
			$mens     = new mens($donnees);
			$mens_dao->update($mens);
		}
		else
		{
			$donnees  = array('demens'=>$_POST['demens'],'remenu'=>$_POST['remenu'],'limenu'=>$_POST['limenu'],'norang'=>$_POST['norang']);
			$mens     = new mens($donnees);
			$mens_dao->add($mens);
		}

	}
}

header('Location: ../liste/mens.liste.php');

require '../index/Footer.php';

?>