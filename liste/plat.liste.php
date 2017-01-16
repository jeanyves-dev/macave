<?php

require '../index/header.php';

require '../classe/plat.class.php';
require '../dao/plat.dao.php';

require '../index/conn_db.php';

$plat_dao = new plat_dao($db);
$mesplat = $plat_dao->getList();

echo '<p><a href="../frm/plat.frm.php?replat=0">Ajouter un plat</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesplat))
{
  echo 'pas de plat !';
}
else
{
	foreach ($mesplat as $unplat)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unplat->Replat(), '</td>';
		echo '<td class="CelluleListe">', $unplat->Deplat(), '</td>';
		
		echo '<td class="CelluleListe"><a href=../frm/plat.frm.php?replat=',$unplat->Replat(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/plat.gest.php?replat=',$unplat->Replat(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
