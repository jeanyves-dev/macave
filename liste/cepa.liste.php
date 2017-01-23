<?php

require '../index/header.php';

require '../classe/cepa.class.php';
require '../dao/cepa.dao.php';

require '../index/conn_db.php';

$cepa_dao = new cepa_dao($db);
$mescepa = $cepa_dao->getList();

echo '<p><a href="../frm/cepa.frm.php?recepa=0">Ajouter un cepa</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mescepa))
{
  echo 'pas de cepa !';
}
else
{
	foreach ($mescepa as $uncepa)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $uncepa->Recepa(), '</td>';
		echo '<td class="CelluleListe">', $uncepa->Decepa(), '</td>';
		
		echo '<td class="CelluleListe"><a href=../frm/cepa.frm.php?recepa=',$uncepa->Recepa(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/cepa.gest.php?recepa=',$uncepa->Recepa(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/footer.php';

?>
