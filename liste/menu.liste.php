<?php

require '../index/header.php';

$menu_dao = new menu_dao($db);
$mesmenu = $menu_dao->getList();

echo '<p><a href="../frm/menu.frm.php?remenu=0">Ajouter un menu</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td class="TitreListe">Lien</td><td class="TitreListe">Rang</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesmenu))
{
  echo 'pas de menu !';
}
else
{
	foreach ($mesmenu as $unmenu)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unmenu->Remenu(), '</td>';
		echo '<td class="CelluleListe">', $unmenu->Demenu(), '</td>';
		echo '<td class="CelluleListe">', $unmenu->Limenu(), '</td>';
		echo '<td class="CelluleListe">', $unmenu->Norang(), '</td>';
		echo '<td class="CelluleListe"><a href=../frm/menu.frm.php?remenu=',$unmenu->Remenu(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/menu.gest.php?remenu=',$unmenu->Remenu(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
