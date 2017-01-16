<?php

require '../index/header.php';

require '../classe/degu.class.php';
require '../dao/degu.dao.php';
require '../classe/degl.class.php';
require '../dao/degl.dao.php';
require '../classe/bout.class.php';
require '../dao/bout.dao.php';
require '../classe/vins.class.php';
require '../dao/vins.dao.php';

require '../index/conn_db.php';

// Récupération de la liste
$degu_dao = new degu_dao($db);
$mesdegu = $degu_dao->getList();

echo '<p><a class="LienMenuGauche" href="../frm/degu.frm.php?redegu=0">Ajouter une dégustation</a></p>';

echo '<table width=100%>';
echo '<tr>';
echo '<td style="vertical-align:top;">';

/* Entête du tableau */
echo '<table cellspacing=0 class="tableListe">';
echo '<tr>';
echo '<th class="thListe">No</a></th>';
echo '<th class="thListe">Date</a></th>';
echo '<th class="thListe">Note</a></th>';
echo '<th class="thListe" colspan=3>Options</th>';
echo '</tr>';

$compteur = 1;

/* Lignes du tableau */
if (empty($mesdegu))
{
  echo 'pas de degu !';
}
else
{
	foreach ($mesdegu as $undegu)
	{
		/* Ligne paire ou impaire */
		$compteur = $compteur + 1;
		$class = "";
		if (($compteur % 2) > 0)
			{$class = "trListePaire";}
		echo '<tr class="'.$class.'">';
				
		echo '<td class="tdListe">', $undegu->Redegu(), '</td>';
		echo '<td class="tdListe">', $undegu->Dadegu(), '</td>';
		echo '<td class="tdListe">', $undegu->Nodegu($db), '</td>';
		echo '<td class="tdListeOption"><a href=../liste/degu.liste.php?redegu=',$undegu->Redegu(),'><img src="../img/Info.png"></a></td>';
		echo '<td class="tdListeOption"><a href=../frm/degu.frm.php?redegu=',$undegu->Redegu(),'><img src="../img/Edit.png"></a></td>';
		echo '<td class="tdListeOption"><a href=../gest/degu.gest.php?redegu=',$undegu->Redegu(),'&mode=del><img src="../img/Delete.png"></a></td>';
		echo '</tr>';
		
		/* Affichage des bouteilles */
	}
}
echo '</table>';

echo '</td>';
echo '<td style="padding-left : 15px;">';

$compteur = 1;

if (isset($_GET['redegu']) AND ($_GET["redegu"] <> 0))
{
	echo '<p><a href="../frm/degl_1.frm.php?redegu='.$_GET["redegu"].'">Ajouter une bouteille en dégustation</a></p>';
	$degl_dao = new degl_dao($db);
	$mesdegl = $degl_dao->getListDegu($_GET["redegu"]);

	echo '<table cellspacing=0 class="tableListe">';
	echo '<tr><td class="thListe">Bouteille</td><td class="thListe">Visuel</td><td class="thListe">Odorat</td><td class="thListe">Bouche</td><td class="thListe">Commentaire</td><td colspan=2 class="thListe">Options</td></tr>';

	if (empty($mesdegl))
	{
	  echo 'pas de bouteille !';
	}
	else
	{
		foreach ($mesdegl as $undegl)
		{
			$compteur = $compteur + 1;
			$class = "";
			if (($compteur % 2) > 0)
				{$class = "trListePaire";}
				
			echo '<tr class="'.$class.'">';
			echo '<td class="tdListe">', $undegl->Devins($db), '</td>';
			echo '<td class="tdListe">', $undegl->Visuel(), '</td>';
			echo '<td class="tdListe">', $undegl->Odorat(), '</td>';
			echo '<td class="tdListe">', $undegl->Bouche(), '</td>';
			echo '<td class="tdListe">', $undegl->Codegl(), '</td>';
			echo '<td class="tdListeOption"><a href=../frm/mven.frm.php?remven=',$undegl->Redegl(),'><img src="../img/Edit.png"></a></td>';
			echo '<td class="tdListeOption"><a href=../gest/mven.gest.php?remven=',$undegl->Redegl(),'&mode=del><img src="../img/Delete.png"></a></td>';
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
