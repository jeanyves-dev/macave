<?php

require '../index/header.php';

require '../classe/mven.class.php';
require '../dao/mven.dao.php';
require '../classe/four.class.php';
require '../dao/four.dao.php';
require '../classe/mvel.class.php';
require '../dao/mvel.dao.php';
require '../classe/bout.class.php';
require '../dao/bout.dao.php';
require '../classe/vins.class.php';
require '../dao/vins.dao.php';
require '../classe/tbsd.class.php';
require '../dao/tbsd.dao.php';

require '../index/conn_db.php';

$mven_dao = new mven_dao($db);
$mesmven = $mven_dao->getList();

echo '<table>';
echo '<tr style="vertical-align : top;">';
echo '<td>';

echo '<p><a href="../frm/mven.frm.php?remven=0">Ajouter une entrée</a></p>';
echo '<table cellspacing=0 class="tableListe">';
echo '<tr><td class="thListe">Date</td><td class="thListe">Fournisseur</td><td class="thListe">Commentaires</td><td class="thListe">Canal achat</td><td colspan=3 class="thListe">Options</td></tr>';

$compteur = 1;

if (empty($mesmven))
{
  echo 'pas de mven !';
}
else
{
	foreach ($mesmven as $unmven)
	{
			$compteur = $compteur + 1;
			$class = "";
			if (($compteur % 2) > 0)
				{$class = "trListePaire";}
			echo '<tr class="'.$class.'">';
		echo '<td class="tdListe">', $unmven->damven(), '</td>';
		echo '<td class="tdListe">', $unmven->Defour($db), '</td>';
		echo '<td class="tdListe">', $unmven->Nomven(), '</td>';
		echo '<td class="tdListe">', $unmven->Decanapp($db), '</td>';
		echo '<td class="tdListeOption"><a href=../liste/mven.liste.php?remven=',$unmven->Remven(),'><img src="../img/Info.png"></a></td>';
		echo '<td class="tdListeOption"><a href=../frm/mven.frm.php?remven=',$unmven->Remven(),'><img src="../img/Edit.png"></a></td>';
		echo '<td class="tdListeOption"><a href=../gest/mven.gest.php?remven=',$unmven->Remven(),'&mode=del><img src="../img/Delete.png"></a></td>';
		echo '</tr>';
	}
}
echo '</table>';

echo '</td>';
echo '<td style="padding-left : 15px;">';

$compteur = 1;

if ($_GET["remven"] <> 0)
{
	echo '<p><a href="../frm/mvel_1.frm.php?remven='.$_GET["remven"].'">Ajouter une bouteille en stock</a></p>';
	$mvel_dao = new mvel_dao($db);
	$mesmvel = $mvel_dao->getListMven($_GET["remven"]);

	echo '<table cellspacing=0 class="tableListe">';
	echo '<tr><td class="thListe">Bouteille</td><td class="thListe">Quantité</td><td class="thListe">Commentaires</td><td colspan=2 class="thListe">Options</td></tr>';

	if (empty($mesmvel))
	{
	  echo 'pas de bouteille !';
	}
	else
	{
		foreach ($mesmvel as $unmvel)
		{
			$compteur = $compteur + 1;
			$class = "";
			if (($compteur % 2) > 0)
				{$class = "trListePaire";}
			echo '<tr class="'.$class.'">';
			echo '<td class="tdListe">', $unmvel->Devins($db), '</td>';
			echo '<td class="tdListe">', $unmvel->Qtmvel(), '</td>';
			echo '<td class="tdListe">', $unmvel->Nomvel(), '</td>';
			echo '<td class="tdListeOption"><a href=../frm/mvel_2.frm.php?remven=',$unmvel->Remven(),'&remvel=',$unmvel->Remvel(),'><img src="../img/Edit.png"></a></td>';
			echo '<td class="tdListeOption"><a href=../gest/mven.gest.php?remven=',$unmvel->Remvel(),'&mode=del><img src="../img/Delete.png"></a></td>';
			echo '</tr>';
		}
	}
	echo '</table>';
	
} 

echo '</td>';
echo '</tr>';
echo '</table>';



require '../index/footer.php';

?>
