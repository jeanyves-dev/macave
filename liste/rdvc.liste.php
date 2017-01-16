<?php

require '../index/header.php';

require '../classe/rdvc.class.php';
require '../dao/rdvc.dao.php';

require '../index/conn_db.php';

$rdvc_dao = new rdvc_dao($db);
$mesrdvc = $rdvc_dao->getList();

echo '<p><a href="../frm/rdvc.frm.php?rerdvc=0">Ajouter un rdvc</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesrdvc))
{
  echo 'pas de rdvc !';
}
else
{
	foreach ($mesrdvc as $unrdvc)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unrdvc->Rerdvc(), '</td>';
		echo '<td class="CelluleListe">', $unrdvc->Derdvc(), '</td>';
		
		echo '<td class="CelluleListe"><a href=../frm/rdvc.frm.php?rerdvc=',$unrdvc->Rerdvc(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/rdvc.gest.php?rerdvc=',$unrdvc->Rerdvc(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
