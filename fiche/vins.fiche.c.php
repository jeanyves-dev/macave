<?php

require '../index/header.php';

require '../classe/vins.class.php';
require '../classe/cepv.class.php';
require '../classe/cepa.class.php';
require '../dao/vins.dao.php';
require '../dao/cepv.dao.php';
require '../dao/cepa.dao.php';

require '../index/conn_db.php';

IF ($_GET["revins"] <> 0)
{
	$vins_dao = new vins_dao($db);
	$cepv_dao = new cepv_dao($db);
	$cepa_dao = new cepa_dao($db);
	
	$vins = $vins_dao->get($_GET["revins"]);
	
	echo '<table cellpadding=0 cellspacing=0 class="tableFiche" width=100%>';
	
	echo '<tr>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.a.php?revins=',$vins->Revins(),'&rebout=0>La reserve</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.b.php?revins=',$vins->Revins(),'>Fiche du vin</a></th>';
	echo '<th class="thFicheEnCours">Cépage</th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.d.php?revins=',$vins->Revins(),'>Accord mets / vins</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.e.php?revins=',$vins->Revins(),'>Dégustation</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.f.php?revins=',$vins->Revins(),'>Récompense</a></th>';
	echo '</tr>';
	
	echo '<tr>';
	
	echo '<td colspan=6 class="tdFiche1">';
	
	echo '<table cellpadding=0 cellspacing=0>';
	echo '<tr><th class="thFiche3">Cépages</th></tr>';
	echo '<tr>';
	
	/* Affiche des cépages */
	echo '<td class="tdFiche3">';
	$mescepa = $cepa_dao->getList();
	echo '<form action="../gest/cepv.gest.php?ori=vins.fiche&mode=ajt&revins='.$vins->Revins().'"  method="post">';
	echo 'Quantité<input type="text" name="qtcepv" maxlength="5" />';
	echo '<SELECT name="recepa">';
	foreach ($mescepa as $uncepa)
		{echo '<option value=',$uncepa->recepa(),'>',$uncepa->Decepa(),'</option>';}
	echo '</select>';
	echo '<input type="submit" value="Ajouter" name="Valider" />';
	echo '</form>';
	echo '<table cellspacing=0 class="tableDetailFiche">';
	echo '<tr>';
	echo '<th class="thDetailFiche">Cepage</th>';
	echo '<th class="thDetailFiche">Quantité</th>';
	echo '<th class="thDetailFiche">Option</th>';
	echo '</tr>';
	$mescepv = $cepv_dao->getList($vins->Revins());
	foreach ($mescepv as $uncepv)
	{
		echo '<tr>';
		echo '<td class="tdDetailFiche">', $uncepv->Decepa($db), '</td>';
		echo '<td class="tdDetailFiche">', $uncepv->Qtcepv(), '</td>';
		echo '<td class="tdDetailFiche"><a href="../gest/cepv.gest.php?mode=del&ori=vins.fiche&revins='.$vins->Revins().'&recepa='.$uncepv->Recepa().'">Supprimer</a></td>';
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

require '../index/Footer.php';

?>