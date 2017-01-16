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

/* Initialise l'emplacement en cours */
if ((isset($_GET['reempl']) == FALSE) or ($_GET['reempl'] == 0))
{
	$unempl = $empl_dao->getFirst();
	$reempl = $unempl->Reempl();
}
else
{$reempl = $_GET['reempl'];}

/* Formulaire pour ranger les bouteilles */
echo '<form action="../rangement/Rang.ajt.php?reempl='.$reempl.'" method="post">';

/* Table avec les bouteilles */
echo '<span>';
echo '<table border=1>';
$mesbout = $bout_dao->getList();
foreach ($mesbout as $unbout)
{
	echo '<tr>';
	echo '<td><input type= "radio" name="rebout" value=',$unbout->Rebout(),'></td>';
	echo '<td>'.$unbout->Rebout().'</td>';
	echo '<td>'.$unbout->Devins($db).'</td>';
	echo '<td>'.$unbout->QtStock($db).'</td>';
	echo '<td>'.$unbout->QtRang($db).'</td>';
	echo '</tr>';
}
echo '</table>';
echo '</span>';
echo '<span>';

/* Table avec les emplacements */
echo '<table border=1>';
echo '<tr>';
$mesempl = $empl_dao->getList();
foreach ($mesempl as $unempl)
{
	echo '<td><a href = "../rangement/rang.php?reempl='.$unempl->Reempl().'">'.$unempl->Deempl().'</a></td>';
}
echo '</tr>';
echo '</table>';

/* Table rangement correspondant à l'emplacement choisi */
echo '<table border=1>';
echo '<tr>';

$mescolo = $colo_dao->getListeEmpl($reempl);
foreach ($mescolo as $uncolo)
{
	echo '<td>';
	echo $uncolo->Decolo().'<br>';
	
	$mescasi = $casi_dao->getListeColo($uncolo->Recolo());
	foreach ($mescasi as $uncasi)
	{
		echo '<table border=1>';
		for ($i = 1; $i <= $uncasi->nbrlig() ; $i++)
		{
			echo '<tr>';
			for ($j = 1; $j <= $uncasi->Nbrcol() ; $j++)
			{
				echo '<td>';
				$rang = $rang_dao->getCasi($uncasi->Recasi(),$i,$j);
				if ($rang == "")
				{echo '<input type="checkbox" name="'.$uncolo->Recolo().'&'.$uncasi->Recasi().'&'.$i.'&'.$j.'"/>';}
				else
				{echo $rang->Rebout();}
				echo '</td>';
			}
			echo '</tr>';
		}
		echo '</table>';
	}
	
	echo '</td>';
}

echo '</tr>';
echo '</table>';
echo '</span>';
echo '<input type="submit" value="Valider" name="Valider" />';
echo '</form>';

?>