<?php

require '../classe/casi.class.php';
require '../dao/casi.dao.php';

require '../index/conn_db.php';

$casi_dao = new casi_dao($db);

if ($_GET['mode'] == "del")
{
	$casi_dao->delete($_GET['recasi']);
}
else
{
	if (isset($_POST['decasi']) AND $_POST['decasi'] <>"")
	{
		
		if (isset($_POST["recasi"]) AND $_POST["recasi"] <> 0)
		{
			$donnees  = array('recasi'=>$_POST['recasi'],
							  'decasi'=>$_POST['decasi'],
							  'recolo'=>$_POST['recolo'],
							  'nbrlig'=>$_POST['nbrlig'],
							  'nbrcol'=>$_POST['nbrcol']);
			$casi     = new casi($donnees);
			$casi_dao->update($casi);
		}
		else
		{
			$donnees  = array('decasi'=>$_POST['decasi'],'recolo'=>$_POST['recolo'],'nbrlig'=>$_POST['nbrlig'],'nbrcol'=>$_POST['nbrcol']);
			$casi     = new casi($donnees);
			$casi_dao->add($casi);
		}

	}
}

header('Location: ../liste/casi.liste.php');

require '../index/Footer.php';

?>