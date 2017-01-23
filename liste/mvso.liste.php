<?php

require '../index/header.php';

require '../classe/mvso.class.php';
require '../dao/mvso.dao.php';
require '../classe/mvsl.class.php';
require '../dao/mvsl.dao.php';
require '../classe/bout.class.php';
require '../dao/bout.dao.php';
require '../classe/vins.class.php';
require '../dao/vins.dao.php';
require '../classe/appr.class.php';
require '../dao/appr.dao.php';

require '../index/conn_db.php';

$mvso_dao = new mvso_dao($db);
$mesmvso = $mvso_dao->getList();

$compteur = 1;

echo '<table>';
echo '<tr style="vertical-align : top;">';
echo '<td>';

echo '<p><a href="../frm/mvso.frm.php?remvso=0">Ajouter une sortie</a></p>';
echo '<table cellspacing=0 class="tableListe">';
echo '<tr><th class="thListe">Référence</th><th class="thListe">Date</th><th class="thListe">Commentaires</th><th colspan=3 class="thListe">Options</th></tr>';
if (empty($mesmvso))
{
  echo 'pas de sortie !';
}
else
{
	foreach ($mesmvso as $unmvso)
	{
		$compteur = $compteur + 1;
		$class = "";
		if (($compteur % 2) > 0)
			{$class = "trListePaire";}
		echo '<tr class="'.$class.'">';
		echo '<td class="tdListe">', $unmvso->Remvso(), '</td>';
		echo '<td class="tdListe">', $unmvso->damvso(), '</td>';
		echo '<td class="tdListe">', $unmvso->Nomvso(), '</td>';
		echo '<td class="tdListeOption"><a href=../liste/mvso.liste.php?remvso=',$unmvso->Remvso(),'><img src="../img/Info.png"></a></td>';
		echo '<td class="tdListeOption"><a href=../frm/mvso.frm.php?remvso=',$unmvso->Remvso(),'><img src="../img/Edit.png"></a></td>';
		echo '<td class="tdListeOption"><a href=../gest/mvso.gest.php?remvso=',$unmvso->Remvso(),'&mode=del><img src="../img/Delete.png"></a></td>';
		echo '</tr>';
	}
}
echo '</table>';

echo '</td>';
echo '<td style="padding-left : 15px;">';

$compteur = 1;

if ($_GET["remvso"] <> 0)
{
	echo '<p><a href="../frm/mvsl_1.frm.php?remvso='.$_GET["remvso"].'">Sortie une bouteille du stock</a></p>';
	$mvsl_dao = new mvsl_dao($db);
	$mesmvsl = $mvsl_dao->getListmvso($_GET["remvso"]);
	echo '<table cellspacing=0 class="tableListe">';
	echo '<tr><th class="thListe">Référence</th><th class="thListe">Bouteille</th><th class="thListe">Désignation</th><th class="thListe">Quantité</th><th class="thListe">Appréciation</th><th colspan=2 class="thListe">Options</th></tr>';
	if (empty($mesmvsl))
	{
	  echo 'pas de bouteille !';
	}
	else
	{
		foreach ($mesmvsl as $unmvsl)
		{
			$compteur = $compteur + 1;
			$class = "";
			if (($compteur % 2) > 0)
				{$class = "trListePaire";}
			echo '<tr class="'.$class.'">';
			echo '<td class="tdListe">', $unmvsl->Remvsl(), '</td>';
			echo '<td class="tdListe">', $unmvsl->Devins($db), '</td>';
			echo '<td class="tdListe">', $unmvsl->Nomvsl(), '</td>';
			echo '<td class="tdListe">', $unmvsl->Qtmvsl(), '</td>';
			echo '<td class="tdListe">', $unmvsl->Deappr($db), '</td>';
			echo '<td class="tdListeOption"><a href=../frm/mvsl.frm.php?remvsl=',$unmvsl->Remvsl(),'><img src="../img/Edit.png"></a></td>';
			echo '<td class="tdListeOption"><a href=../gest/mvsl.gest.php?remvsl=',$unmvsl->Remvsl(),'&mode=del><img src="../img/Delete.png"></a></td>';
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
