<?php

require '../index/header.php';

require '../classe/regi.class.php';
require '../classe/pays.class.php';
require '../dao/regi.dao.php';
require '../dao/pays.dao.php';

require '../index/conn_db.php';

$regi_dao = new regi_dao($db);
$mesregi = $regi_dao->getList();

echo '<p><a href="../frm/regi.frm.php?reregi=0">Ajouter une région</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td class="TitreListe">Pays</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesregi))
{
  echo 'pas de région !';
}
else
{
	foreach ($mesregi as $unregi)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unregi->Reregi(), '</td>';
		echo '<td class="CelluleListe">', $unregi->Deregi(), '</td>';
		echo '<td class="CelluleListe">', $unregi->Depays($db), '</td>';
		echo '<td class="CelluleListe"><a href=../frm/regi.frm.php?reregi=',$unregi->Reregi(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/regi.gest.php?reregi=',$unregi->Reregi(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
