<?php

require '../classe/cepv.class.php';
require '../dao/cepv.dao.php';

require '../index/conn_db.php';

$cepv_dao = new cepv_dao($db);

if ($_GET['mode'] == "del")
{
	$cepv_dao->delete($_GET['revins'],$_GET['recepa']);
}
else
{
	if (isset($_GET['revins']) and $_GET['revins'] <> 0 and isset($_POST['recepa']) AND $_POST['recepa'] <> 0)
	{
		
		echo $_GET["mode"];
		
		$donnees  = array('revins'=>$_GET['revins'],'recepa'=>$_POST['recepa'],'qtcepv'=>$_POST['qtcepv']);
		$cepv     = new cepv($donnees);

		if (isset($_GET["mode"]) AND $_GET["mode"] == "mod")
		{$cepv_dao->update($cepv);}
		
		if (isset($_GET["mode"]) AND $_GET["mode"] == "ajt")
		{$cepv_dao->add($cepv);}

	}
}

if (isset($_GET['ori']) and $_GET['ori'] = "vins.fiche")
{header('Location: ../fiche/vins.fiche.c.php?revins='.$_GET['revins']);}
else
{header('Location: ../liste/vins.liste.php');}

require '../index/Footer.php';

?>