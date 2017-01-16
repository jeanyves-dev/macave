<?php

require '../classe/conc.class.php';
require '../dao/conc.dao.php';

require '../index/conn_db.php';

$conc_dao = new conc_dao($db);

if ($_GET['mode'] == "del")
{
	$conc_dao->delete($_GET['reconc']);
}
else
{
	if (isset($_POST['deconc']) AND $_POST['deconc'] <>"")
	{
		
		if (isset($_POST["reconc"]) AND $_POST["reconc"] <> 0)
		{
			$donnees  = array('reconc'=>$_POST['reconc'],'deconc'=>$_POST['deconc']);
			$conc     = new conc($donnees);
			$conc_dao->update($conc);
		}
		else
		{
			$donnees  = array('deconc'=>$_POST['deconc']);
			$conc     = new conc($donnees);
			$conc_dao->add($conc);
		}

	}
}

header('Location: ../liste/conc.liste.php');

require '../index/Footer.php';

?>