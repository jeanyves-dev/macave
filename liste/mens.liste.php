<?php

require '../index/header.php';

require '../index/conn_db.php';

$mens_dao = new mens_dao($db);
$mesmens = $mens_dao->getList();

echo '<p><a href="../frm/mens.frm.php?remens=0">Ajouter un sous menu</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td class="TitreListe">Menu</td><td class="TitreListe">Lien</td><td class="TitreListe">Rang</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesmens))
{
  echo "pas de sous menu !";
}
else
{
	foreach ($mesmens as $unmens)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unmens->Remens(), '</td>';
		echo '<td class="CelluleListe">', $unmens->Demens(), '</td>';
		echo '<td class="CelluleListe">', $unmens->Demenu($db), '</td>';
		echo '<td class="CelluleListe">', $unmens->Limenu(), '</td>';
		echo '<td class="CelluleListe">', $unmens->Norang(), '</td>';
		echo '<td class="CelluleListe"><a href=../frm/mens.frm.php?remens=',$unmens->Remens(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/mens.gest.php?remens=',$unmens->Remens(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
