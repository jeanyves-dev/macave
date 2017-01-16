<?php

require '../index/rangement.php';

require '../classe/vins.class.php';
require '../classe/bout.class.php';
require '../classe/empl.class.php';
require '../classe/colo.class.php';
require '../classe/casi.class.php';
require '../classe/rang.class.php';
require '../classe/enso.class.php';
require '../dao/vins.dao.php';
require '../dao/bout.dao.php';
require '../dao/empl.dao.php';
require '../dao/colo.dao.php';
require '../dao/casi.dao.php';
require '../dao/rang.dao.php';
require '../dao/enso.dao.php';
require '../index/conn_db.php';

$bout_dao = new bout_dao($db);
$empl_dao = new empl_dao($db);
$colo_dao = new colo_dao($db);
$casi_dao = new casi_dao($db);
$rang_dao = new rang_dao($db);
$enso_dao = new enso_dao($db);

$rebout = 0;
$reempl = 0;
$recolo = 0;
$recasi = 0;
$poslig = 0;
$poscol = 0;

/* Récupère les paramètres */
if ((isset($_POST['rebout'])) and ($_POST['rebout'] <> 0))
{$rebout = $_POST['rebout'];}
if ((isset($_GET['reempl'])) and ($_GET['reempl'] <> 0))
{$reempl = $_GET['reempl'];}

/* Positionne sur la bouteille */
$bout = $bout_dao->get($rebout);

/* Récupère la quantité en stock */
$qtstock = $bout->QtStock($db);

$mescolo = $colo_dao->getListeEmpl($reempl);
foreach ($mescolo as $uncolo)
{
	$mescasi = $casi_dao->getListeColo($uncolo->Recolo());
	foreach ($mescasi as $uncasi)
	{
		for ($i = 1; $i <= $uncasi->nbrlig() ; $i++)
		{
			echo '<tr>';
			for ($j = 1; $j <= $uncasi->Nbrcol() ; $j++)
			{
				if (isset($_POST[$uncolo->Recolo().'&'.$uncasi->Recasi().'&'.$i.'&'.$j]))
				{
					if ($qtstock >$bout->QtRang($db))
					{
						$donnees  = array('rebout'=>$rebout,'recasi'=>$uncasi->Recasi(),'poslig'=>$i,'poscol'=>$j);
						$rang     = new rang($donnees);
						$rang_dao->add($rang);
					}
				}
			}
			echo '</tr>';
		}
		echo '</table>';
	}
	
	echo '</td>';
}

header('Location: ../rangement/rang.php');

	
?>