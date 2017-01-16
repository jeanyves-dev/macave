<?php

require '../classe/degu.class.php';
require '../dao/degu.dao.php';

require '../index/conn_db.php';

$degu_dao = new degu_dao($db);

$redegu = 0;

if ($_GET['mode'] == "del")
{
	$degu_dao->delete($_GET['redegu']);
}
else
{
	if (isset($_POST['dadegu']) AND $_POST['dadegu'] <> "")
	{
		
		if (isset($_POST["redegu"]) AND $_POST["redegu"] <> 0)
		{
			$donnees  = array('redegu'=>$_POST['redegu'],
							  'dadegu'=>$_POST['dadegu'],
							  'nodegu'=>$_POST['nodegu']);
			$degu     = new degu($donnees);
			$degu_dao->update($degu);
			$redegu = $_POST['redegu'];
		}
		else
		{
			$donnees  = array('dadegu'=>$_POST['dadegu'],'nodegu'=>$_POST['nodegu']);
			$degu     = new degu($donnees);
			$degu_dao->add($degu);
			$degu = $degu_dao->getLast();
			$redegu = $degu->Redegu();
		}
	}
}

$lien = 'Location: ../liste/degu.liste.php?redegu='.$redegu;
header($lien);

require '../index/Footer.php';

?>