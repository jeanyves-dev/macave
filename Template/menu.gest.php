<?php

require '../classe/menu.class.php';
require '../dao/menu.dao.php';

require '../index/conn_db.php';

$menu_dao = new menu_dao($db);

if ($_GET['mode'] == "del")
{
	$menu_dao->delete($_GET['remenu']);
}
else
{
	if (isset($_POST['demenu']) AND $_POST['demenu'] <>"")
	{
		
		if (isset($_POST["remenu"]) AND $_POST["remenu"] <> 0)
		{
			$donnees  = array('remenu'=>$_POST['remenu'],'demenu'=>$_POST['demenu']);
			$menu     = new menu($donnees);
			$menu_dao->update($menu);
		}
		else
		{
			$donnees  = array('demenu'=>$_POST['demenu']);
			$menu     = new menu($donnees);
			$menu_dao->add($menu);
		}

	}
}

header('Location: ../liste/menu.liste.php');

require '../index/Footer.php';

?>