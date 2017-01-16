<?php

require '../index/header.php';

require '../classe/colo.class.php';
require '../classe/empl.class.php';
require '../dao/colo.dao.php';
require '../dao/empl.dao.php';

require '../index/conn_db.php';

$colo_dao = new colo_dao($db);
$mescolo = $colo_dao->getList();

echo '<p><a href="../frm/colo.frm.php?recolo=0">Ajouter une colonne</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td class="TitreListe">empl</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mescolo))
{
  echo 'pas de colonne !';
}
else
{
	foreach ($mescolo as $uncolo)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $uncolo->Recolo(), '</td>';
		echo '<td class="CelluleListe">', $uncolo->Decolo(), '</td>';
		echo '<td class="CelluleListe">', $uncolo->Deempl($db), '</td>';
		echo '<td class="CelluleListe"><a href=../frm/colo.frm.php?recolo=',$uncolo->Recolo(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/colo.gest.php?recolo=',$uncolo->Recolo(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
