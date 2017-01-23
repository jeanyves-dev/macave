<?php

require '../index/header.php';

require '../classe/casi.class.php';
require '../classe/colo.class.php';
require '../dao/casi.dao.php';
require '../dao/colo.dao.php';

require '../index/conn_db.php';

$casi_dao = new casi_dao($db);
$mescasi = $casi_dao->getList();

echo '<p><a href="../frm/casi.frm.php?recasi=0">Ajouter un casier</a></p>';

echo '<table border = 1>';
echo '<tr>';
echo '<td class="TitreListe">Référence</td>';
echo '<td class="TitreListe">Désignation</td>';
echo '<td class="TitreListe">colonne</td>';
echo '<td class="TitreListe">Nbr ligne</td>';
echo '<td class="TitreListe">Nbr colonne</td>';
echo '<td colspan=2 class="TitreListe">Options</td>';
echo '</tr>';

if (empty($mescasi))
{
  echo 'pas de casier !';
}
else
{
	foreach ($mescasi as $uncasi)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $uncasi->Recasi(), '</td>';
		echo '<td class="CelluleListe">', $uncasi->Decasi(), '</td>';
		echo '<td class="CelluleListe">', $uncasi->Decolo($db), '</td>';
		echo '<td class="CelluleListe">', $uncasi->Nbrlig(), '</td>';
		echo '<td class="CelluleListe">', $uncasi->Nbrcol(), '</td>';
		echo '<td class="CelluleListe"><a href=../frm/casi.frm.php?recasi=',$uncasi->Recasi(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/casi.gest.php?recasi=',$uncasi->Recasi(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/footer.php';

?>
