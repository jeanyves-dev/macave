<?php

require '../index/header.php';

require '../classe/rece.class.php';
require '../classe/plat.class.php';
require '../classe/rect.class.php';
require '../dao/rece.dao.php';
require '../dao/plat.dao.php';
require '../dao/rect.dao.php';

require '../index/conn_db.php';

$rece_dao = new rece_dao($db);
$mesrece = $rece_dao->getList();

echo '<p><a href="../frm/rece.frm.php?rerece=0">Ajouter une recette</a></p>';

echo '<table border = 1>';
echo '<tr>';
echo '<td class="TitreListe">Référence</td>';
echo '<td class="TitreListe">Désignation</td>';
echo '<td class="TitreListe">Plat</td>';
echo '<td class="TitreListe">Type</td>';
echo '<td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesrece))
{
  echo "pas de recette !";
}
else
{
	foreach ($mesrece as $unrece)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unrece->Rerece(), '</td>';
		echo '<td class="CelluleListe">', $unrece->Derece(), '</td>';
		echo '<td class="CelluleListe">', $unrece->Deplat($db), '</td>';
		echo '<td class="CelluleListe">', $unrece->Derect($db), '</td>';
		echo '<td class="CelluleListe"><a href=../frm/rece.frm.php?rerece=',$unrece->Rerece(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/rece.gest.php?rerece=',$unrece->Rerece(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/footer.php';

?>
