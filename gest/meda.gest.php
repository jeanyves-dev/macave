<?php

require '../classe/meda.class.php';
require '../dao/meda.dao.php';
require '../classe/conc.class.php';
require '../dao/conc.dao.php';

require '../index/conn_db.php';

$meda_dao = new meda_dao($db);

if ($_GET['mode'] == "del")
{
	$meda_dao->delete($_GET['remeda']);
}
else
{
	if (isset($_POST['reconc']) AND $_POST['reconc'] <> "")
		{$reconc = $_POST['reconc'];}
	
	if (isset($_POST['deconc']) AND $_POST['deconc'] <> "")
	{
		$conc_dao = new conc_dao($db);
		$donnees  = array('deconc'=>$_POST['deconc']);
		$conc     = new conc($donnees);
		$conc_dao->add($conc);
		$conc     = $conc_dao->getLast();
		$reconc   = $conc->Reconc();
	}
	
	if ($reconc <> 0)
	{
		$donnees  = array('revins'=>$_GET['revins'],'reconc'=>$reconc,'nimeda'=>$_POST['nimeda'],'period'=>$_POST['period']);
		$meda     = new meda($donnees);
		$meda_dao->Add($meda);
	}
}

header('Location: ../fiche/vins.fiche.f.php?revins='.$_GET['revins']);

require '../index/Footer.php';

?>