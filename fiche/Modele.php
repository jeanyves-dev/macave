<?php

require '../index/gestion.php';

require '../classe/vins.class.php';
require '../classe/pays.class.php';
require '../classe/regi.class.php';
require '../classe/appe.class.php';
require '../classe/prod.class.php';
require '../classe/coul.class.php';
require '../classe/gaba.class.php';
require '../classe/bout.class.php';
require '../classe/enso.class.php';
require '../classe/cepv.class.php';
require '../classe/four.class.php';
require '../classe/appr.class.php';
require '../classe/cepa.class.php';
require '../dao/vins.dao.php';
require '../dao/pays.dao.php';
require '../dao/regi.dao.php';
require '../dao/appe.dao.php';
require '../dao/prod.dao.php';
require '../dao/coul.dao.php';
require '../dao/gaba.dao.php';
require '../dao/bout.dao.php';
require '../dao/enso.dao.php';
require '../dao/cepv.dao.php';
require '../dao/four.dao.php';
require '../dao/appr.dao.php';
require '../dao/cepa.dao.php';


require '../index/conn_db.php';


IF ($_GET["revins"] <> 0)
{
	$vins_dao = new vins_dao($db);
	$pays_dao = new pays_dao($db);
	$regi_dao = new regi_dao($db);
	$appe_dao = new appe_dao($db);
	$prod_dao = new prod_dao($db);
	$coul_dao = new coul_dao($db);
	$bout_dao = new bout_dao($db);
	$enso_dao = new enso_dao($db);
	$cepv_dao = new cepv_dao($db);
	$cepa_dao = new cepa_dao($db);
	
	$vins = $vins_dao->get($_GET["revins"]);
	$pays = $pays_dao->get($vins->Repays());
	$regi = $regi_dao->get($vins->Reregi());
	$appe = $appe_dao->get($vins->Reappe());
	$prod = $prod_dao->get($vins->Reprod());
	$coul = $coul_dao->get($vins->Recoul());
	
	echo '<table cellpadding=0 cellspacing=0>';
	echo '<tr><th class="thFiche">Identification</th><th>&nbsp</th><th class="thFiche">Cépage</th></tr>';
	echo '<tr>';
	echo '<td class="tdFiche">';
	
	// Affichage du vin
	echo '<table>';
	echo '<tr><td><b>Référence</b></td><td>'.$vins->Revins().'</td></tr>';
	echo '<tr><td><b>Désignation</b></td><td>'.$vins->Devins().'</td></tr>';
	echo '<tr><td><b>Pays</b></td><td>'.$pays->Depays().'</td></tr>';
	echo '<tr><td><b>Région</b></td><td>'.$regi->Deregi().'</td></tr>';
	echo '<tr><td><b>Appellation</b></td><td>'.$appe->Deappe().'</td></tr>';
	echo '<tr><td><b>Producteur</b></td><td>'.$prod->Deprod().'</td></tr>';
	echo '<tr><td><b>Couleur</b></td><td>'.$coul->Decoul().'</td></tr>';
	echo '</table>';
	
	echo '</td>';
	
	echo '<td class="tdSeparationFiche">&nbsp;</td>';
	
	echo '<td class="tdFiche">';
	
	/* Liste des cépages */
	$mescepa = $cepa_dao->getList();
	echo '<form action="../gest/cepv.gest.php?ori=vins.fiche&mode=ajt&revins='.$vins->Revins().'"  method="post">';
	echo 'Quantité<input type="text" name="qtcepv" maxlength="5" />';
	echo '<SELECT name="recepa">';
	foreach ($mescepa as $uncepa)
		{echo '<option value=',$uncepa->recepa(),'>',$uncepa->Decepa(),'</option>';}
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
	
	echo '<tr><td colspan=3>&nbsp;</td></tr>';
	
	echo '<tr><th class="thFiche">Bouteilles</th><th>&nbsp;</th><th class="thFiche">Mouvements de stock</th></tr>';
	
	echo '<tr>';
	echo '<td class="tdFiche">';
	
	/* Liste des bouteilles de ce vins */
	$mesbout = $bout_dao->getListeVins($vins->Revins());
	echo '<form action="../frm/bout.frm.php?revins='.$vins->Revins().'&Ori=vins.fiche"  method="post"><input type="submit" value="Ajouter une bouteille" name="Valider" /></form>';
	echo '<table cellspacing=0 class="tableDetailFiche">';
	echo '<tr>';
	echo '<th class="thDetailFiche">Gabarit</th>';
	echo '<th class="thDetailFiche">Milésime</th>';
	echo '<th class="thDetailFiche">Apogé</th>';
	echo '<th class="thDetailFiche">A boire avant</th>';
	echo '<th class="thDetailFiche">Note (/20)</th>';
	echo '</tr>';

	if (empty($mesbout))
	{
	  echo 'pas de bouteille !';
	}
	else
	{
		foreach ($mesbout as $unbout)
		{
			echo '<tr>';
			echo '<td class="tdDetailFiche">', $unbout->Degaba($db), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->Anmile(), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->Anapog(), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->Anaboi(), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->Bonote(), '</td>';
			echo '</tr>';
		}
	}
	echo '</table>';
	
	echo '</td>';
	
	echo '<td class="tdSeparationFiche">&nbsp;</td>';
	
	echo '<td class="tdFiche">';
	
	echo '<table>';
	echo '<tr>';
	echo '<td>';
	echo '<form action="../frm/bout.frm.php?revins='.$vins->Revins().'&Ori=vins.fiche"  method="post">';
	echo '<input type="submit" value="Entrer des bouteilles" name="Valider" />';
	echo '</form>';
	echo '</td>';
	echo '<td>';
	echo '<form action="../frm/bout.frm.php?revins='.$vins->Revins().'&Ori=vins.fiche"  method="post">';
	echo '<input type="submit" value="Sortir des bouteilles" name="Valider" />';
	echo '</form>';
	echo '</td>';
	echo '</tr>';
	echo '</table>';

	/* Historique des achat de ce vins */
	echo '<table cellspacing=0 class="tableDetailFiche">';
	echo '<tr>';
	echo '<th class="thDetailFiche">Gabarit</th>';
	echo '<th class="thDetailFiche">Milésime</th>';
	echo '<th class="thDetailFiche">Date</th>';
	echo '<th class="thDetailFiche">Quantité</th>';
	echo '<th class="thDetailFiche">Sens</th>';
	echo '<th class="thDetailFiche">Fournisseur</th>';
	echo '<th class="thDetailFiche">Appréciation</th>';
	echo '</tr>';
	
	foreach ($mesbout as $unbout)
	{
		$mesenso = $enso_dao->getListeBout($unbout->Rebout());
		foreach ($mesenso as $unenso)
		{
			echo '<tr>';
			echo '<td class="tdDetailFiche">', $unbout->Degaba($db), '</td>';
			echo '<td class="tdDetailFiche">', $unbout->Anmile(), '</td>';
			echo '<td class="tdDetailFiche">', $unenso->Daenso(), '</td>';
			echo '<td class="tdDetailFiche">', $unenso->Qtenso(), '</td>';
			if ($unenso->Seenso() == 1)
			{echo '<td class="tdDetailFiche">Entrée</td>';}
			else
			{echo '<td class="tdDetailFiche">Sortie</td>';}
			echo '<td class="tdDetailFiche">', $unenso->Defour($db), '</td>';
			echo '<td class="tdDetailFiche">', $unenso->Deappr($db), '</td>';
			echo '</tr>';
		}
	}
	echo '</table>';
	
	echo '</td>';
	echo '</tr>';
	echo '</table>';

}

require '../index/Footer.php';

?>