<?php

/* Stat par type */

require '../index/header.php';

require '../classe/typv.class.php';
require '../dao/typv.dao.php';
require '../classe/mvel.class.php';
require '../dao/mvel.dao.php';
require '../classe/mvsl.class.php';
require '../dao/mvsl.dao.php';
require 'stat.dao.php';

require '../index/conn_db.php';

$typv_dao = new typv_dao($db);
$mestypv = $typv_dao->getList();

$stat_dao = new stat_dao($db);

echo '<p><a href="stat09.php?tystat=1">Table</a> - <a href="stat09.php?tystat=2">Histogramme</a></p>';

IF (isset($_GET["tystat"]) AND $_GET["tystat"] == "1")
{
	echo '<table border = 1>';
	echo '<tr><td class="TitreListe">Désignation</td><td class="TitreListe">Quantité</td></tr>';
	foreach ($mestypv as $untypv)
	{
		$res = $stat_dao->getStat9($untypv->Retypv());
		echo '<tr>';
		echo '<td class="CelluleListe">', $untypv->Detypv(), '</td>';
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
	foreach ($mestypv as $untypv)
	{
		$nbr = $stat_dao->getStat9($untypv->Retypv());
		$res = ($nbr/$StockTotal*100)*10;
		echo '<tr>';
		echo '<td class="tdStatHisto1">', $untypv->Detypv(), '</td>';
		echo '<td class="tdStatHisto2"><div style="background-color:red;width:'.$res.'px;">'.$nbr.'</div></td>';
		echo '</tr>';
	}
	echo '</table>';
}

require '../index/Footer.php';

?>
