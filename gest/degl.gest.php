<?php

require '../classe/degl.class.php';
require '../dao/degl.dao.php';

require '../index/conn_db.php';

$degl_dao = new degl_dao($db);

if ($_GET['mode'] == "del")
{
	$degl_dao->delete($_GET['redegl']);
}
else
{
	if (isset($_GET['redegu']) AND $_GET['redegu'] <> 0 AND isset($_POST['rebout']) AND $_POST['rebout'] <> 0)
	{
		
		if (isset($_POST["redegl"]) AND $_POST["redegl"] <> 0)
		{
			$donnees  = array('redegl'=>$_POST['redegl'],'redegu'=>$_GET['redegu'],'rebout'=>$_POST['rebout'],'odorat'=>$_POST['odorat'],'visuel'=>$_POST['visuel'],'bouche'=>$_POST['bouche'],'codegl'=>$_POST['codegl']);
			$degl     = new degl($donnees);
			$degl_dao->update($degl);
		}
		else
		{
			$donnees  = array('redegu'=>$_GET['redegu'],'rebout'=>$_POST['rebout'],'odorat'=>$_POST['odorat'],'visuel'=>$_POST['visuel'],'bouche'=>$_POST['bouche'],'codegl'=>$_POST['codegl']);
			$degl     = new degl($donnees);
			$degl_dao->add($degl);
		}

	}
}

header('Location: ../liste/degu.liste.php?redegu='.$_GET['redegu']);

require '../index/Footer.php';

?>