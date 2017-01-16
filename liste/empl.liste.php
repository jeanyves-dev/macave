<?php

require '../index/header.php';

require '../classe/empl.class.php';
require '../dao/empl.dao.php';

require '../index/conn_db.php';

$empl_dao = new empl_dao($db);
$mesempl = $empl_dao->getList();

echo '<p><a href="../frm/empl.frm.php?reempl=0">Ajouter un empl</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesempl))
{
  echo 'pas de empl !';
}
else
{
	foreach ($mesempl as $unempl)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unempl->Reempl(), '</td>';
		echo '<td class="CelluleListe"><a href="../rangement/range.php?reempl='.$unempl->Reempl().'">', $unempl->Deempl(), '</a></td>';
		
		echo '<td class="CelluleListe"><a href=../frm/empl.frm.php?reempl=',$unempl->Reempl(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/empl.gest.php?reempl=',$unempl->Reempl(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
