<?php

require '../index/header.php';

require '../classe/bout.class.php';
require '../classe/vins.class.php';
require '../classe/gaba.class.php';
require '../classe/coul.class.php';
require '../classe/mven.class.php';
require '../classe/mvso.class.php';
require '../classe/mvel.class.php';
require '../classe/mvsl.class.php';
require '../dao/bout.dao.php';
require '../dao/vins.dao.php';
require '../dao/gaba.dao.php';
require '../dao/coul.dao.php';
require '../dao/mven.dao.php';
require '../dao/mvso.dao.php';
require '../dao/mvel.dao.php';
require '../dao/mvsl.dao.php';

require '../index/conn_db.php';

$bout_dao = new bout_dao($db);

if (isset($_GET['revins']) AND ($_GET['revins'] <> 0))
{$mesbout = $bout_dao->getListeVins($_GET['revins']);}
else
{$mesbout = $bout_dao->getList();}

echo '<p><a href="../frm/bout.frm.php?rebout=0&revins=0&Ori=bout.liste">Ajouter une bouteille</a></p>';

echo '<table cellspacing=0 class="tableListe">';
echo '<tr>';
echo '<th class="thListe">Référence</th>';
echo '<th class="thListe">Vin</th>';
echo '<th class="thListe">Couleur</th>';
echo '<th class="thListe">Gabarit</th>';
echo '<th class="thListe">Milésime</th>';
echo '<th class="thListe">Apogé</th>';
echo '<th class="thListe">A boire avant</th>';
echo '<th class="thListe">Note (/20)</th>';
echo '<th class="thListe">Stock</th>';
echo '<th class="thListe" colspan=2>Options</th>';

$compteur = 1;

echo '</tr>';

if (empty($mesbout))
{
  echo 'pas de bouteille !';
}
else
{
	foreach ($mesbout as $unbout)
	{
		/* Ligne paire ou impaire */
		$compteur = $compteur + 1;
		$class = "";
		if (($compteur % 2) > 0)
			{$class = "trListePaire";}
		echo '<tr class="'.$class.'">';
		
		echo '<td class="tdListe">', $unbout->Rebout(), '</td>';
		echo '<td class="tdListe">', $unbout->Devins($db), '</td>';
		echo '<td class="tdListe">', $unbout->Decoul($db), '</td>';
		echo '<td class="tdListe">', $unbout->Degaba($db), '</td>';
		echo '<td class="tdListe">', $unbout->Anmile(), '</td>';
		echo '<td class="tdListe">', $unbout->Anapog(), '</td>';
		echo '<td class="tdListe">', $unbout->Anaboi(), '</td>';
		echo '<td class="tdListe">', $unbout->Bonote(), '</td>';
		echo '<td class="tdListe">', $unbout->QtStock($db), '</td>';
		echo '<td class="tdListeOption"><a href=../frm/bout.frm.php?Ori=bout.liste&rebout=',$unbout->Rebout(),'><img src="../img/Edit.png"></a></td>';
		echo '<td class="tdListeOption"><a href=../gest/bout.gest.php?rebout=',$unbout->Rebout(),'&mode=del><img src="../img/Delete.png"></a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
