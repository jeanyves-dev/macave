<?php

require '../index/header.php';

require '../classe/vins.class.php';
require '../classe/gaba.class.php';
require '../classe/bout.class.php';
require '../classe/degu.class.php';
require '../classe/degl.class.php';
require '../dao/vins.dao.php';
require '../dao/gaba.dao.php';
require '../dao/bout.dao.php';
require '../dao/degu.dao.php';
require '../dao/degl.dao.php';

require '../index/conn_db.php';

IF ($_GET["revins"] <> 0)
{
	$vins_dao = new vins_dao($db);
	$bout_dao = new bout_dao($db);
	$degu_dao = new degu_dao($db);
	$degl_dao = new degl_dao($db);

	$vins = $vins_dao->get($_GET["revins"]);
	
	$mesbout = $bout_dao->getListeVins($vins->Revins());
	
	echo '<table cellpadding=0 cellspacing=0 class="tableFiche" width=100%>';
	
	echo '<tr>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.a.php?revins=',$vins->Revins(),'&rebout=0>La reserve</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.b.php?revins=',$vins->Revins(),'>Fiche du vin</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.c.php?revins=',$vins->Revins(),'>Cepage</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.d.php?revins=',$vins->Revins(),'>Accord mets / vins</a></th>';
	echo '<th class="thFicheEnCours">Dégustation</th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.f.php?revins=',$vins->Revins(),'>Récompense</a></th>';
	echo '</tr>';
	
	echo '<tr>';
	
	echo '<td colspan=6 class="tdFiche1">';
	
	echo '<table cellpadding=0 cellspacing=0>';
	echo '<tr><th class="thFiche3">Dégustation</th></tr>';
	echo '<tr>';
	
	echo '<td class="tdFiche3">';
	
	
	echo '<table cellspacing=0 class="tableDetailFiche">';
	echo '<tr>';
	echo '<th class="thDetailFiche">Gabarit</th>';
	echo '<th class="thDetailFiche">Milésime</th>';
	echo '<th class="thDetailFiche">Date</th>';
	echo '<th class="thDetailFiche">Notes</th>';
	echo '<th class="thDetailFiche">Visuel</th>';
	echo '<th class="thDetailFiche">Odorat</th>';
	echo '<th class="thDetailFiche">Bouche</th>';
	echo '<th class="thDetailFiche">Commentaire</th>';
	echo '</tr>';
	if (empty($mesbout))
		{echo 'pas de bouteille !';}
	else
	{
		foreach ($mesbout as $unbout)
		{
			$mesdegl = $degl_dao->getListBout($unbout->Rebout());
			foreach ($mesdegl as $undegl)
			{
				$undegu = $degu_dao->get($undegl->Redegu());
				echo '<tr>';
				echo '<td class="tdDetailFiche">', $unbout->Degaba($db), '</td>';
				echo '<td class="tdDetailFiche">', $unbout->Anmile(), '</td>';
				echo '<td class="tdDetailFiche">', $undegu->dadegu(), '</td>';
				echo '<td class="tdDetailFiche">', $undegu->nodegu(), '</td>';
				echo '<td class="tdDetailFiche">', $undegl->visuel(), '</td>';
				echo '<td class="tdDetailFiche">', $undegl->odorat(), '</td>';
				echo '<td class="tdDetailFiche">', $undegl->bouche(), '</td>';
				echo '<td class="tdDetailFiche">', $undegl->codegl(), '</td>';

				echo '</tr>';
			}

		}
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