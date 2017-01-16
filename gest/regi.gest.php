<?php

require '../classe/regi.class.php';
require '../dao/regi.dao.php';

require '../index/conn_db.php';

$regi_dao = new regi_dao($db);

if ($_GET['mode'] == "del")
{
	$regi_dao->delete($_GET['reregi']);
}
else
{
	if (isset($_POST['deregi']) AND $_POST['deregi'] <>"")
	{
		
		if (isset($_POST["reregi"]) AND $_POST["reregi"] <> 0)
		{
			$donnees  = array('reregi'=>$_POST['reregi'],
							  'deregi'=>$_POST['deregi'],
							  'repays'=>$_POST['repays']);
			$regi     = new regi($donnees);
			$regi_dao->update($regi);
		}
		else
		{
			$donnees  = array('deregi'=>$_POST['deregi'],'repays'=>$_POST['repays']);
			$regi     = new regi($donnees);
			$regi_dao->add($regi);
		}

	}
}

header('Location: ../liste/regi.liste.php');

require '../index/Footer.php';

?>