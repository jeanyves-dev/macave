<?php

require '../classe/rdvc.class.php';
require '../dao/rdvc.dao.php';

require '../index/conn_db.php';

$rdvc_dao = new rdvc_dao($db);

if ($_GET['mode'] == "del")
{
	$rdvc_dao->delete($_GET['rerdvc']);
}
else
{
	if (isset($_POST['derdvc']) AND $_POST['derdvc'] <>"")
	{
		
		if (isset($_POST["rerdvc"]) AND $_POST["rerdvc"] <> 0)
		{
			$donnees  = array('rerdvc'=>$_POST['rerdvc'],'derdvc'=>$_POST['derdvc']);
			$rdvc     = new rdvc($donnees);
			$rdvc_dao->update($rdvc);
		}
		else
		{
			$donnees  = array('derdvc'=>$_POST['derdvc']);
			$rdvc     = new rdvc($donnees);
			$rdvc_dao->add($rdvc);
		}

	}
}

header('Location: ../liste/rdvc.liste.php');

require '../index/Footer.php';

?>