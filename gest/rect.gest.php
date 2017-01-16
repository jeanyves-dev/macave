<?php

require '../classe/rect.class.php';
require '../dao/rect.dao.php';

require '../index/conn_db.php';

$rect_dao = new rect_dao($db);

if ($_GET['mode'] == "del")
{
	$rect_dao->delete($_GET['rerect']);
}
else
{
	if (isset($_POST['derect']) AND $_POST['derect'] <>"")
	{
		
		if (isset($_POST["rerect"]) AND $_POST["rerect"] <> 0)
		{
			$donnees  = array('rerect'=>$_POST['rerect'],'derect'=>$_POST['derect']);
			$rect     = new rect($donnees);
			$rect_dao->update($rect);
		}
		else
		{
			$donnees  = array('derect'=>$_POST['derect']);
			$rect     = new rect($donnees);
			$rect_dao->add($rect);
		}

	}
}

header('Location: ../liste/rect.liste.php');

require '../index/Footer.php';

?>