<?php

require '../classe/empl.class.php';
require '../dao/empl.dao.php';

require '../index/conn_db.php';

$empl_dao = new empl_dao($db);

if ($_GET['mode'] == "del")
{
	$empl_dao->delete($_GET['reempl']);
}
else
{
	if (isset($_POST['deempl']) AND $_POST['deempl'] <>"")
	{
		
		if (isset($_POST["reempl"]) AND $_POST["reempl"] <> 0)
		{
			$donnees  = array('reempl'=>$_POST['reempl'],'deempl'=>$_POST['deempl']);
			$empl     = new empl($donnees);
			$empl_dao->update($empl);
		}
		else
		{
			$donnees  = array('deempl'=>$_POST['deempl']);
			$empl     = new empl($donnees);
			$empl_dao->add($empl);
		}

	}
}

header('Location: ../liste/empl.liste.php');

require '../index/Footer.php';

?>