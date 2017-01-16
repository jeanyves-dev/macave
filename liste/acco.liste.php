<?php

require '../index/header.php';

require '../classe/acco.class.php';
require '../classe/vins.class.php';
require '../classe/plat.class.php';
require '../dao/acco.dao.php';
require '../dao/vins.dao.php';
require '../dao/plat.dao.php';

require '../index/conn_db.php';

$acco_dao = new acco_dao($db);
$mesacco = $acco_dao->getList();

echo '<p><a href="../frm/acco.frm.php?reacco=0">Ajouter un accord</a></p>';

echo '<table border = 1>';
echo '<tr>';
echo '<td class="TitreListe">Référence</td>';
echo '<td class="TitreListe">vins</td>';
echo '<td class="TitreListe">Plat</td>';
echo '<td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesacco))
{
  echo "pas de accotte !";
}
else
{
	foreach ($mesacco as $unacco)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unacco->Reacco(), '</td>';
		echo '<td class="CelluleListe">', $unacco->Devins($db), '</td>';
		echo '<td class="CelluleListe">', $unacco->Deplat($db), '</td>';
		echo '<td class="CelluleListe"><a href=../frm/acco.frm.php?reacco=',$unacco->Reacco(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/acco.gest.php?reacco=',$unacco->Reacco(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
