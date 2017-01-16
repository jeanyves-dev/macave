<?php
	
	
	$mvel_dao = new mvel_dao($db);
	$mvsl_dao = new mvsl_dao($db);
	$coul_dao = new coul_dao($db);
	
	$StockTotal = $mvel_dao->getEntrTotal() - $mvsl_dao->getSortTotal();

	echo '<table class="tableDetailAccueil" cellspacing=0>';
	
	echo '<tr>';
	echo '<td class="tdTitreDetailAccueil" colspan=2>Inventaire</td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td>Stock total de bouteilles</td>';
	echo '<td>'.$StockTotal.'</td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td colspan=2>Répartition</td>';
	echo '</tr>';
	$mescoul = $coul_dao->getList();
	
	foreach ($mescoul as $uncoul)
	{
		$StockCoul = $mvel_dao->getEntrCoul($uncoul->Recoul()) - $mvsl_dao->getSortCoul($uncoul->Recoul());
		echo '<tr>';
		echo '<td>'.$uncoul->Decoul().'</td><td>'.$StockCoul.'</td>';
		echo '</tr>';
	}
	
	echo '</table>';
	

?>