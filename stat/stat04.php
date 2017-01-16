<?php

/* Stat par appe */

require '../index/header.php';

/*require '../classe/mvel.class.php';
require '../dao/mvel.dao.php';
require '../classe/mven.class.php';
require '../dao/mven.dao.php';*/

require 'stat.dao.php';

require '../index/conn_db.php';

$stat_dao = new stat_dao($db);
$messtat = $stat_dao->getStat4();

$stat_dao = new stat_dao($db);

echo '<p><a href="stat04.php?tystat=1">Table</a> - <a href="stat04.php?tystat=2">Histogramme</a></p>';

IF (isset($_GET["tystat"]) AND $_GET["tystat"] == "1")
{
	echo '<table border = 1>';
	echo '<tr><td class="TitreListe">Désignation</td><td class="TitreListe">Quantité</td></tr>';
	foreach ($messtat as $unstat)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unstat['ann'], '</td>';
		echo '<td class="CelluleListe">', $unstat['nbr'], '</td>';
		echo '</tr>';
	}
	echo '</table>';
}

/*IF (isset($_GET["tystat"]) AND $_GET["tystat"] == "2")
{
	$mvel_dao = new mvel_dao($db);
	$mvsl_dao = new mvsl_dao($db);
	$StockTotal = $mvel_dao->getEntrTotal() - $mvsl_dao->getSortTotal();

	echo '<table border = 1 width=100%>';
	echo '<tr><td class="TitreListe">Désignation</td><td class="TitreListe">Quantité</td></tr>';
	foreach ($mesappe as $unappe)
	{
		$nbr = $stat_dao->getStat3($unappe->Reappe());
		$res = ($nbr/$StockTotal*100)*10;
		echo '<tr>';
		echo '<td class="tdStatHisto1">', $unappe->Deappe(), '</td>';
		echo '<td class="tdStatHisto2"><div style="background-color:red;width:'.$res.'px;">'.$nbr.'</div></td>';
		echo '</tr>';
	}
	echo '</table>';
}*/

require '../index/Footer.php';

?>
