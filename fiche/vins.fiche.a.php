<?php

require '../index/header.php';

require '../classe/vins.class.php';
require '../classe/gaba.class.php';
require '../classe/bout.class.php';
require '../classe/mvsl.class.php';
require '../classe/mvel.class.php';
require '../classe/mven.class.php';
require '../classe/mvso.class.php';
require '../classe/four.class.php';
require '../classe/appr.class.php';
require '../classe/rang.class.php';
require '../classe/tari.class.php';
require '../dao/vins.dao.php';
require '../dao/gaba.dao.php';
require '../dao/bout.dao.php';
require '../dao/mvsl.dao.php';
require '../dao/mvel.dao.php';
require '../dao/mven.dao.php';
require '../dao/mvso.dao.php';
require '../dao/four.dao.php';
require '../dao/appr.dao.php';
require '../dao/rang.dao.php';
require '../dao/tari.dao.php';


require '../index/conn_db.php';

IF ($_GET["revins"] <> 0)
{
	$vins_dao = new vins_dao($db);
	$bout_dao = new bout_dao($db);
	$mvel_dao = new mvel_dao($db);
	$mvsl_dao = new mvsl_dao($db);
	
	$vins = $vins_dao->get($_GET["revins"]);
	
	$rebout = 0;
	if (isset($_GET['rebout']))
		{$rebout = $_GET['rebout'];}
	
	echo '<table cellpadding=0 cellspacing=0 class="tableFiche" width=95%>';
	
	echo '<tr>';
	echo '<th class="thFicheEnCours">La reserve</th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.b.php?revins=',$vins->Revins(),'>Fiche du vin</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.c.php?revins=',$vins->Revins(),'>Cépage</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.d.php?revins=',$vins->Revins(),'>Accord mets / vins</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.e.php?revins=',$vins->Revins(),'>Dégustation</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.f.php?revins=',$vins->Revins(),'>Rémpense</a></th>';
	echo '</tr>';
	
	echo '<tr>';
	
	echo '<td colspan=6 class="tdFiche1">';
	
	echo '<table cellpadding=20 width=100%>';
	echo '<tr>';
	echo '<td colspan=3>';
	
	echo '<table cellpadding=0 cellspacing=0 align="center">';
	echo '<tr><th class="thFiche3">bouteilles</th></tr>';
	echo '<tr>';
	
	/* Affiche des bouteilles */
	echo '<td class="tdFiche3">';
	$mesbout = $bout_dao->getListeVins($vins->Revins());
	echo '<form action="../frm/bout.frm.php?revins='.$vins->Revins().'&ori=vins.fiche"  method="post"><input type="submit" value="Ajouter une bouteille" name="Valider" /></form>';
	echo '<table cellspacing=0 class="tableDetailFiche">';
	echo '<tr>';
	echo '<th class="thDetailFiche">Gabarit</th>';
	echo '<th class="thDetailFiche">Milésime</th>';
	echo '<th class="thDetailFiche">Apogé</th>';
	echo '<th class="thDetailFiche">A boire avant</th>';
	echo '<th class="thDetailFiche">Note (/20)</th>';
	echo '<th class="thDetailFiche">En stock</th>';
	echo "<th class='thDetailFiche'>Nombre d'entrée</th>";
	echo '<th class="thDetailFiche">Nombre de sortie</th>';
	echo '<th class="thDetailFiche">Degrés alcool</th>';	
	echo '<th class="thDetailFiche">Tarif moyen</th>';
	echo '<th class="thDetailFiche" colspan=2>Options</th>';
	echo '</tr>';
	
	$class = "";

	if (empty($mesbout))
	{
	  echo 'pas de bouteille !';
	}
	else
	{
		foreach ($mesbout as $unbout)
		{
			if ($rebout == 0)
				{$rebout = $unbout->Rebout();}
								
			echo '<tr>';
			echo '<td class="tdDetailFiche">', $unbout->Degaba($db), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->Anmile(), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->Anapog(), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->Anaboi(), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->Bonote(), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->QtStock($db), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->QtEntr($db), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->QtSort($db), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->Degres(), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->TarAvg($db), ' €</td>';
			echo '<td class="tdDetailFiche"><a href=../fiche/vins.fiche.a.php?revins=',$vins->Revins(),'&rebout='.$unbout->Rebout().'><img src="../img/Info.png"></a></td>';
			echo '<td class="tdDetailFiche"><a href=../frm/bout.frm.php?Ori=bout.liste&rebout=',$unbout->Rebout(),'><img src="../img/Edit.png"></a></td>';

			echo '</tr>';
		}
	}
	echo '</table>';

	echo '</td>';
	echo '</tr>';
	echo '</table>';

	/* Repositionne sur la bouteille */
	$bout = $bout_dao->get($rebout);
	
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	
	echo '<td class="tdFiche2">';
	echo '<table cellpadding=0 cellspacing=0>';
	echo '<tr><th class="thFiche3">Mouvements stock</th></tr>';
	echo '<tr>';
	/* Affichage des entrées en stock */
	echo '<td class="tdFiche3">';
	echo '<table cellspacing=0 class="tableDetailFiche">';
	echo '<tr>';
	echo '<th class="thDetailFiche">Type</th>';
	echo '<th class="thDetailFiche">Gabarit</th>';
	echo '<th class="thDetailFiche">Milésime</th>';
	echo '<th class="thDetailFiche">Date</th>';
	echo '<th class="thDetailFiche">Quantité</th>';
	echo '<th class="thDetailFiche">Four / appréciation</th>';
	echo '</tr>';
	$mesmvel = $mvel_dao->getListeBout($rebout);
	foreach ($mesmvel as $unmvel)
	{
		echo '<tr>';
		echo '<td class="tdDetailFiche">Entrée</td>';
		echo '<td class="tdDetailFiche">', $bout->Degaba($db), '</td>';
		echo '<td class="tdDetailFiche">', $bout->Anmile(), '</td>';
		echo '<td class="tdDetailFiche">', $unmvel->Damven($db), '</td>';
		echo '<td class="tdDetailFiche">', $unmvel->Qtmvel(), '</td>';
		echo '<td class="tdDetailFiche">', $unmvel->Defour($db), '</td>';
		echo '</tr>';
	}
	$mesmvsl = $mvsl_dao->getListeBout($rebout);
	foreach ($mesmvsl as $unmvsl)
	{
		echo '<tr>';
		echo '<td class="tdDetailFiche">Sortie</td>';
		echo '<td class="tdDetailFiche">', $bout->Degaba($db), '</td>';
		echo '<td class="tdDetailFiche">', $bout->Anmile(), '</td>';
		echo '<td class="tdDetailFiche">', $unmvsl->Damvso($db), '</td>';
		echo '<td class="tdDetailFiche">', $unmvsl->Qtmvsl(), '</td>';
		echo '<td class="tdDetailFiche">', $unmvsl->Deappr($db), '</td>';
		echo '</tr>';
	}

	echo '</table>';
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</td>';
		
	echo '<td class="tdFiche2">';
	echo '<table cellpadding=0 cellspacing=0>';
	echo '<tr><th class="thFiche3">Rangement</th></tr>';
	echo '<tr>';
	/* Affichage des rangement */
	echo '<td class="tdFiche3">';
	echo '<table cellspacing=0 class="tableDetailFiche">';
	echo '<tr>';
	echo '<th class="thDetailFiche">Gabarit</th>';
	echo '<th class="thDetailFiche">Milésime</th>';
	echo '<th class="thDetailFiche">Emplacement</th>';
	echo '<th class="thDetailFiche">Colonne</th>';
	echo '<th class="thDetailFiche">Casier</th>';
	echo '<th class="thDetailFiche">Quantité</th>';
	echo '</tr>';
	/*$rang_dao = new rang_dao($db);
	$mesrang = $rang_dao->getListCasiBout($rebout);
	foreach ($mesrang as $unrang)
	{
		$casi_dao = new casi_dao($db);
		$casi = $casi_dao->get($unrang["recasi"]);
		echo '<tr>';
		echo '<td class="tdDetailFiche">', $unbout->Degaba($db), '</td>';
		echo '<td class="tdDetailFiche">', $unbout->Anmile(), '</td>';
		echo '<td class="tdDetailFiche">', $casi->Deempl($db), '</td>';
		echo '<td class="tdDetailFiche">', $casi->Decolo($db), '</td>';
		echo '<td class="tdDetailFiche">', $casi->Decasi(), '</td>';
		echo '<td class="tdDetailFiche">', $rang_dao->getQtRangBoutCasi($rebout,$unrang["recasi"]), '</td>';
		echo '</tr>';
	}*/
	echo '</table>';
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</td>';	
	
	echo '<td class="tdFiche2">';
	echo '<table cellpadding=0 cellspacing=0>';
	echo '<tr><th class="thFiche3">Tarif <a href="../frm/tari.frm.php?rebout='.$rebout.'">Ajouter</a></th></tr>';
	echo '<tr>';
	/* Affichage des tarif */
	echo '<td class="tdFiche3">';
	echo '<table cellspacing=0 class="tableDetailFiche">';
	echo '<tr>';
	echo '<th class="thDetailFiche">Date</th>';
	echo '<th class="thDetailFiche">Montant</th>';
	echo '<th class="thDetailFiche">Type</th>';
	echo '</tr>';
	$tari_dao = new tari_dao($db);
	$mestari = $tari_dao->getListBout($rebout);
	foreach ($mestari as $untari)
	{
		echo '<tr>';
		echo '<td class="tdDetailFiche">', $untari->Datari(), '</td>';
		echo '<td class="tdDetailFiche">', $untari->Mtbout(), '</td>';
		echo '<td class="tdDetailFiche">', $untari->Tytari(), '</td>';
		echo '</tr>';
	}
	echo '</table>';
	echo '</td>';
	echo '</tr>';
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