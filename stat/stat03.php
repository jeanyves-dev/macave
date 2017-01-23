<?php

/* Stat par appe */

require '../index/header.php';

require '../classe/appe.class.php';
require '../dao/appe.dao.php';
require '../classe/mvel.class.php';
require '../dao/mvel.dao.php';
require '../classe/mvsl.class.php';
require '../dao/mvsl.dao.php';
require 'stat.dao.php';

require '../index/conn_db.php';

$appe_dao = new appe_dao($db);
$mesappe = $appe_dao->getList();

$stat_dao = new stat_dao($db);

echo '<p><a href="stat03.php?tystat=1">Table</a> - <a href="stat03.php?tystat=2">Histogramme</a></p>';

IF (isset($_GET["tystat"]) AND $_GET["tystat"] == "1")
{
	echo '<table border = 1>';
	echo '<tr><td class="TitreListe">Désignation</td><td class="TitreListe">Quantité</td></tr>';
	foreach ($mesappe as $unappe)
	{
		$res = $stat_dao->getStat3($unappe->Reappe());
		echo '<tr>';
		echo '<td class="CelluleListe">', $unappe->Deappe(), '</td>';
		echo '<td class="CelluleListe">', $res, '</td>';
		echo '</tr>';
	}
	echo '</table>';
}

IF (isset($_GET["tystat"]) AND $_GET["tystat"] == "2")
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
}

require '../index/footer.php';

?>
