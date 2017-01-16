<?php

require '../classe/acco.class.php';
require '../dao/acco.dao.php';

require '../index/conn_db.php';

$acco_dao = new acco_dao($db);

if ($_GET['mode'] == "del")
{
	$acco_dao->delete($_GET['reacco']);
}
else
{
	if (isset($_POST['revins']) AND $_POST['revins'] <>"" AND isset($_POST['replat']) AND $_POST['replat'] <>"")
	{
		
		if (isset($_POST["reacco"]) AND $_POST["reacco"] <> 0)
		{
			$donnees  = array('reacco'=>$_POST['reacco'],
							  'revins'=>$_POST['revins'],
							  'replat'=>$_POST['replat']);
			$acco     = new acco($donnees);
			$acco_dao->update($acco);
		}
		else
		{
			$donnees  = array('revins'=>$_POST['revins'],
							  'replat'=>$_POST['replat']);
			$acco     = new acco($donnees);
			$acco_dao->add($acco);
		}

	}
}

header('Location: ../liste/acco.liste.php');

require '../index/Footer.php';

?>