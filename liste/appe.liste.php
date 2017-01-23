<?php

require '../index/header.php';

require '../classe/appe.class.php';
require '../classe/regi.class.php';
require '../dao/appe.dao.php';
require '../dao/regi.dao.php';

require '../index/conn_db.php';

$appe_dao = new appe_dao($db);
$mesappe = $appe_dao->getList();

echo '<p><a href="../frm/appe.frm.php?reappe=0">Ajouter une appellation</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td class="TitreListe">Région</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesappe))
{
  echo "pas d'appellation !";
}
else
{
	foreach ($mesappe as $unappe)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unappe->Reappe(), '</td>';
		echo '<td class="CelluleListe">', $unappe->Deappe(), '</td>';
		echo '<td class="CelluleListe">', $unappe->Deregi($db), '</td>';
		echo '<td class="CelluleListe"><a href=../frm/appe.frm.php?reappe=',$unappe->Reappe(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/appe.gest.php?reappe=',$unappe->Reappe(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/footer.php';

?>
