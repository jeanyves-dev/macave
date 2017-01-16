<?php

/* Stat par classement */

require '../index/header.php';

require '../classe/tbsd.class.php';
require '../dao/tbsd.dao.php';
require '../classe/mvel.class.php';
require '../dao/mvel.dao.php';
require 'stat.dao.php';

require '../index/conn_db.php';

$tbsd_dao = new tbsd_dao($db);
$mestbsd = $tbsd_dao->getList("canapp");

$stat_dao = new stat_dao($db);

echo '<p><a href="stat11.php?tystat=1">Table</a> - <a href="stat11.php?tystat=2">Histogramme</a></p>';

IF (isset($_GET["tystat"]) AND $_GET["tystat"] == "1")
{
	echo '<table border = 1>';
	echo '<tr><td class="TitreListe">Désignation</td><td class="TitreListe">Quantité</td></tr>';
	foreach ($mestbsd as $untbsd)
	{
		$res = $stat_dao->getStat11($untbsd->Retbsd());
		echo '<tr>';
		echo '<td class="CelluleListe">', $untbsd->Detbsd(), '</td>';
		echo '<td class="CelluleListe">', $res, '</td>';
		echo '</tr>';
	}
	echo '</table>';
}

IF (isset($_GET["tystat"]) AND $_GET["tystat"] == "2")
{
	$mvel_dao = new mvel_dao($db);
	$EntrerTotal = $mvel_dao->getEntrTotal();

	echo '<table border = 1 width=100%>';
	echo '<tr><td class="TitreListe">Désignation</td><td class="TitreListe">Quantité</td></tr>';
	foreach ($mestbsd as $untbsd)
	{
		$nbr = $stat_dao->getStat11($untbsd->Retbsd());
		$res = ($nbr/$EntrerTotal*100)*10;
		echo '<tr>';
		echo '<td class="tdStatHisto1">', $untbsd->Detbsd(), '</td>';
		echo '<td class="tdStatHisto2"><div style="background-color:red;width:'.$res.'px;">'.$nbr.'</div></td>';
		echo '</tr>';
	}
	echo '</table>';
}

require '../index/Footer.php';

?>
