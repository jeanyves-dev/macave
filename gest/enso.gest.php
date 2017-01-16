<?php
require '../index/header.php';

require '../classe/vins.class.php';
require '../classe/enso.class.php';
require '../classe/bout.class.php';
require '../classe/appr.class.php';
require '../classe/four.class.php';
require '../dao/vins.dao.php';
require '../dao/enso.dao.php';
require '../dao/bout.dao.php';
require '../dao/appr.dao.php';
require '../dao/four.dao.php';

require '../index/conn_db.php';

$enso_dao = new enso_dao($db);
$rebout = 0;

if ($_GET['mode'] == "del")
{
	$bout_dao->delete($_GET['reenso']);
}
else
{
	if (isset($_POST['rebout']))
	{
		$rebout = $_POST['rebout'];
		$daenso = $_POST['daenso'];
		$qtenso = $_POST['qtenso'];
		$seenso = $_POST['seenso'];
		$refour = $_POST['refour'];
		$reappr = $_POST['reappr'];
		
		$bout_dao = new bout_dao($db);
		$bout = $bout_dao->get($_POST['rebout']);
		
		if (isset($_POST['defour']) AND $_POST['defour'] <> "")
		{
			$four_dao = new four_dao($db);
			$donnees  = array('defour'=>$_POST['defour']);
			$four     = new four($donnees);
			$four_dao->add($four);
			$four     = $four_dao->getLast();
			$refour   = $four->Refour();
		}
		
		if (isset($_POST["reenso"]) AND $_POST["reenso"] <> 0)
		{
			$donnees  = array('reenso'=>$_POST['reenso'],
							  'rebout' =>$rebout,
							  'daenso' =>$daenso,
							  'qtenso' =>$qtenso,
							  'seenso' =>$seenso,
							  'refour' =>$refour,
							  'reappr' =>$reappr);
			$enso     = new enso($donnees);
			$enso_dao->update($enso);
		}
		else
		{
			$donnees  = array('rebout' =>$rebout,
							  'daenso' =>$daenso,
							  'qtenso' =>$qtenso,
							  'seenso' =>$seenso,
							  'refour' =>$refour,
							  'reappr' =>$reappr);
			$enso     = new enso($donnees);
			$enso_dao->add($enso);
		}

	}
}

if (isset($_GET['ori']) AND ($_GET['ori']) == "vins.fiche.a")
{header('Location: ../fiche/vins.fiche.a.php?revins='.$bout->Revins().'&rebout='.$rebout);}
else
{header('Location: ../liste/bout.liste.php');}



require '../index/Footer.php';

?>