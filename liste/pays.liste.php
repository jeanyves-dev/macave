<?php

require '../index/header.php';

require '../classe/pays.class.php';
require '../dao/pays.dao.php';



require '../index/conn_db.php';

$pays_dao = new pays_dao($db);
$mespays = $pays_dao->getList();

echo '<p><a href="../frm/pays.frm.php?repays=0">Ajouter un pays</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mespays))
{
  echo 'pas de pays !';
}
else
{
	foreach ($mespays as $unpays)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unpays->Repays(), '</td>';
		echo '<td class="CelluleListe">', $unpays->Depays(), '</td>';
		
		echo '<td class="CelluleListe"><a href=../frm/pays.frm.php?repays=',$unpays->Repays(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/pays.gest.php?repays=',$unpays->Repays(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/footer.php';

?>
