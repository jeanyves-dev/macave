<?php

require '../classe/mvsl.class.php';
require '../dao/mvsl.dao.php';

require '../index/conn_db.php';

$mvsl_dao = new mvsl_dao($db);

if ($_GET['mode'] == "del")
{
	$mvsl_dao->delete($_GET['remvsl']);
}
else
{
	if (isset($_GET['remvso']) AND $_GET['remvso'] <> 0 AND isset($_POST['rebout']) AND $_POST['rebout'] <> 0)
	{
		
		if (isset($_POST["remvsl"]) AND $_POST["remvsl"] <> 0)
		{
			$donnees  = array('remvsl'=>$_POST['remvsl'],'remvso'=>$_GET['remvso'],'rebout'=>$_POST['rebout'],'nomvsl'=>$_POST['nomvsl'],'qtmvsl'=>$_POST['qtmvsl'],'reappr'=>$_POST['reappr']);
			$mvsl     = new mvsl($donnees);
			$mvsl_dao->update($mvsl);
		}
		else
		{
			$donnees  = array('remvso'=>$_GET['remvso'],'rebout'=>$_POST['rebout'],'nomvsl'=>$_POST['nomvsl'],'qtmvsl'=>$_POST['qtmvsl'],'reappr'=>$_POST['reappr']);
			$mvsl     = new mvsl($donnees);
			$mvsl_dao->add($mvsl);
		}

	}
}

header('Location: ../liste/mvso.liste.php?remvso='.$_GET['remvso']);

require '../index/Footer.php';

?>