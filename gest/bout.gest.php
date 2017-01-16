<?php

require '../classe/bout.class.php';
require '../classe/vins.class.php';
require '../classe/gaba.class.php';
require '../dao/bout.dao.php';
require '../dao/vins.dao.php';
require '../dao/gaba.dao.php';

require '../index/conn_db.php';

$bout_dao = new bout_dao($db);
$revins = 0;
$rebout = 0;

if ($_GET['mode'] == "del")
{
	$bout_dao->delete($_GET['rebout']);
}
else
{
	if (isset($_POST['revins']))
	{

		$revins = $_POST['revins'];
		$regaba = $_POST['regaba'];
		$anmile = $_POST['anmile'];
		$anapog = $_POST['anapog'];
		$anaboi = $_POST['anaboi'];
		$bonote = $_POST['bonote'];
		$degres = $_POST['degres'];
		
		if (isset($_POST["rebout"]) AND $_POST["rebout"] <> 0)
		{
			$donnees  = array('rebout'=>$_POST['rebout'],
							  'revins'=>$revins,
							  'regaba'=>$regaba,
							  'anmile'=>$anmile,
							  'anapog'=>$anapog,
							  'anaboi'=>$anaboi,
							  'bonote'=>$bonote,
							  'degres'=>$degres);
			$bout     = new bout($donnees);
			$bout_dao->update($bout);
			$rebout = $_POST['rebout'];
		}
		else
		{
			$donnees  = array('revins'=>$revins,
							  'regaba'=>$regaba,
							  'anmile'=>$anmile,
							  'anapog'=>$anapog,
							  'anaboi'=>$anaboi,
							  'bonote'=>$bonote,
							  'degres'=>$degres);
			$bout     = new bout($donnees);
			$bout_dao->add($bout);
			$rebout  = $bout_dao->getLastRef();
		}

	}

}

if (isset($_GET['ori']) and ($_GET['ori']) == 'vins.fiche')
	{header('Location: ../fiche/vins.fiche.a.php?revins='.$revins.'&rebout='.$rebout);}
elseif (isset($_GET['ori']) and ($_GET['ori']) == 'vins.liste')
	{header('Location: ../liste/vins.liste.php');}
elseif (isset($_GET['ori']) and ($_GET['ori']) == 'bout.liste')
	{header('Location: ../liste/bout.liste.php');}
else
	{header('Location: ../liste/vins.liste.php');}

require '../index/footer.php';

?>