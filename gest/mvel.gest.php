<?php

require '../classe/mvel.class.php';
require '../dao/mvel.dao.php';
require '../classe/tari.class.php';
require '../dao/tari.dao.php';


require '../index/conn_db.php';

$mvel_dao = new mvel_dao($db);

if ($_GET['mode'] == "del")
{
	$mvel_dao->delete($_GET['remvel']);
}
else
{
	if (isset($_GET['remven']) AND $_GET['remven'] <> 0 AND isset($_POST['rebout']) AND $_POST['rebout'] <> 0)
	{
		
		if (isset($_POST["remvel"]) AND $_POST["remvel"] <> 0)
		{
			$donnees  = array('remvel'=>$_POST['remvel'],'remven'=>$_GET['remven'],'rebout'=>$_POST['rebout'],'nomvel'=>$_POST['nomvel'],'qtmvel'=>$_POST['qtmvel']);
			$mvel     = new mvel($donnees);
			$mvel_dao->update($mvel);
		}
		else
		{
			$donnees  = array('remven'=>$_GET['remven'],'rebout'=>$_POST['rebout'],'nomvel'=>$_POST['nomvel'],'qtmvel'=>$_POST['qtmvel']);
			$mvel     = new mvel($donnees);
			$mvel_dao->add($mvel);
			$tarif    = array('rebout'=>$_POST['rebout'],'mtbout'=>$_POST['mtbout'],'datari'=>date("m.d.y"),'tytari'=>"01");
			$tari     = new tari($tarif);
			$tari_dao = new tari_dao($db);
			$tari_dao->add($tari);
		}

	}
}

header('Location: ../liste/mven.liste.php?remven='.$_GET['remven']);

require '../index/Footer.php';

?>