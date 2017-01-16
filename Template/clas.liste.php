<?php

require '../index/header.php';

require '../classe/clas.class.php';
require '../dao/clas.dao.php';

require '../index/conn_db.php';

$clas_dao = new clas_dao($db);
$mesclas = $clas_dao->getList();

echo '<p><a href="../frm/clas.frm.php?reclas=0">Ajouter un classement</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesclas))
{
  echo 'pas de classement !';
}
else
{
	foreach ($mesclas as $unclas)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unclas->Reclas(), '</td>';
		echo '<td class="CelluleListe">', $unclas->Declas(), '</td>';
		
		echo '<td class="CelluleListe"><a href=../frm/clas.frm.php?reclas=',$unclas->Reclas(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/clas.gest.php?reclas=',$unclas->Reclas(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
