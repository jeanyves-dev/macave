<?php

require '../index/header.php';

require '../classe/vins.class.php';
require '../classe/conc.class.php';
require '../classe/meda.class.php';
require '../classe/tbsd.class.php';
require '../dao/vins.dao.php';
require '../dao/conc.dao.php';
require '../dao/meda.dao.php';
require '../dao/tbsd.dao.php';

require '../index/conn_db.php';

IF ($_GET["revins"] <> 0)
{
	$vins_dao = new vins_dao($db);
	$conc_dao = new conc_dao($db);
	$meda_dao = new meda_dao($db);
	$tbsd_dao = new tbsd_dao($db);

	$vins = $vins_dao->get($_GET["revins"]);
		
	echo '<table cellpadding=0 cellspacing=0 class="tableFiche" width=100%>';
	
	echo '<tr>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.a.php?revins=',$vins->Revins(),'&rebout=0>La reserve</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.b.php?revins=',$vins->Revins(),'>Fiche du vin</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.c.php?revins=',$vins->Revins(),'>Cepage</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.d.php?revins=',$vins->Revins(),'>Accord mets / vins</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.e.php?revins=',$vins->Revins(),'>Dégustation</a></th>';
	echo '<th class="thFicheEnCours">Récompense</th>';
	echo '</tr>';
	
	echo '<tr>';
	
	echo '<td colspan=6 class="tdFiche1">';
	
	
	echo '<table cellpadding=0 cellspacing=0>';
	echo '<tr><th class="thFiche3">Récompenses</th></tr>';
	echo '<tr>';
	
	/* Ajouter une medaille */
	$mesconc = $conc_dao->getList();
	$mestbsd = $tbsd_dao->getList("nimeda");
	echo '<td class="tdFiche3">';
	echo '<form action="../gest/meda.gest.php?ori=vins.fiche&mode=ajt&revins='.$vins->Revins().'"  method="post">';
	echo '<table>';
	echo '<tr>';
	echo '<td>Concours</td><td><SELECT name="reconc">';
	foreach ($mesconc as $unconc)
		{echo '<option value=',$unconc->reconc(),'>',$unconc->Deconc(),'</option>';}
	echo '</select></td><td><input type="text" name="deconc" maxlength="50" /></td></tr>';
	echo '<tr><td>Niveau</td><td><SELECT name="nimeda">';
	foreach ($mestbsd as $untbsd)
		{echo '<option value=',$untbsd->retbsd(),'>',$untbsd->Detbsd(),'</option>';}
	echo '</select></td></tr>';
	echo '<tr><td>Période</td><td><input type="text" name="period" maxlength="4" /></td></tr>';
	echo '<tr><td>&nbsp;</td><td><input type="submit" value="Ajouter" name="Valider" /></td></tr>';
	echo '</table>';
	echo '</form>';
	
	/* Liste des récompenses */
	echo '<table cellspacing=0 class="tableDetailFiche">';
	echo '<tr>';
	echo '<th class="thDetailFiche">Concours</th>';
	echo '<th class="thDetailFiche">Médaille</th>';
	echo '<th class="thDetailFiche">Période</th>';
	echo '<th class="thDetailFiche">Options</th>';

	echo '</tr>';
	$mesmeda = $meda_dao->getListVins($vins->Revins());
	foreach ($mesmeda as $unmeda)
	{
		echo '<tr>';
		echo '<td class="tdDetailFiche">', $unmeda->Deconc($db), '</td>';
		echo '<td class="tdDetailFiche">', $unmeda->Denimeda($db), '</td>';
		echo '<td class="tdDetailFiche">', $unmeda->Period(), '</td>';
		echo '<td class="tdDetailFiche"><a href="../gest/meda.gest.php?mode=del&ori=vins.fiche&revins='.$vins->Revins().'&remeda='.$unmeda->Remeda().'">Supprimer</a></td>';
		echo '</tr>';
	}
	echo '</table>';
	echo '</td>';

	
	echo '</tr>';
	echo '</table>';

	
	echo '</td>';	
	echo '</tr>';
	echo '</table>';

}

require '../index/footer.php';

?>