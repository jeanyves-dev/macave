<?php

require '../index/header.php';

require '../classe/tbse.class.php';
require '../dao/tbse.dao.php';
require '../index/conn_db.php';


$tbse_dao = new tbse_dao($db);
$mestbse = $tbse_dao->getList();

echo '<p><a href="../frm/tbse.frm.php?retbse=0">Ajouter une entete de tabelle</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Code tabelle</td><td class="TitreListe">Désignation</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mestbse))
{
  echo "pas d'entete de tabelle !";
}
else
{
	foreach ($mestbse as $untbse)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $untbse->Retbse(), '</td>';
		echo '<td class="CelluleListe">', $untbse->Codtab(), '</td>';
		echo '<td class="CelluleListe">', $untbse->Detbse(), '</td>';
		echo '<td class="CelluleListe"><a href=../frm/tbse.frm.php?retbse=',$untbse->Retbse(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/tbse.gest.php?retbse=',$untbse->Retbse(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
