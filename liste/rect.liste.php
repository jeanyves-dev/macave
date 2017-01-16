<?php

require '../index/header.php';

require '../classe/rect.class.php';
require '../dao/rect.dao.php';



require '../index/conn_db.php';

$rect_dao = new rect_dao($db);
$mesrect = $rect_dao->getList();

echo '<p><a href="../frm/rect.frm.php?rerect=0">Ajouter un type de recette</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesrect))
{
  echo 'pas de type de recette !';
}
else
{
	foreach ($mesrect as $unrect)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unrect->Rerect(), '</td>';
		echo '<td class="CelluleListe">', $unrect->Derect(), '</td>';
		
		echo '<td class="CelluleListe"><a href=../frm/rect.frm.php?rerect=',$unrect->Rerect(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/rect.gest.php?rerect=',$unrect->Rerect(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
