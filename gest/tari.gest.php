<?php

require '../classe/tari.class.php';
require '../dao/tari.dao.php';
require '../classe/bout.class.php';
require '../dao/bout.dao.php';


require '../index/conn_db.php';

$tari_dao = new tari_dao($db);

if ($_GET['mode'] == "del")
{
	$tari_dao->delete($_GET['retari']);
}
else
{
	if (isset($_POST['mtbout']) AND $_POST['mtbout'] <> 0)
	{
		if (isset($_POST["retari"]) AND $_POST["retari"] <> 0)
		{
			$donnees  = array('retari'=>$_POST['retari'],'rebout'=>$_POST['rebout'],'mtbout'=>$_POST['mtbout'],'datari'=>$_POST['datari'],'tytari'=>$_POST['tytari']);
			$tari     = new tari($donnees);
			$tari_dao->update($tari);
		}
		else
		{
			$donnees  = array('rebout'=>$_POST['rebout'],'mtbout'=>$_POST['mtbout'],'datari'=>$_POST['datari'],'tytari'=>$_POST['tytari']);
			$tari     = new tari($donnees);
			$tari_dao->add($tari);
		}
	}
}

$bout_dao = new bout_dao($db);
$bout = $bout_dao->get($_POST['rebout']);

$lien = 'Location: ../fiche/vins.fiche.a.php?revins='.$bout->Revins().'&rebout='.$bout->Rebout();
echo $lien;

header($lien);

require '../index/Footer.php';

?>