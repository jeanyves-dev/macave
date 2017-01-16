<?php

require '../index/header.php';

require '../classe/coul.class.php';
require '../dao/coul.dao.php';

require '../index/conn_db.php';

$coul_dao = new coul_dao($db);
$mescoul = $coul_dao->getList();

echo '<p><a href="../frm/coul.frm.php?recoul=0">Ajouter une couleur</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td class="TitreListe">Code couleur</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mescoul))
{
  echo 'pas de couleur !';
}
else
{
	foreach ($mescoul as $uncoul)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $uncoul->Recoul(), '</td>';
		echo '<td class="CelluleListe">', $uncoul->Decoul(), '</td>';
		/*echo '<td class="CelluleListe" style="background-color : '.$uncoul->Cocoul().';">', $uncoul->Cocoul(), '</td>';*/
		echo '<td class="CelluleListe">', $uncoul->Cocoul(), '</td>';
		echo '<td class="CelluleListe"><a href=../frm/coul.frm.php?recoul=',$uncoul->Recoul(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/coul.gest.php?recoul=',$uncoul->Recoul(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/footer.php';

?>