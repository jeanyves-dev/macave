<?php

/* Inventaire des bouteilles */

require '../index/header.php';

require '../classe/vins.class.php';
require '../dao/vins.dao.php';
require '../classe/bout.class.php';
require '../dao/bout.dao.php';
require '../classe/coul.class.php';
require '../dao/coul.dao.php';
require '../classe/mvel.class.php';
require '../dao/mvel.dao.php';
require '../classe/mvsl.class.php';
require '../dao/mvsl.dao.php';

require '../index/conn_db.php';

$vins_dao = new vins_dao($db);
$bout_dao = new bout_dao($db);

$mesvins = $vins_dao->getList("revins","ASC",0,0);

echo '<table cellspacing=0 class="tableListe" id="tableListe">';
echo '<thead>';
echo '<tr>';
echo '<th class="thListe">Référence</th>';
echo '<th class="thListe">Désignation</th>';
echo '<th class="thListe">Couleur</th>';
echo '<th class="thListe">Millésime</th>';
echo '<th class="thListe">Entrées</th>';
echo '<th class="thListe">Sorties</th>';
echo '<th class="thListe">Stock</td>';
echo '</tr>';
echo '</thead>';

$compteur = 1;

if (empty($mesvins))
{
  echo 'pas de vins !';
}
else
{
	foreach ($mesvins as $unvins)
	{
		$mesbout = $bout_dao->getListeVins($unvins->Revins());
		foreach ($mesbout as $unbout)
		{
			$compteur = $compteur + 1;
			$class = "";
			if (($compteur % 2) > 0)
				{$class = "trListePaire";}
			echo '<tr class="'.$class.'">';
			echo '<td class="tdListe">', $unvins->Revins(), '</td>';
			echo '<td class="tdliste">', $unvins->Devins(), '</td>';
			echo '<td class="tdliste">', $unvins->Decoul($db), '</td>';
			echo '<td class="tdliste">', $unbout->Anmile(), '</td>';
			echo '<td class="tdliste">', $unbout->QtEntr($db), '</td>';
			echo '<td class="tdliste">', $unbout->QtSort($db), '</td>';
			echo '<td class="tdliste">', $unbout->QtStock($db), '</td>';
			echo '</tr>';
		}

	}
}
echo '</table>';

require '../index/footer.php';

?>
