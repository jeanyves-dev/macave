<?php

require '../index/header.php';

require '../classe/typv.class.php';
require '../dao/typv.dao.php';



require '../index/conn_db.php';

$typv_dao = new typv_dao($db);
$mestypv = $typv_dao->getList();

echo '<p><a href="../frm/typv.frm.php?retypv=0">Ajouter un type de vins</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mestypv))
{
  echo 'pas de type de vin !';
}
else
{
	foreach ($mestypv as $untypv)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $untypv->Retypv(), '</td>';
		echo '<td class="CelluleListe">', $untypv->Detypv(), '</td>';
		
		echo '<td class="CelluleListe"><a href=../frm/typv.frm.php?retypv=',$untypv->Retypv(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/typv.gest.php?retypv=',$untypv->Retypv(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
