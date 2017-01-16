<?php

require '../classe/rece.class.php';
require '../dao/rece.dao.php';

require '../index/conn_db.php';

$rece_dao = new rece_dao($db);

if ($_GET['mode'] == "del")
{
	$rece_dao->delete($_GET['rerece']);
}
else
{
	if (isset($_POST['derece']) AND $_POST['derece'] <>"")
	{
		
		if (isset($_POST["rerece"]) AND $_POST["rerece"] <> 0)
		{
			$donnees  = array('rerece'=>$_POST['rerece'],
							  'derece'=>$_POST['derece'],
							  'replat'=>$_POST['replat'],
							  'rerect'=>$_POST['rerect']);
			$rece     = new rece($donnees);
			$rece_dao->update($rece);
		}
		else
		{
			$donnees  = array('derece'=>$_POST['derece'],
							  'replat'=>$_POST['replat'],
							  'rerect'=>$_POST['rerect']);
			$rece     = new rece($donnees);
			$rece_dao->add($rece);
		}

	}
}

header('Location: ../liste/rece.liste.php');

require '../index/Footer.php';

?>