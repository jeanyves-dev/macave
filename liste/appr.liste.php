<?php

require '../index/header.php';

require '../classe/appr.class.php';
require '../dao/appr.dao.php';



require '../index/conn_db.php';

$appr_dao = new appr_dao($db);
$mesappr = $appr_dao->getList();

echo '<p><a href="../frm/appr.frm.php?reappr=0">Ajouter une appréciation</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesappr))
{
  echo "pas d'appréciation !";
}
else
{
	foreach ($mesappr as $unappr)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unappr->Reappr(), '</td>';
		echo '<td class="CelluleListe">', $unappr->Deappr(), '</td>';
		
		echo '<td class="CelluleListe"><a href=../frm/appr.frm.php?reappr=',$unappr->Reappr(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/appr.gest.php?reappr=',$unappr->Reappr(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/footer.php';

?>
