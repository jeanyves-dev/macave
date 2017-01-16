<?php

require '../classe/mven.class.php';
require '../dao/mven.dao.php';
require '../classe/four.class.php';
require '../dao/four.dao.php';
require '../classe/tbsd.class.php';
require '../dao/tbsd.dao.php';

require '../index/conn_db.php';

$mven_dao = new mven_dao($db);

$remven = 0;

if ($_GET['mode'] == "del")
{
	$mven_dao->delete($_GET['remven']);
}
else
{
	if (isset($_POST['damven']) AND $_POST['damven'] <> "")
	{
	
		$refour = $_POST['refour'];
		if (isset($_POST['defour']) AND $_POST['defour'] <> "")
		{
			$four_dao = new four_dao($db);
			$donnees  = array('defour'=>$_POST['defour']);
			$four     = new four($donnees);
			$four_dao->add($four);
			$four     = $four_dao->getLast();
			$refour   = $four->Refour();
		}
		
		if (isset($_POST["remven"]) AND $_POST["remven"] <> 0)
		{
			$donnees  = array('remven'=>$_POST['remven'],
							  'damven'=>$_POST['damven'],
							  'refour'=>$refour,
							  'nomven'=>$_POST['nomven'],
							  'canapp'=>$_POST['canapp']);
			$mven     = new mven($donnees);
			$mven_dao->update($mven);
			$remven = $_POST['remven'];
		}
		else
		{
			$donnees  = array('damven'=>$_POST['damven'],'refour'=>$refour,'nomven'=>$_POST['nomven'],'canapp'=>$_POST['canapp']);
			$mven     = new mven($donnees);
			$mven_dao->add($mven);
			$mven = $mven_dao->getLast();
			$remven = $mven->Remven();
		}

	}
}

$lien = 'Location: ../liste/mven.liste.php?remven='.$remven;
header($lien);

require '../index/Footer.php';

?>